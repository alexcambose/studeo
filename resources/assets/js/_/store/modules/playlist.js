/* eslint-disable no-trailing-spaces */
import config from '../../../config';
import { PLAYLIST_CREATE, PLAYLIST_ALL } from '../mutators-types';
const state = {
    playlist: {},
    playlists: {},
};

const getters = {

};

const actions = {
    playlistCreate({ commit }, { title, description }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.PLAYLIST_CREATE, { title, description })
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
    getAllPlaylists({ commit }, { playlists }) {
        commit(PLAYLIST_ALL, playlists);
    },
};

const mutations = {
    [PLAYLIST_CREATE](state, payload) {
        state.playlist = payload.playlist;
        state.playlists.push(payload.playlist);
    },
    [PLAYLIST_ALL](state, playlists) {
        state.playlists = playlists;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};