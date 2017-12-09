import config from '../../../config';
import { COURSE_SET_LESSONS, COURSE_SET_LESSON_SELECTED_INDEX, COURSE_SET_INFO } from '../mutators-types';

const state = {
    courseInfo: {},
    lessons: [],
    currentLessonIndex: null,
};

const getters = {
    lessons (state) {
        const lessons = [...state.lessons];
        lessons.sort((a, b) => a.order_index - b.order_index);
        return lessons;
    },
};

const actions = {
    getLessons ({ commit }, courseSlug) {
        return new Promise((resolve, reject) => {
            axios.get(config.url.LESSON_ALL + courseSlug)
                .then(({ data }) => {
                    if (data.success && data.userJoined) {
                        resolve(data.lessons);
                        commit(COURSE_SET_LESSONS, data.lessons);
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    getCourseInfo ({ commit }, courseSlug) {
        return new Promise((resolve, reject) => {
            axios.get(config.url.COURSE + courseSlug)
                .then(({ data }) => {
                    if (data.success) {
                        resolve(data.course);
                        commit(COURSE_SET_INFO, data.course);
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    selectLesson ({ commit }, lessonIndex) {
        commit(COURSE_SET_LESSON_SELECTED_INDEX, lessonIndex);
    },
};

const mutations = {
    [COURSE_SET_LESSONS] (state, lessons) {
        state.lessons = lessons;
    },
    [COURSE_SET_INFO] (state, courseInfo) {
        state.courseInfo = courseInfo;
    },
    [COURSE_SET_LESSON_SELECTED_INDEX] (state, lessonIndex) {
        state.currentLessonIndex = lessonIndex;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
