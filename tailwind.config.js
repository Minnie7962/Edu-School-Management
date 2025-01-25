/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#3498db',
        secondary: '#f1c40f',
        success: '#2ecc71',
        danger: '#e74c3c',
      },
      fontFamily: {
        sans: ['Khmer OS Battambang','Open Sans', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

