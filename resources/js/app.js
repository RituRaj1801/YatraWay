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

  const slider = document.querySelector('[data-hero-slider]');
  if (!slider) return;

  const slides = Array.from(slider.querySelectorAll('[data-hero-slide]'));
  const dots = Array.from(slider.querySelectorAll('[data-hero-dot]'));
  const eyebrow = slider.querySelector('[data-hero-eyebrow]');
  const title = slider.querySelector('[data-hero-title]');
  const subtitle = slider.querySelector('[data-hero-subtitle]');
  const description = slider.querySelector('[data-hero-description]');
  const texts = Array.isArray(window.__heroSlides) ? window.__heroSlides : [];

  let active = 0;
  let timer;

  const applyText = (index) => {
    const item = texts[index];
    if (!item) return;
    if (eyebrow) eyebrow.textContent = item.eyebrow || '';
    if (title) title.textContent = item.title || '';
    if (subtitle) subtitle.textContent = item.subtitle || '';
    if (description) description.textContent = item.description || '';
  };

  const show = (index) => {
    active = index;
    slides.forEach((slide, i) => slide.classList.toggle('is-active', i === index));
    dots.forEach((dot, i) => {
      dot.classList.toggle('bg-sand', i === index);
      dot.classList.toggle('bg-white/40', i !== index);
    });
    applyText(index);
  };

  const next = () => show((active + 1) % slides.length);

  const start = () => {
    clearInterval(timer);
    if (slides.length > 1) timer = setInterval(next, 5500);
  };

  dots.forEach((dot) => {
    dot.addEventListener('click', () => {
      show(Number(dot.dataset.heroDot || 0));
      start();
    });
  });

  show(0);
  start();
});
