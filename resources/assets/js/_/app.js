require('../bootstrap');
import Vue from 'vue';
import Buefy from 'buefy';
import VueRouter from 'vue-router';
import router from './routes/routes';
import store from './store/index';


Vue.use(Buefy);
Vue.use(VueRouter);

window.Vue = require('vue');

Vue.component('main1', require('./Main.vue'));


window.vue = new Vue({
    mounted() {
        //vedem daca userul este autentificat atunci cand dam refresh la pagina deoarece state-ul din vuex se sterge la refresh

    },
    store: store,
    router,
    el: '#app',
});
