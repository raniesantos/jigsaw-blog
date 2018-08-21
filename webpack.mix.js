let mix = require('laravel-mix');
let build = require('./tasks/build.js');

mix.disableSuccessNotifications();
mix.setPublicPath('source');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch(['source/**/*.md', 'source/**/*.php', 'source/**/*.scss', '!source/**/_tmp/*'])
    ]
});

mix
    .js('source/_assets/js/main.js', 'js')
    .extract([
        'vue', 'vee-validate', 'axios', 'qs',
        'vue-social-sharing', 'vue-disqus',
        'highlight.js/lib/highlight',
        'highlight.js/lib/languages/xml',
        'highlight.js/lib/languages/css',
        'highlight.js/lib/languages/scss',
        'highlight.js/lib/languages/javascript',
        'highlight.js/lib/languages/json',
        'highlight.js/lib/languages/php',
        'highlight.js/lib/languages/apache',
        'highlight.js/lib/languages/yaml',
        'highlight.js/lib/languages/markdown',
        'highlight.js/lib/languages/handlebars',
        'highlight.js/lib/languages/bash',
        'highlight.js/lib/languages/shell'
    ])
    .sass('source/_assets/sass/main.scss', 'css')
    .sass('source/_assets/sass/vendor.scss', 'css')
    .version();
