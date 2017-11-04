import config from '../../../config';
import router from '../../routes/routes';
import { USER_FETCH, USER_AUTH_LOGIN, USER_AUTH_LOGOUT } from '../mutators-types';

const state = {
    user: {},
    logged: false,
};

const getters = {

};

const actions = {
    setuser({ commit }, payload){
        commit(USER_AUTH_LOGIN, payload);
    },
    login({commit}, {email, password}) {
        return new Promise((resolve, reject) => {
            axios.post(config.LOGIN, {
                email, password
            })
                .then(({data}) => {
                    if(data.success){
                        commit(USER_AUTH_LOGIN, data.user);
                        resolve();
                    }else reject(data);

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
    [USER_FETCH](state, payload){
        state.fetching = payload;
    },
    [USER_AUTH_LOGIN] (state, payload) {
        state.user = payload;
        state.logged = true;
    },
    [USER_AUTH_LOGOUT] (state) {
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
