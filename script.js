
const menuBtn = document.querySelector('[data-menu-btn]');
const nav = document.querySelector('[data-nav]');

if (menuBtn && nav) {
  const closeNav = () => {
    nav.classList.remove('open');
    menuBtn.classList.remove('open');
    menuBtn.setAttribute('aria-expanded', 'false');
  };

  menuBtn.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    menuBtn.classList.toggle('open', open);
    menuBtn.setAttribute('aria-expanded', String(open));
  });

  nav.querySelectorAll('a').forEach(link => link.addEventListener('click', closeNav));

  window.addEventListener('resize', () => {
    if (window.innerWidth > 820) closeNav();
  });
}

function txRef() {
  return 'NLCRB-' + Date.now().toString(36).toUpperCase() + '-' + Math.random().toString(36).slice(2, 8).toUpperCase();
}

document.querySelectorAll('[data-copy]').forEach(btn => {
  btn.addEventListener('click', async () => {
    const value = btn.getAttribute('data-copy') || '';
    try {
      await navigator.clipboard.writeText(value);
      const old = btn.textContent;
      btn.textContent = 'Copied';
      setTimeout(() => (btn.textContent = old), 1200);
    } catch {
      btn.textContent = 'Copy failed';
    }
  });
});

const tabs = document.querySelectorAll('[data-method]');
const panels = document.querySelectorAll('[data-method-panel]');
const donationMethodInputs = document.querySelectorAll('[data-donation-method-input]');

if (tabs.length && panels.length) {
  const setMethod = (method) => {
    tabs.forEach(btn => btn.classList.toggle('active', btn.dataset.method === method));
    panels.forEach(panel => panel.classList.toggle('active', panel.dataset.methodPanel === method));
    donationMethodInputs.forEach(input => input.value = method === 'SEND_WAVE' ? 'Send Wave' : method === 'AIRTEL' ? 'Airtel' : 'MTN');
  };

  tabs.forEach(btn => btn.addEventListener('click', () => setMethod(btn.dataset.method)));
  setMethod('MTN');
}

document.querySelectorAll('[data-ticket]').forEach(form => {
  form.addEventListener('submit', () => {
    const out = form.querySelector('[data-ticket-output]');
    if (out) out.value = txRef();
  });
});
