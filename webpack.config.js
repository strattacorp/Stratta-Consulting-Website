const path = require('path');

module.exports = {
  entry: './src/index.js', // ponto de entrada do seu código
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'dist'), // saída do build
  },
  module: {
    rules: [
      {
        test: /\.(png|jpe?g)$/i,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'images',
            },
          },
          {
            loader: 'image-webpack-loader',
            options: {
              mozjpeg: { progressive: true, quality: 75 },
              webp: { quality: 75 },
              avif: { quality: 50 },
            },
          },
        ],
      },
    ],
  },
};
