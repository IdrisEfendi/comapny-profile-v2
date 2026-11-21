/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './application/views/**/*.php',
    './application/views/**/*.blade.php',
    './application/controllers/**/*.php',
    './packages/admin/views/**/*.php',
    './packages/admin/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          50: '#edf3ef',
          100: '#d9e6df',
          500: '#47776b',
          600: '#34665d',
          700: '#28544c',
          800: '#173f46',
          900: '#102b35',
        },
        accent: {
          500: '#d6a64b',
          600: '#9a742b',
        },
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        soft: '0 18px 45px rgba(15, 23, 42, 0.08)',
      },
    },
  },
  plugins: [],
};
