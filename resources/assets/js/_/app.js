require('../bootstrap');
import config from '../config';
import Vue from 'vue';
import Buefy from 'buefy';
import VueRouter from 'vue-router';
import router from './routes/routes';
import store from './store/index';


Vue.use(Buefy);
Vue.use(VueRouter);

window.Vue = require('vue');

Vue.component('main1', require('./Main.vue'));
const app = new Vue({
    mounted() {
        //vedem daca userul este autentificat atunci cand dam refresh la pagina deoarece state-ul din vuex se sterge la refresh
        axios.post(config.USER).then(({ data }) => {
           if(data.success) this.$store.dispatch('setuser', data.user);
           else this.$store.dispatch('logout');
        });
    },
    store: store,
    router,
    el: '#app',
});
