const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.options({
    hmrOptions: {
        host: '0.0.0.0',
    }
});


// mix
//     .js('resources/js/main.js', 'public/dist')
//     .js('resources/js/profile.js', 'public/dist')
//     .js('resources/js/docs.js', 'public/dist')
//     .js('resources/js/map.js', 'public/dist')
//     .sass('resources/sass/app.scss', 'public/dist')
//     .extract(['vue', 'bootstrap-vue', 'vue-router', 'lodash', 'axios'])
//     .copyDirectory('resources/img', 'public/img');
