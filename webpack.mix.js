const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const webpack = require("webpack");
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
    .webpackConfig({
        plugins: [
            new webpack.DefinePlugin({
                __VUE_I18N_FULL_INSTALL__: false,
                __VUE_I18N_LEGACY_API__: false,
                __VUE_I18N_PROD_DEVTOOLS__: false,
            }),
        ],
    })
    .disableNotifications()
    .version();
