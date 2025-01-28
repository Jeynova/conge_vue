const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/app.js')
    .enableVueLoader()
    .splitEntryChunks()
    .enableStimulusBridge('./assets/controllers.json')
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })

    .enableSassLoader() // Si tu utilises des fichiers SCSS
    ;

// Configure le serveur de développement pour gérer le routage de Vue.js
const config = Encore.getWebpackConfig();

if (!Encore.isProduction()) {
    config.devServer = {
        historyApiFallback: true, // Redirige toutes les requêtes vers le fichier index.html
        allowedHosts: 'all', // Permet à tous les hôtes d'accéder au serveur
        hot: true, // Active le rechargement à chaud
        static: {
            directory: __dirname + '/public', // Sert les fichiers statiques depuis le répertoire public
        },
        devMiddleware: {
            publicPath: '/build/', // Chemin public pour accéder aux fichiers compilés
        },
    };
}

module.exports = config;