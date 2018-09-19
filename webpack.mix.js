let mix = require('laravel-mix');

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

const appPath = path.resolve(__dirname, 'resources', 'assets', 'js');

mix.webpackConfig({
   node: {
     fs: "empty"
   },
   output: {
       chunkFilename: 'js/chunks/[name].js',
   },
   module: {
       rules: [
         {
           enforce: 'pre',
           test: /\.(js|vue)$/,
           loader: 'eslint-loader',
           exclude: /node_modules/
         }
       ],
       loaders: [
         {
             test: /\.jsx$/,
             loader: 'babel'
         },
         {
             test: /\.js$/,
             loader: 'babel',
             exclude: /node_modules/
         },
         {
             test: /\.ejs$/,
             loader: 'ejs-loader',
         },
        ],
    },
    resolve: {
        alias: {
            // 'vue$': 'vue/dist/vue.runtime.esm.js',
            'axios': 'axios/dist/axios.min.js',
            'components': path.resolve(appPath, 'components'),
            'lang': path.resolve(appPath, 'lang'),
            'utils': path.resolve(appPath, 'utils'),
        }
    }
});

if (!mix.inProduction()) {
   mix.browserSync({
       open: 'external',
       host: 'ei.b2systems.test',
       proxy: 'ei.b2systems.test',
       browser: "google chrome",
       files: [
           'resources/views/**/*.php',
           'public/js/**/*.js',
           'public/css/**/*.css',
       ]
   });
}

mix.setPublicPath('public')
   .options({
     uglify: {
         uglifyOptions: {
             compress: {
                 drop_console: true,
                 warnings: false,
                 conditionals: true,
                 unused: true,
                 comparisons: true,
                 sequences: true,
                 dead_code: true,
                 evaluate: true,
                 if_return: true,
                 join_vars: true,
             }
         }
     }
   })
   .js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/theme.scss', 'public/css')
   .styles(['node_modules/normalize.css/normalize.css'], 'public/css/reset.css')
   .extract(['vue', 'element-ui', 'axios'])
   .copy('storage/app/public/img', 'public/img')
   .version();
