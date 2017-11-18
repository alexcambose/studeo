import config from '../../../config';
import { NEW_COURSE_ADD_LESSON, NEW_COURSE_DELETE_LESSON, NEW_COURSE_UPDATE_DATA, NEW_COURSE_LESSON_ORDER_UP, NEW_COURSE_LESSON_ORDER_DOWN } from '../mutators-types';

const state = {
    title: 'Titlu curs',
    shortDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget rhoncus diam sollicitudin in. Aenean dapibus aliquet pulvinar. Suspendisse potenti. ',
    description: ' Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst.  Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst.  Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst. v Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst. ',
    difficulty: 3,
    prerequisites: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit am mauris et sem rhoncus iaculLorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget mauris et sem rhoncus iacul',
    purpose: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    lessons: [
        {
            id: Date.now(),
            title: 'Primul curs 0',
            shortDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,',
            content: 'Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget ',
            order_index: 0,
        },
        {
            id: Date.now()+ 1000,
            title: 'Primul curs 1',
            shortDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,',
            content: 'Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget ',
            order_index: 1,
        },
        {
            id: Date.now()+ 2000,
            title: 'Primul curs 2',
            shortDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,',
            content: 'Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget ',
            order_index: 2,
        },
    ],
};

const getters = {
    newLessons: state => {
        const lessons = [...state.lessons];
        lessons.sort((a, b) => a.order_index - b.order_index);
        return lessons;
    },
    newLessonById: state => id => {
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
    deleteLesson({ commit }, id) {
        commit(NEW_COURSE_DELETE_LESSON, id);
    },
    lessonOrderUp({ commit, getters }, id) {
        if (getters.newLessonById(id).order_index > 0) {
            commit(NEW_COURSE_LESSON_ORDER_UP, id);
        }
    },
    lessonOrderDown({ commit, state }, id) {
        const index = state.lessons.findIndex(e => e.id === id);
        if (state.lessons[index].order_index < state.lessons.length-1) {
            commit(NEW_COURSE_LESSON_ORDER_DOWN, id);
        }
    },
    updateNewCourseData({ commit }, data) {
        commit(NEW_COURSE_UPDATE_DATA, data);
    },
};


const mutations = {
    [NEW_COURSE_ADD_LESSON] (state, payload) {
        state.lessons.push({ ...payload, order_index: state.lessons.length });
    },
    [NEW_COURSE_DELETE_LESSON] (state, id) {
        const index = state.lessons.findIndex(e => e.id === id);
        for (let i = 0; i < state.lessons.length; i++) {
            if (state.lessons[index].order_index < state.lessons[i].order_index) {
                state.lessons[i].order_index--;
            }
        }
        state.lessons.splice(index, 1);
    },
    [NEW_COURSE_UPDATE_DATA] (state, data) {
        state = Object.assign(state, data);
    },
    [NEW_COURSE_LESSON_ORDER_UP] (state, id) {
        const indexA = state.lessons.findIndex(e => e.id === id); // elementul pe care am apasat
        const indexB = state.lessons.findIndex(e => e.order_index === state.lessons[indexA].order_index - 1); // elementul de mai sus
        // interschimbare smechera
        state.lessons[indexA].order_index = [state.lessons[indexB].order_index, state.lessons[indexB].order_index = state.lessons[indexA].order_index][0];
    },
    [NEW_COURSE_LESSON_ORDER_DOWN] (state, id) {
        const indexA = state.lessons.findIndex(e => e.id === id);
        const indexB = state.lessons.findIndex(e => e.order_index === state.lessons[indexA].order_index + 1); // elementul de mai jos
        // interschimbare normala
        const aux = state.lessons[indexA].order_index;
        state.lessons[indexA].order_index = state.lessons[indexB].order_index;
        state.lessons[indexB].order_index = aux;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
}