Newlife Child Rescue Buwagani
=============================

Folder layout
-------------
Everything is kept in one flat folder:
- index.html, about.html, programs.html, impact.html, gallery.html, donate.html, contact.html, thank-you.html
- styles.css, script.js
- NewlifeServer.java
- logo.jpg, cover.jpg, programs.jpg, gallery.jpg, contact.jpg

How to run locally
------------------
1. Open any HTML file directly in a browser, or
2. Run the Java server:

   javac NewlifeServer.java
   java NewlifeServer

   Then visit http://localhost:8080

Form submission setup
---------------------
Contact and donation forms are connected to FormSubmit so messages go to:
ekobuemmanuel06@gmail.com

Steps to receive submissions:
1. Keep the form action pointed to FormSubmit.
2. Submit one test message from the live site.
3. Open the verification email that FormSubmit sends and confirm the address.
4. Replace the _next value with the final hosted thank-you page URL when the site goes live.
5. Submit another test message to confirm that the email arrives correctly.

Current payment details
-----------------------
MTN Mobile Money receiver number: 256761793420
Airtel Money receiver number: 256746311507
Donation confirmation email: ekobuemmanuel06@gmail.com

Notes
-----
- The website uses a pure white visual theme with a dark footer.
- Donation confirmations are sent by form to the charity email.
- Real money transfers are completed through MTN, Airtel, or Western Union directly, and the website collects the confirmation message.
