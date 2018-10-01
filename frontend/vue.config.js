module.exports = {
    // proxy API requests to Valet during development
    devServer: {
        proxy: "http://erp.icpayment/"
    },

    // output built static files to Laravel's public dir.
    // note the "build" script in package.json needs to be modified as well.
    outputDir: "../public",

    filenameHashing: false,
    // delete HTML related webpack plugins
    chainWebpack: config => {
        config.plugins.delete("html");
        config.plugins.delete("preload");
        config.plugins.delete("prefetch");
    },

    // modify the location of the generated HTML file.
    // make sure to do this only in production.
    // indexPath:
    //     process.env.NODE_ENV === "production"
    //         ? "../resources/views/index.blade.php"
    //         : "index.html"
};
