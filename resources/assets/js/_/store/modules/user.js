import config from '../../../config';
import { USER_FETCH, USER_AUTH_LOGIN, USER_AUTH_LOGOUT, USER_AUTH_REGISTER, USER_AUTH_UPDATE_DATA, USER_AUTH_UPDATE_PASSWORD } from '../mutators-types';

const state = {
    user: {},
    logged: false,
};

const getters = {};

const actions = {
    setuser({ commit }, payload) {
        commit(USER_AUTH_LOGIN, payload);
    },
    updateUserData({ commit }, payload) {
        return new Promise((resolve, reject) => {

        });
    },
    updateUserPassword({ commit }, { current_password, password }) {
        return new Promise((resolve, reject) => {
            axios.post(config.USERUPDATEPASSWORD, { current_password, password })
                .then(({data}) => {
                    console.log(data);
                    if (data.success) {
                        commit(USER_AUTH_UPDATE_PASSWORD);
                        resolve();
                    } else {
                        reject(data.message);
                    }
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    login({ commit }, { email, password }) {
        return new Promise((resolve, reject) => {
            axios.post(config.LOGIN, { email, password })
                .then(({data}) => {
                    if (data.success) {
                        commit(USER_AUTH_LOGIN, data.user);
                        resolve();
                    } else {
                        reject(data.message);
                    }
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    register({ commit }, { first_name, last_name, username, email, password, cpassword }) {
        return new Promise((resolve, reject) => {
            axios.post(config.REGISTER, { first_name, last_name, username, email, password, cpassword })
                .then(({data}) => {
                    if (data.success) {
                        commit(USER_AUTH_REGISTER, data.user);
                        resolve(data);
                    } else {
                        reject(data.message);
                    }
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    logout({ commit }) {
        return new Promise((resolve, reject) => {
            axios.post(config.LOGOUT)
                .then(() => {
                    commit(USER_AUTH_LOGOUT);
                    resolve();
                })
                .catch(err => {
                    reject(err);
                });
        });
    }
};

const mutations = {
    [USER_FETCH](state, payload) {
        state.fetching = payload;
    },
    [USER_AUTH_LOGIN](state, payload) {
        state.user = payload;
        state.logged = true;
    },
    [USER_AUTH_REGISTER](state, payload) {
        state.user = payload;
        state.logged = true;
    },
    [USER_AUTH_UPDATE_PASSWORD] () {},
    [USER_AUTH_LOGOUT](state) {
        state.logged = false;
        state.user = {};
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
