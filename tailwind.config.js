/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/Views/**/*.php", "./app/Views/**/*.html"],
  theme: {
    extend: {
      colors: {
        'primary': '#0832DE',
        'secondary': {
          100: '#E2E2D5',
          200: '#888883',
        }
      },
    },
  },
  plugins: [],
}

