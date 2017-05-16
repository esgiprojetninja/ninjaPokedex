module.exports = {
   entry: './js/app.js',

   output: {
      path: __dirname + '/dist/js',
      filename: 'pokedex.js',
   },

   devServer: {
      inline: true,
      port: 9998
   },

   module: {
      loaders: [
         {
            test: /\.jsx?$/,
            exclude: /node_modules/,
            loader: 'babel-loader',

            query: {
              plugins: ['transform-decorators-legacy' ],
              presets: ['es2015', 'stage-0', 'react']
            }
         }
      ]
   }
}
