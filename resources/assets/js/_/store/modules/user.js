import config from '../../../config';
import {
    USER_AUTH_UPDATE_DATA, USER_REGISTER_MENTOR, NOTIFICATION_SET, USER_AUTH_LOGIN, USER_AUTH_LOGOUT, USER_AUTH_REGISTER,
    USER_AUTH_UPDATE_PASSWORD, USER_AUTH_UPDATE_PROFILE,
} from '../mutators-types';
const state = {
    user: {},
    logged: false,
};

const getters = {
    fullname: state => {
        return state.user.first_name + ' ' + state.user.last_name;
    },
};

const actions = {
    setUser({ commit }, user) {
        commit(USER_AUTH_LOGIN, user);
    },

    registerMentor({ commit }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.USER_MENTOR)
                .then(({ data }) => {
                    if (data.success) {
                        commit(USER_REGISTER_MENTOR);
                        resolve();
                    } else {
                        reject(data.message);
                    }
                })
                .catch(err => reject(err));
        });
    },

    updateUserProfile({ commit }, { nickname, sex, description, school, school_level, phone, birthday, cover_color }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.USER_UPDATE_PROFILE, { nickname, sex, description, school, school_level, phone, birthday, cover_color })
                .then(({ data }) => {
                    if (data.success) {
                        commit(USER_AUTH_UPDATE_DATA, data);
                        resolve();
                    } else {
                        reject(data.message);
                    }
                })
                .catch(err => reject(err));
        });
    },

    updateUserData({ commit }, { first_name, last_name, username, email }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.USER_UPDATE, { first_name, last_name, username, email })
                .then(({ data }) => {
                    if (data.success) {
                        commit(USER_AUTH_UPDATE_DATA, data);
                        resolve();
                    } else reject(data.message);
                })
                .catch(err => reject(err));
        });
    },
    updateUserPassword({ commit }, { current_password, password }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.USER_UPDATE_PASSWORD, { current_password, password })
                .then(({ data }) => {
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
            axios.post(config.url.LOGIN, { email, password })
                .then(({ data }) => {
                    if (data.success) {
                        commit(USER_AUTH_LOGIN, data);
                        commit(NOTIFICATION_SET, data);
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
            axios.post(config.url.REGISTER, { first_name, last_name, username, email, password, cpassword })
                .then(({ data }) => {
                    if (data.success) {
                        commit(USER_AUTH_LOGIN, data);
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
            axios.post(config.url.LOGOUT)
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
    [USER_AUTH_UPDATE_DATA](state, { user }) {
        state.user = user;
    },
    [USER_AUTH_LOGIN](state, { user }) {
        state.user = user;
        state.logged = true;
    },
    [USER_AUTH_LOGOUT](state) {
        state.logged = false;
        state.user = {};
    },
    [USER_AUTH_REGISTER] () {},
    [USER_AUTH_UPDATE_PASSWORD] () {},
    [USER_AUTH_UPDATE_PROFILE] () {},
    [USER_REGISTER_MENTOR] (state) {
        state.user.role = 2; //mentor
    },
};

export default {
    state,
    getters,
    actions,
    mutations
};