/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "partials/**/*.dust",
  ],
  theme: {
    extend: {
      aspectRatio: {
        "fourthree": "4 / 3",
      },
      fontSize: {
        'number': '2.9rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
