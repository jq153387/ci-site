const path = require("path");
const UglifyWebpackPlugin = require("uglifyjs-webpack-plugin");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const BundleAnalyzerPlugin = require("webpack-bundle-analyzer")
    .BundleAnalyzerPlugin;
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
module.exports = (env, options) => {
    const mode = options.mode || "development";
    const isDevEnv = mode === "development";
    return {
        entry: ["@babel/polyfill", "./src/index.js"],
        output: {
            filename: isDevEnv
                ? "[name].index.bundle.js"
                : "[name].[chunkhash].index.bundle.js",
            chunkFilename: isDevEnv
                ? "[name].bundle.js"
                : "[name].[chunkhash].bundle.js",
            path: path.resolve(
                "../../../../../assets/admin/default/app/album/",
                isDevEnv ? "dist" : "app"
            ),
            publicPath: isDevEnv
                ? "/assets/admin/default/app/album/dist/"
                : "/assets/admin/default/app/album/app/",
        },
        module: {
            rules: [
                {
                    test: /\.m?js$/,
                    exclude: /(node_modules|bower_components)/,
                    use: {
                        loader: "babel-loader",
                        options: {
                            presets: [
                                "@babel/preset-env",
                                "@babel/preset-react",
                            ],
                        },
                    },
                },
                {
                    test: /\.css$/,
                    use: [
                        isDevEnv ? "style-loader" : MiniCssExtractPlugin.loader,
                        "css-loader",
                    ],
                },
                {
                    test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
                    loader: "file-loader",
                    query: {
                        name: "[name].[ext]",
                        outputPath: "/assets/admin/default/app/album/img",
                        publicPath: isDevEnv
                            ? "/assets/admin/default/app/album/img"
                            : "/assets/admin/default/app/album/img",
                    },
                },
            ],
        },
        optimization: {
            runtimeChunk: "single",
            splitChunks: {
                // cacheGroups: {
                //     commons: {
                //         test: /(react|react-dom|react-dom-router|react-router|babel|axios|react-redux|react-thunk|redux|redux-thunk|rc-table)/,
                //         name: "commons",
                //         chunks: "all",
                //         filename: "[name].[chunkhash].bundle.js"
                //     }
                // }
            },
            minimizer: [
                new UglifyWebpackPlugin({
                    uglifyOptions: {
                        compress: {
                            collapse_vars: false,
                        },
                    },
                }),
            ],
        },
        plugins: [
            new HtmlWebpackPlugin({
                filename: path.resolve(__dirname) + "/index.php",
                template: "./index.html",
                //chunks: ["commons", "Settlement", "main"] //需要引入的chunk，不配置就会引入所有页面的资源}
            }),
            new BundleAnalyzerPlugin(),
            new MiniCssExtractPlugin({
                // Options similar to the same options in webpackOptions.output
                // both options are optional
                filename: "[name].[chunkhash].css",
                chunkFilename: "[name].[chunkhash].css",
            }),
            new OptimizeCssAssetsPlugin(),
        ],
    };
};
