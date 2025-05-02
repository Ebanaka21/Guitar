import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
// tailwind.config.js
export default {
  darkMode: 'class', // Включаем использование класса .dark для темной темы
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Определяем стандартные цвета для светлой темы
        background: 'white',
        text: 'black',

        // Определяем стандартные цвета для темной темы
        'background-dark': '#121212',
        'text-dark': 'white',

        // Добавьте любые другие цвета, которые хотите использовать
        primary: '#4F46E5', // Пример цвета для primary
        secondary: '#F472B6', // Пример цвета для secondary
        accent: '#10B981', // Пример цвета для accent
      },

      // Вы можете добавлять свои шрифты
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [forms],
};
