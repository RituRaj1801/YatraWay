/** @type {import('tailwindcss').Config} */
export default {
  content: ['./resources/**/*.blade.php', './resources/**/*.js'],
  theme: {
    extend: {
      fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
      colors: { ink: '#17211b', forest: '#0f4c3a', mist: '#eef6f1', sand: '#f4b860' },
      boxShadow: { soft: '0 18px 50px rgba(15, 76, 58, 0.10)' }
    }
  },
  plugins: [require('@tailwindcss/forms')]
};
