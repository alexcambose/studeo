import config from '../../../config';
import Vue from 'vue';
import { NEW_COURSE_LESSON_QUESTION_ANSWER_ADD, NEW_COURSE_LESSON_QUESTION_ANSWER_DELETE, NEW_COURSE_LESSON_QUESTION_ANSWER_UPDATE, NEW_COURSE_LESSON_QUESTION_ADD, NEW_COURSE_LESSON_QUESTION_DELETE, NEW_COURSE_LESSON_QUESTION_UPDATE, NEW_COURSE_UPDATE_LESSON_DATA, NEW_COURSE_ADD_LESSON, NEW_COURSE_DELETE_LESSON, NEW_COURSE_UPDATE_DATA, NEW_COURSE_LESSON_ORDER_UP, NEW_COURSE_LESSON_ORDER_DOWN } from '../mutators-types';

const state = {
    title: 'Titlu curs',
    slug: 'titlu-curs',
    shortDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac ',
    description: ' Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst.  Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst.  Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst. v Sed eu ex sapien. In scelerisque massa diam, vel luctus dolor tincidunt vel. Etiam rhoncus mi nec rutrum tincidunt. Donec commodo nisl ante, at efficitur lorem semper et. Nunc eget aliquet augue. Phasellus ultrices est non metus aliquet fringilla. Fusce nec blandit justo. Suspendisse hendrerit, nunc et consectetur sagittis, ante mauris sollicitudin odio, nec ornare diam dolor at felis. Integer ut facilisis odio, sit amet congue orci. Curabitur feugiat convallis mauris in auctor. In hac habitasse platea dictumst. ',
    difficulty: 3,
    prerequisites: [
        '1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit am mauris et sem rhoncus iaculLorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget mauris et sem rhoncus iacul',
        '2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit am mauris et sem rhoncus iaculLorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget mauris et sem rhoncus iacul',
        '3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit a Aenean eget mauris et sem rhoncus iaculLorem ipsum dolor sit am mauris et sem rhoncus iaculLorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget mauris et sem rhoncus iacul',
    ],
    purpose: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    purposeWhatWillLearn: [
        '1. Lorem ipsum dolor sit amet',
        '2. Lorem ipsum dolor sit amet',
        '3. Lorem ipsum dolor sit amet',
    ],
    targetClassLevel: 2,
    image: null,
    lessons: [
        {
            id: 1,
            title: 'Lecția numărul 1',
            shortDescription: 'Lorem ipsum dolor  dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,',
            content: 'Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget ',
            questions: [],
            thumbnail: null,
            video: null,
            order_index: 0,
        },
        {
            id: 2,
            title: 'Lecția numărul 2',
            shortDescription: 'Lorem ipsum dolor  dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,',
            content: 'Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget ',
            questions: [
                {
                    content: 'What is the fastest animal in the world ?',
                    answers: [
                        { content: 'Peregrine falcon', isTrue: true },
                        { content: 'Cheetah', isTrue: false },
                        { content: 'Lion', isTrue: false },
                        { content: 'Turtle', isTrue: false },
                        { content: 'The happy little frog :)', isTrue: false },
                    ],
                },
                {
                    content: 'What is the tallest building in the world ?',
                    answers: [
                        { content: 'Shanghai Tower', isTrue: false },
                        { content: 'Abraj Al-Bait Clock Tower', isTrue: false },
                        { content: 'Burj Khalifa', isTrue: true },
                        { content: 'Ping An Finance Centre', isTrue: false },
                        { content: 'Taipei 101', isTrue: false },
                    ],
                },
            ],
            thumbnail: null,
            video: null,
            order_index: 1,
        },
        {
            id: 3,
            title: 'Lecția numărul 3',
            shortDescription: 'Lorem ipsum dolor  dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,',
            content: 'Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget ',
            questions: [
                {
                    content: 'What is the fastest animal in the world ?',
                    answers: [
                        { content: 'Peregrine falcon', isTrue: true },
                        { content: 'Cheetah', isTrue: false },
                        { content: 'Lion', isTrue: false },
                        { content: 'Turtle', isTrue: false },
                        { content: 'The happy little frog :)', isTrue: false },
                    ],
                },
            ],
            thumbnail: null,
            video: null,
            order_index: 2,
        },
        {
            id: 4,
            title: 'Lecția numărul 4',
            shortDescription: 'Lorem ipsum dolor  dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,',
            content: 'Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget Aenean eget mauris et sem rhoncus iaculis. Duis elementum neque eros, non feugiat tellus sagittis vitae. Ut tristique ultricies nunc a semper. Cras urna leo, blandit ac egestas ut, consequat vel felis. Duis iaculis tincidunt lobortis. Donec porta turpis mi, eget ',
            questions: [
                {
                    content: 'What is the fastest animal in the world ?',
                    answers: [
                        { content: 'Peregrine falcon', isTrue: true },
                        { content: 'Cheetah', isTrue: false },
                        { content: 'Lion', isTrue: false },
                        { content: 'Turtle', isTrue: false },
                        { content: 'The happy little frog :)', isTrue: false },
                    ],
                },
            ],
            thumbnail: null,
            video: null,
            order_index: 3,
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
        const lesson_index = state.lessons.findIndex(e => e.id === id);
        return state.lessons[lesson_index];
    },
    questionByIndex: (state, getters) => (lesson_id, question_index) => {
        return getters.newLessonById(lesson_id).questions[question_index];
    },
};

const actions = {
    courseAdd({ state }, progressCallback) {
        const fd = new FormData();
        state.lessons.forEach((lesson, i)=> {
            if (lesson.thumbnail) fd.append(`thumbnails[${i}]`, lesson.thumbnail);
            if (lesson.video) fd.append(`videos[${i}]`, lesson.video);
        });
        fd.append('image', state.image);
        fd.append('content', JSON.stringify(state));
        return new Promise((resolve, reject) => {
            axios.post(config.url.COURSE_ADD, fd, {
                onUploadProgress: progressEvent => {
                    const percent = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
                    if (progressCallback) progressCallback(percent);
                },
            })
                .then(({ data }) => {
                    if (data.success) {
                        resolve();
                    } else reject(data.messages);
                    console.log(data);
                })
                .catch(err => reject(err));
        });
    },
    addNewLesson ({ commit, state }, { title, description }) {
        const lastId = state.lessons[state.lessons.length - 1].id;
        commit(NEW_COURSE_ADD_LESSON, {
            id: lastId+1,
            title,
            description,
        });
    },
    updateLesson({ commit }, { id, data }) {
        commit(NEW_COURSE_UPDATE_LESSON_DATA, { id, data });
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
    // questions
    addQuestion({ commit }, { lesson_id, content }) {
        commit(NEW_COURSE_LESSON_QUESTION_ADD, { lesson_index: state.lessons.findIndex(e => e.id === lesson_id), content });
    },
    deleteQuestion({ commit }, { lesson_id, question_index }) {
        commit(NEW_COURSE_LESSON_QUESTION_DELETE, { lesson_index: state.lessons.findIndex(e => e.id === lesson_id), question_index });
    },
    updateQuestion({ commit }, { lesson_id, question_index, data }) {
        commit(NEW_COURSE_LESSON_QUESTION_UPDATE, { lesson_index: state.lessons.findIndex(e => e.id === lesson_id), question_index, data });
    },
    // answers
    addAnswer({ commit }, { lesson_id, question_index }) {
        commit(NEW_COURSE_LESSON_QUESTION_ANSWER_ADD, {
            lesson_index: state.lessons.findIndex(e => e.id === lesson_id),
            question_index,
        });
    },
    updateAnswer({ commit }, { lesson_id, question_index, answer_index, data }) {
        commit(NEW_COURSE_LESSON_QUESTION_ANSWER_UPDATE, {
            lesson_index: state.lessons.findIndex(e => e.id === lesson_id),
            answer_index,
            question_index,
            data,
        });
    },
    deleteAnswer({ commit }, { lesson_id, question_index, answer_index }) {
        commit(NEW_COURSE_LESSON_QUESTION_ANSWER_DELETE, {
            lesson_index: state.lessons.findIndex(e => e.id === lesson_id),
            question_index,
            answer_index,
        });
    },
};


const mutations = {
    [NEW_COURSE_ADD_LESSON] (state, payload) {
        state.lessons.push({
            ...payload,
            thumbnail: null,
            video: null,
            questions: [],
            order_index: state.lessons.length,
        });
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
    [NEW_COURSE_UPDATE_LESSON_DATA] (state, { id, data }) {
        const index = state.lessons.findIndex(e => e.id === id);
        Vue.set(state.lessons, index, { ...state.lessons[index], ...data });
    },
    [NEW_COURSE_UPDATE_DATA] (state, data) {
        // Update prerequisites array index by index, TODO *How to update whole vuex array*
        if (data.prerequisites) { // if data has prerequisites
            data.prerequisites.forEach((e, i) => { // loop through each item
                state.prerequisites[i] = e; // and update the prerequisites store object index by index
            });
            delete data.prerequisites; // and delete the key
        }
        Object.assign(state, data); // update anything left
    },
    [NEW_COURSE_LESSON_ORDER_UP] (state, lesson_id) {
        const indexA = state.lessons.findIndex(e => e.id === lesson_id); // elementul pe care am apasat
        const indexB = state.lessons.findIndex(e => e.order_index === state.lessons[indexA].order_index - 1); // elementul de mai sus
        // interschimbare smechera
        state.lessons[indexA].order_index = [state.lessons[indexB].order_index, state.lessons[indexB].order_index = state.lessons[indexA].order_index][0];
    },
    [NEW_COURSE_LESSON_ORDER_DOWN] (state, lesson_id) {
        const indexA = state.lessons.findIndex(e => e.id === lesson_id);
        const indexB = state.lessons.findIndex(e => e.order_index === state.lessons[indexA].order_index + 1); // elementul de mai jos
        // interschimbare normala
        const aux = state.lessons[indexA].order_index;
        state.lessons[indexA].order_index = state.lessons[indexB].order_index;
        state.lessons[indexB].order_index = aux;
    },
    // questions
    [NEW_COURSE_LESSON_QUESTION_ADD] (state, { lesson_index, content }) {
        state.lessons[lesson_index].questions.push({ content: content.trim(), answers: [] });
    },
    [NEW_COURSE_LESSON_QUESTION_DELETE] (state, { lesson_index, question_index }) {
        state.lessons[lesson_index].questions.splice(question_index, 1);
    },
    [NEW_COURSE_LESSON_QUESTION_UPDATE] (state, { lesson_index, question_index, data }) {
        let question = state.lessons[lesson_index].questions[question_index];
        question = Object.assign(question, data); //no
    },
    // answers
    [NEW_COURSE_LESSON_QUESTION_ANSWER_ADD] (state, { lesson_index, question_index }) {

        state.lessons[lesson_index].questions[question_index].answers.push({ content: '', isTrue: false });
    },
    [NEW_COURSE_LESSON_QUESTION_ANSWER_DELETE] (state, { lesson_index, question_index, answer_index }) {
        state.lessons[lesson_index].questions[question_index].answers.splice(answer_index, 1);
    },
    [NEW_COURSE_LESSON_QUESTION_ANSWER_UPDATE] (state, { lesson_index, question_index, answer_index, data }) {
        let answers = state.lessons[lesson_index].questions[question_index].answers;
        Vue.set(answers, answer_index, {...answers[answer_index], ...data});
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
