const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
 mix.js('resources/js/app.js', 'public/js')
    .react()
    .js('resources/js/index.js', 'public/js')
    .js('resources/js/contact-us.js', 'public/js')
     .js('resources/js/meeting_calendar.js', 'public/js')
     .js('resources/js/create_meeting.js', 'public/js')
     .js('resources/js/count-text.js', 'public/js')
    .sass('resources/scss/button.scss', 'public/css')
    .sass('resources/scss/form.scss', 'public/css')
    .sass('resources/scss/style.scss', 'public/css')
    .sass('resources/scss/welcome.scss', 'public/css')
    .sass('resources/scss/users-style.scss', 'public/css')
    .sass('resources/scss/admin_chatroom.scss', 'public/css')
    .sass('resources/scss/contact-us.scss', 'public/css')
    .sass('resources/scss/modal.scss', 'public/css')
    .sass('resources/scss/faq.scss', 'public/css')
    .sass('resources/scss/event.scss', 'public/css')
    .sass('resources/scss/privacy_terms.scss', 'public/css')
    .sass('resources/scss/admin-style.scss', 'public/css')
    .sass('resources/scss/meeting_calendar.scss', 'public/css')
    .sass('resources/scss/follow.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')


.sourceMaps();
