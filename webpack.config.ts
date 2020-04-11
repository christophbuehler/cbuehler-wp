const path = require('path');

module.exports = [
  {
    entry: ".\\src\\main.ts",
    output: {
      filename: "cbuehler.min.js",
      library: "cbuehler",
      libraryExport: "default",
      path: path.resolve(__dirname, 'assets'),
    },
    resolve: {
      extensions: [".ts", ".tsx"],
    },
    module: {
      rules: [
        {
          test: /\.tsx?$/,
          use: "ts-loader",
        },
        {
          test: /\.s[ac]ss$/i,
          use: ["style-loader", "css-loader", "sass-loader"],
        },
      ],
    },
  },
];
