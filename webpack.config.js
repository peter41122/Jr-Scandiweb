const HtmlWebpackPlugin = require('html-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const path = require('path');

module.exports = {
  watch: true,
  entry: './src/views/js/main.js',
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public/assets'),
   },
  module: {
    rules: [

      { test: /\.vue$/, use: 'vue-loader' },
      { test: /\.css$/, use: ['vue-style-loader', 'css-loader']},
    ]
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: './src/views/index.blade.php',
    }),
    new VueLoaderPlugin(),
  ]
};