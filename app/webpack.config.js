let Encore = require('@symfony/webpack-encore');

/** Configs **/
let loaders = {
    imageLoader: {
        test: /\.(svg)$/i,
        loader: 'image-webpack-loader',
        options: {}
    }
}

let files = {
    reactStyle: [
        './assets/css/reset.css',
        './assets/css/app.scss',
    ],
    mockUpStyle: [
        './assets/css/reset.css',
        './assets/css/mock_up/variables.scss',
        './assets/css/mock_up/common.scss',
        './assets/css/mock_up/base.scss',
        './assets/css/mock_up/wqhd.scss'
    ],
    loginStyle: [
        './assets/css/reset.css',
        './assets/css/login.scss'
    ]
}

/** React config **/
Encore
    .setOutputPath('public/react_build/')
    .setPublicPath('/react_build')
    .addEntry('app', './assets/js/front_end/index.jsx')
    .addStyleEntry('style', files.reactStyle)
    .copyFiles({
        from: './assets/vector',
        to: 'images/[name].[ext]',
        pattern: /\.(svg)$/
    })
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })
    .enableSingleRuntimeChunk()
    .enableSassLoader()
    .addLoader(loaders.imageLoader)
    .enableReactPreset()
;

const reactConfig = Encore.getWebpackConfig();
reactConfig.name = 'reactConfig';

Encore.reset();

/** MockUp config **/
Encore
    .setOutputPath('public/mock_up_build/')
    .setPublicPath('/mock_up_build')
    .addEntry('mock_up', './assets/js/mock_up/index.js')
    .addStyleEntry('style', files.mockUpStyle)
    .copyFiles({
        from: './assets/vector',
        to: 'images/[name].[ext]',
        pattern: /\.(svg)$/
    })
    .cleanupOutputBeforeBuild()
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })
    .enableSingleRuntimeChunk()
    .enableSassLoader()
    .addLoader(loaders.imageLoader)
;

const mockUpConfig = Encore.getWebpackConfig();
mockUpConfig.name = 'mockUpConfig';

Encore.reset();

/** Login config **/
Encore
    .setOutputPath('public/login_build/')
    .setPublicPath('/login_build')
    .addStyleEntry('style', files.loginStyle)
    .cleanupOutputBeforeBuild()
    .enableSassLoader()
    .disableSingleRuntimeChunk()
;

const loginConfig = Encore.getWebpackConfig();
loginConfig.name = 'loginConfig';

module.exports = [reactConfig, mockUpConfig, loginConfig];
