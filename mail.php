<?php
$recipient = 'ekobuemmanuel06@gmail.com';
$defaultRedirect = 'thank-you.html';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html', true, 303);
    exit;
}

function clean_value(string $value): string
{
    $value = trim($value);
    $value = str_replace(["\r", "\n"], ' ', $value);
    return $value;
}

$name = clean_value($_POST['name'] ?? '');
$email = clean_value($_POST['email'] ?? '');
$phone = clean_value($_POST['phone'] ?? '');
$topic = clean_value($_POST['topic'] ?? '');
$message = trim((string)($_POST['message'] ?? ''));
$redirect = clean_value($_POST['redirect'] ?? $defaultRedirect);

$redirect = basename($redirect) ?: $defaultRedirect;

if ($name === '' || $email === '' || $topic === '' || $message === '') {
    http_response_code(400);
    echo 'Please fill in all required fields.';
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo 'Please enter a valid email address.';
    exit;
}

$subject = 'Newlife Child Rescue contact message: ' . $topic;

$body  = "New contact form message from Newlife Child Rescue Buwagani\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n";
$body .= "Phone: {$phone}\n";
$body .= "Topic: {$topic}\n\n";
$body .= "Message:\n{$message}\n";

$host = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? 'localhost');
$host = preg_replace('/[^a-zA-Z0-9.-]/', '', $host);
$fromAddress = 'no-reply@' . ($host ?: 'localhost');

$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: text/plain; charset=UTF-8';
$headers[] = 'From: Newlife Child Rescue <' . $fromAddress . '>';
$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
$headers[] = 'X-Mailer: PHP/' . phpversion();

$sent = @mail($recipient, $subject, $body, implode("\r\n", $headers), '-f' . $fromAddress);

if ($sent) {
    header('Location: ' . $redirect, true, 303);
    exit;
}

http_response_code(500);
echo 'Message could not be sent. Your hosting provider may require SMTP or mail support enabled.';
