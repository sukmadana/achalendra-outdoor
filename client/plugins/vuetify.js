import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);

export default (ctx) => {
    const vuetify = new Vuetify({
        theme: {
            themes: {
                light: {
                    primary: '#3D4E17',
                    secondary: '#C7A003',
                    tertiary: '#151F1E',
                    accent: '#82B1FF',
                    error: '#f55a4e',
                    info: '#00d3ee',
                    success: '#5cb860',
                    warning: '#ffa21a',
                },
            },
        },
        icons: {
            iconfont: 'mdi',
        },
    });

    ctx.app.vuetify = vuetify;
    ctx.$vuetify = vuetify.framework;
};