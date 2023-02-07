/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        colors: {
            skyBlue: "#8ecae6ff",
            blueGreen: "#219ebcff",
            prussianBlue: "#023047ff",
            selectiveYellow: "#ffb703ff",
            utOrange: "#fb8500ff",
            lightGray: "#EDEAE9",
        },
        extend: {},
        fontFamily: {
            roboto: ["Roboto", "sans-serif"],
        },
    },
    plugins: [require("flowbite/plugin")],
};
