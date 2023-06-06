require("dotenv").config();
const { join } = require("path");
const { copySync, removeSync } = require("fs-extra");

module.exports = {
    ssr: true,

    srcDir: __dirname,

    env: {
        apiUrl: process.env.API_URL || process.env.APP_URL + "/api",
        appName: process.env.APP_NAME || "Laravel Nuxt",
        appLocale: process.env.APP_LOCALE || "en",
        githubAuth: !!process.env.GITHUB_CLIENT_ID,
    },

    head: {
        title: process.env.APP_NAME,
        titleTemplate: "%s - " + process.env.APP_NAME,
        meta: [
            { charset: "utf-8" },
            {
                name: "viewport",
                content: "width=device-width, initial-scale=1",
            },
            {
                hid: "description",
                name: "description",
                content: "Achalendra Outdoor, Rental Alat Kemah dan mendaki.",
            },
        ],
        link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
    },

    loading: { color: "#007bff" },

    router: {
        middleware: ["locale", "check-auth"],
    },

    css: [{ src: "~/assets/sass/app.scss", lang: "scss" }],

    plugins: [
        "~/components/global",
        "~/plugins/vuetify.js",
        "~/plugins/i18n",
        "~/plugins/vform",
        "~/plugins/axios",
        "~/plugins/fontawesome",
        "~/plugins/vue-repeater",
        "~/plugins/nuxt-client-init",
        { src: "~plugins/bootstrap", mode: "client" },
    ],

    modules: ["@nuxtjs/router"],

    buildModules: ["@nuxtjs/vuetify"],
    vuetify: {
        customVariables: ["~/assets/sass/vuetify-variable.scss"],
    },

    build: {
        extractCSS: true,
    },
};
