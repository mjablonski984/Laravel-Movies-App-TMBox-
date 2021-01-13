const mix = require('laravel-mix');
require('laravel-mix-purgecss');// purge css

// To use laravel-mix-purgecss with postCss (instead of sass) require tailwind in options->postCss

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .options({
         postCss: [require('tailwindcss')]
        })
    .purgeCss();
