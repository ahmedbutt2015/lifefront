import './bootstrap';
import Vue from 'vue';
// import vuetify from '@/js/plugins/vuetify';

import Route from '@/js/routes';

import App from '@/js/layouts/Auth';

const app = new Vue({
    el: '#app',

    router: Route,
    render: h => h(App),
});

