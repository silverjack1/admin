var path = require('path');
var webpack = require('webpack');
var UnminifiedWebpackPlugin = require('unminified-webpack-plugin');
module.exports = {
    // This is the "main" file which should include all other modules
    entry: {
        app: './src/js/app.js',
    },
    // Where should the compiled file go?
    output: {
        filename: './js/app.min.js',
        path: path.resolve(__dirname,'dist'),
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false,
                drop_console: true,
            }
        }),
        new UnminifiedWebpackPlugin()
    ],
    resolve: {
        alias: {
            vue: '../src/js/vue.js'
        }
    },
    module: {
        // Special compilation rules
        loaders: [
            {
                // Ask webpack to check: If this file ends with .js, then apply some transforms
                test: /\.js$/,
                // Transform it with babel
                loader: 'babel-loader',
                // don't transform node_modules folder (which don't need to be compiled)
                exclude: /node_modules/
            },
            {
                // Ask webpack to check: If this file ends with .vue, then apply some transforms
                test: /\.vue$/,
                // don't transform node_modules folder (which don't need to be compiled)
                exclude: /(node_modules|bower_components)/,
                // Transform it with vue
                use: {
                    loader: 'vue-loader'
                }
            },


        ],
        rules: [
            {
                test: /\.css$/,
                use: [ 'style-loader', 'css-loader' ]
            }
        ]
    },
    devServer: {
        port: 3000
    }
}
