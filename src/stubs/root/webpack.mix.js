const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
  .vue()
  .browserSync('https://localhost')
  .postCss('resources/css/app.css', 'public/css', [
    //
  ])
;
