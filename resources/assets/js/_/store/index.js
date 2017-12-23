import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';
import notification from './modules/notification';
import newCourse from './modules/newCourse';
import course from './modules/course';
import playlist from './modules/playlist';

Vue.use(Vuex);
const store = new Vuex.Store({
    strict: true,
    modules: {
        playlist,
        user,
        notification,
        newCourse,
        course,
    },
});

export default store;
