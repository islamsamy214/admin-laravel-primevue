const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss"); /* Add this line at the top */
const path = require("path");
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js("resources/js/app.js", "public/js")
    .autoload({
        jquery: ["$", "window.jQuery"],
    })
    .sourceMaps()
    .sass("resources/sass/app.scss", "public/css")
    .options({
        postCss: [tailwindcss("./tailwind.config.js")],
    })
    .vue({ version: 3 })
    .disableNotifications()
    .version();
