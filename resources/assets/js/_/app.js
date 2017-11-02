import Vue from 'vue';
import Buefy from 'buefy';
import VueRouter from 'vue-router';
import router from './routes/routes';
import store from './store/index';
require('../bootstrap');

Vue.use(Buefy);
Vue.use(VueRouter);

window.Vue = require('vue');
Vue.component('main1', require('./Main.vue'));
const app = new Vue({
    store: store,

    router,
    el: '#app',
});
