import config from '../../../config';
import { PLAYLIST_CREATE, PLAYLIST_ALL, PLAYLIST_DELETE, PLAYLIST_EDIT, PLAYLIST_ADD_COURSE, PLAYLIST_DELETE_COURSE } from '../mutators-types';
import Vue from 'vue';
const state = {
    playlist: {},
    playlists: {},
};

const getters = {

};

const actions = {
    playlistCreate({ commit }, { title, description, color }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.PLAYLIST_CREATE, { title, description, color })
                .then(({ data }) => {
                    if (data.success) {
                        commit(PLAYLIST_CREATE, data);
                        resolve();
                    } else {
                        reject(data.message);
                    }
                })
                .catch(err => reject(err));
        });
    },
    deletePlaylist({ state, commit }, { playlistIndex }) {
        return new Promise((resolve, reject) => {
            axios.delete(config.url.PLAYLIST_DELETE + state.playlists[playlistIndex].id)
                .then(() => {
                    commit(PLAYLIST_DELETE, { playlistIndex });
                    resolve();
                })
                .catch(err => reject(err));
        });
    },
    savePlaylist({ state, commit }, { playlistIndex, data: { title, description, color } }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.PLAYLIST_EDIT + state.playlists[playlistIndex].id, { title, description, color })
                .then(({ data }) => {
                    if (data.success) {
                        commit(PLAYLIST_EDIT, { playlistIndex, title, description, color });
                        resolve();
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    getAllPlaylists({ commit }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.PLAYLISTS)
                .then(({ data }) => {
                    if (data.success) {
                        commit(PLAYLIST_ALL, data.playlists);
                        resolve();
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    addCoursePlaylist({ state, commit, actions }, { playlistIndex, courseId }) {
        return new Promise((resolve, reject) => {
            axios.put(config.url.PLAYLIST_ADD_COURSE(state.playlists[playlistIndex].id, courseId))
                .then(({ data }) => {
                    if (data.success) {
                        commit(PLAYLIST_ADD_COURSE, { playlistIndex, courseId });
                        resolve();
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
    deleteCoursePlaylist({ state, commit, actions }, { playlistIndex, courseId }) {
        return new Promise((resolve, reject) => {
            axios.delete(config.url.PLAYLIST_DELETE_COURSE(state.playlists[playlistIndex].id, courseId))
                .then(({ data }) => {
                    if (data.success) {
                        commit(PLAYLIST_DELETE_COURSE, { playlistIndex, courseId });
                        resolve();
                    } else reject();
                })
                .catch(err => reject(err));
        });
    },
};

const mutations = {
    [PLAYLIST_ALL](state, playlists) {
        state.playlists = playlists;
    },
    [PLAYLIST_CREATE](state, payload) {
        state.playlist = payload.playlist;
        state.playlists.push(payload.playlist);
    },
    [PLAYLIST_EDIT](state, { playlistIndex, title, description, color }) {
        state.playlists[playlistIndex].description = description;
        state.playlists[playlistIndex].title = title;
        state.playlists[playlistIndex].color = color;
    },
    [PLAYLIST_DELETE](state, { playlistIndex }) {
        state.playlists.splice(playlistIndex, 1);
    },
    [PLAYLIST_ADD_COURSE](state, { playlistIndex, courseId }) {},
    [PLAYLIST_DELETE_COURSE](state, { playlistIndex, courseId }) {
        let courseIndex = state.playlists[playlistIndex]._courses.findIndex(x => x.id == courseId);
        state.playlists[playlistIndex]._courses.splice(courseIndex, 1);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};