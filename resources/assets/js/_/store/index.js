import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';
import notification from './modules/notification';
import newCourse from './modules/newCourse';

Vue.use(Vuex);
const store = new Vuex.Store({
    strict: true,
    modules: {
        user,
        notification,
        newCourse,
    },
});

export default store;