let mix = require('laravel-mix');

mix
    .setPublicPath('./')
    .coffee([
        // 'resources/assets/coffee/simplebox.coffee',
        // 'resources/assets/coffee/defer-image-load.coffee',
        // 'resources/assets/coffee/frank.slideshow.coffee'
    ], './frank.js')
    .sass('resources/assets/scss/style.scss', './style.css')
    .version();
