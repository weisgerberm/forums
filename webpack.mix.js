// Import Node's path module for some operations.
const path = require('path');

// Import Mix.
const mix = require('laravel-mix');

// Custom override rule needed for icon font generation (see below).
const iconfontRule = {
  use: [
    {
      'loader': 'css-loader',
      'options': {
        'url': require('./_webpack/url-check')
      },
    },
  ],
};

// Define targets depending on env variable (default is all).
const targets = {
  scripts: process.env.MODE === 'styles' ? false : true,
  styles: process.env.MODE === 'scripts' ? false : true,
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

// Enable the creation of source maps if in development mode.
if (process.env.NODE_ENV === 'development') {
  // Generally enable source maps.
  mix.sourceMaps();

  // Fix source maps generation (https://github.com/JeffreyWay/laravel-mix/issues/1793).
  mix.webpackConfig({
    devtool: 'source-map',
  });
}

// Use custom cache identifier for babel-loader that includes the browserslistrc to make sure that changes in there are recognized immediately.
mix.babelConfig({
  cacheIdentifier: require('./_webpack/babel-cache-identifier')(),
});

// Set some options.
mix.options({
  // Disable preprocessing of urls (https://laravel-mix.com/docs/4.0/css-preprocessors#css-url-rewriting).
  processCssUrls: false,

  // Enable more PostCSS plugins.
  postCss: [
    require('iconfont-webpack-plugin')({
      resolve: require('./_webpack/resolve-svg-path'),
      fontNamePrefix: 'datamints-',
    }),
    require('css-mqpacker')(),
  ],
});

// Define base paths.
const sourcePath = path.join('Resources/Source');
const targetPath = path.join('Resources/Public');


// Set up Mix compilations:
// 1. Scripts.
if (targets.scripts) {
  mix.js(path.join(sourcePath, 'Scripts/forums.js'), path.join(targetPath, 'Scripts'));
}
// 2. Styles.
if (targets.styles) {
  const sassArguments = { sassOptions: { quietDeps: true }};
  mix.sass(path.join(sourcePath, 'Styles/forums.scss'), path.join(targetPath, 'Styles'), sassArguments);

  // Modify webpack configuration to allow certain urls (those for the icon font) to be handled by the css-loader plugin;
  // this is necessary as otherwise a strange webpack loader url is contained in the resulting CSS.
  mix.webpackConfig({
    module: {
      rules: [
        Object.assign(
          {},
          iconfontRule,
          {
            test: path.resolve(path.join(sourcePath, 'Styles/forums.scss'))
          }
        ),
        Object.assign(
          {},
          iconfontRule,
          {
            test: path.resolve(path.join(sourcePath, 'Styles/rte.scss')),
          }
        ),
      ],
    },
  });
}


/*
// Start bundle analyzer to identify problems in your build.
// @see https://dev.to/ratracegrad/how-to-reduce-your-vue-js-bundle-size-with-webpack-4gpf
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
mix.webpackConfig({
	plugins: [new BundleAnalyzerPlugin()],
});
*/

/*
// Dump the generated Webpack configuration (for debugging).
mix.dump();
*/

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(src, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(src, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(src, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.override(function (webpackConfig) {}) <-- Will be triggered once the webpack config object has been fully generated by Mix.
// mix.dump(); <-- Dump the generated webpack config object to the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
