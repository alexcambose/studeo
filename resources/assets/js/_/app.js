require('../bootstrap');
import Vue from 'vue';
import Buefy from 'buefy';
import { sync } from 'vuex-router-sync';
import VueRouter from 'vue-router';
import router from './routes/routes';
import store from './store/index';

sync(store, router);

Vue.use(Buefy);
Vue.use(VueRouter);


Vue.component('main1', require('./Main.vue'));


window.vue = new Vue({
    mounted() {
        axios.interceptors.response.use(function (response) {
            return response;
        }, function (error) {
            if(error.response.status === 419) {
                location.reload();
            }

        });
    },
    store: store,
    router,
    el: '#app',
});
