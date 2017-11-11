import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';
import notification from './modules/notification';

Vue.use(Vuex);
const store = new Vuex.Store({
    strict: true,
    modules: {
        user,
        notification,
    }
});

export default store;