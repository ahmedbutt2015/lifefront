// webpack.config.js
const mix = require('laravel-mix');
mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources'
        },

    },
})
mix
.js('resources/js/app.js', 'public/js')
.js('resources/js/logins.js', 'public/js')
.sass('resources/sass/app.scss','public/css');
