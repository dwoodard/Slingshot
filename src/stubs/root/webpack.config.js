// webpack.config.js
const path = require('path');

module.exports = {
  resolve: {
    fallback: {
      fs: false
    },
    alias: {
      '@': path.resolve('resources/js'),
      ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue')
    }
  }
};
