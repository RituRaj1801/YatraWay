import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  const menu = document.querySelector('[data-mobile-menu]');
  const button = document.querySelector('[data-menu-button]');
  if (menu && button) button.addEventListener('click', () => menu.classList.toggle('hidden'));

  document.querySelectorAll('[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!window.confirm(form.dataset.confirm)) event.preventDefault();
    });
  });
});
