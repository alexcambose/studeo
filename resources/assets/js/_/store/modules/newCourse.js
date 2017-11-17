import config from '../../../config';
import { NEW_COURSE_ADD_LESSON } from '../mutators-types';

const state = {
    title: '',
    short_description: '',
    description: '',
    lessons: [
        {
            id: Date.now(),
            title: 'Primul curs',
            short_description: '',
        },
    ],
};

const getters = {
    getNewLessonById: state => id => {
        return state.lessons.find(e => e.id === id);
    },
};

const actions = {
    addNewLesson ({ commit }, { title, description }) {
        commit(NEW_COURSE_ADD_LESSON, {
            id: Date.now(),
            title,
            description,
        });
    },
};


const mutations = {
    [NEW_COURSE_ADD_LESSON] (state, payload) {
        state.lessons.push(payload);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
}