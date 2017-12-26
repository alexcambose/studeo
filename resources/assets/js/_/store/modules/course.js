import config from '../../../config';
import {
    COURSE_SET_LESSONS,
    COURSE_SET_LESSON_SELECTED_INDEX,
    COURSE_SET_INFO,
    COURSE_SET_NOTES,
    COURSE_DELETE_NOTE,
    COURSE_UPDATE_NOTE,
    COURSE_ADD_NOTE,
    COURSE_LESSON_WATCHED,
} from '../mutators-types';
import Vue from 'vue';

const state = {
    courseInfo: {},
    lessons: [],
    notes: [],
    currentLessonIndex: null,
};

const getters = {
    lessons (state) {
        const lessons = [...state.lessons];
        lessons.sort((a, b) => a.order_index - b.order_index);
        return lessons;
    },
    progress (state) {
        const watchedLessons = state.lessons.filter(e => e._watched).length;
        return watchedLessons / state.lessons.length * 100;
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
                        commit(COURSE_SET_LESSON_SELECTED_INDEX, data.lessons.filter(e => e._watched).length - 1);
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
                        commit(COURSE_SET_NOTES, data.course._joined.notes);
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    lessonMarkAsViewed({ commit, state }) {
        const lesson = state.lessons[state.currentLessonIndex];
        return new Promise((resolve, reject) => {
            axios.post(config.url.COURSE_LESSON_WATCHED + lesson.id)
                .then(({ data }) => {
                    if (data.success) {
                        commit(COURSE_LESSON_WATCHED);
                        resolve();
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    selectLesson ({ commit }, lessonIndex) {
        commit(COURSE_SET_LESSON_SELECTED_INDEX, lessonIndex);
    },
    updateNote ({ commit }, { noteIndex, data }) {
        commit(COURSE_UPDATE_NOTE, { noteIndex, data });
    },
    addNote ({ state, commit, }, { title, content }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.COURSE_ADD_NOTE + state.courseInfo.id, { title, content })
                .then(({ data }) => {
                    if (data.success) {
                        commit(COURSE_ADD_NOTE, data.note);
                        resolve(data);
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    saveNote ({ state, commit }, { noteIndex, data: { title, content } }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.COURSE_UPDATE_NOTE + state.notes[noteIndex].id, { title, content })
                .then(({ data }) => {
                    if (data.success) {
                        commit(COURSE_UPDATE_NOTE, { noteIndex, data });
                        resolve(data);
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    deleteNote ({ state, commit }, { noteIndex }) {
        return new Promise((resolve, reject) => {
            axios.delete(config.url.COURSE_DELETE_NOTE + state.notes[noteIndex].id)
                .then(({ data }) => {
                    if (data.success) {
                        commit(COURSE_DELETE_NOTE, { noteIndex });
                        resolve(data);
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
};

const mutations = {
    [COURSE_SET_LESSONS] (state, lessons) {
        state.lessons = lessons;
    },
    [COURSE_SET_INFO] (state, courseInfo) {
        state.courseInfo = courseInfo;
    },
    [COURSE_SET_NOTES] (state, notes) {
        state.notes = notes;
    },
    [COURSE_ADD_NOTE] (state, note) {
        state.notes.unshift(note);
    },
    [COURSE_DELETE_NOTE] (state, { noteIndex }) {
        state.notes.splice(noteIndex, 1);
    },
    [COURSE_LESSON_WATCHED] (state) {
        state.lessons[state.currentLessonIndex]._watched = true;
        if (state.currentLessonIndex < state.lessons.length - 1) state.currentLessonIndex++;
    },
    [COURSE_UPDATE_NOTE] (state, { noteIndex, data }) {
        Vue.set(state.notes, noteIndex, { ...state.notes[noteIndex], ...data });
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
