const { defineConfig } = require("cypress");
const webpackConfig = require("./webpack.config.js");
const { startDevServer } = require("@cypress/webpack-dev-server");

module.exports = defineConfig({
  component: {
    devServer: {
      framework: "react", // or 'vue' if you’re using Vue
      bundler: "webpack",
      webpackConfig, // Import and apply your custom Webpack config
      setupDevServer(on, config) {
        on("dev-server:start", (options) =>
          startDevServer({ options, webpackConfig })
        );
        return config;
      },
    },
  },
});
