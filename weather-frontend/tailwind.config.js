/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./app/**/*.{js,ts,jsx,tsx}",
      "./components/**/*.{js,ts,jsx,tsx}",
      "node_modules/rippleui/dist/**/*.js" 
    ],
    theme: {
      extend: {
        colors: {
            
          },
      },
    },
    plugins: [
      require("rippleui")
    ],
    rippleui: {
      themes: ["light"],
    },
  };