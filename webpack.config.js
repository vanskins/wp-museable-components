const path = require("path");

module.exports = {
  mode: "development", // Use 'development' mode for faster builds
  resolve: {
    extensions: [".js", ".jsx"], // Automatically resolve these extensions
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/, // Match JavaScript/JSX files
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env", "@babel/preset-react"], // Enable ES6 and React syntax
          },
        },
      },
      {
        test: /\.css$/, // Match CSS files
        use: ["style-loader", "css-loader"],
      },
    ],
  },
  output: {
    filename: "[name].bundle.js", // Filename for bundled files
    path: path.resolve(__dirname, "dist"), // Output directory
  },
};
