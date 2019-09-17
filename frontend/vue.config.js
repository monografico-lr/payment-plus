const env = require('./.env.js');
module.exports = {
  // proxy API requests to Valet during development
  devServer: {
    proxy: env.proxy || 'http://payment-plus.test/',
  },

  // output built static files to Laravel's public dir.
  // note the "build" script in package.json needs to be modified as well.
  outputDir: '../public',

  filenameHashing: false,
  // delete HTML related webpack plugins
  chainWebpack: config => {
    if (process.env.NODE_ENV === 'production') {
      config.plugins.delete('html');
      config.plugins.delete('preload');
      config.plugins.delete('prefetch');
    }
  },

  // modify the location of the generated HTML file.
  // make sure to do this only in production.
  indexPath:
    process.env.NODE_ENV === 'production'
      ? '../resources/views/vueindex.php'
      : 'index.html',
};
