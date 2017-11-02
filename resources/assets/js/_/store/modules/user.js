import config from '../../../config';
import router from '../../routes/routes';
import { USER_FETCH, USER_AUTH_SUCCESSFUL,USER_FAILED } from '../mutators-types';

const state = {
    fetching: false,
    user: {},
    error: '',
};

const getters = {
    isLogged: state => !!state.user.id,
};

const actions = {
    login(store, { email, password }){
        console.log(config.LOGIN)
        store.commit(USER_FETCH);
        axios.post(config.LOGIN, {
            email, password
        })
            .then(({ data }) => {
                store.commit(USER_AUTH_SUCCESSFUL, data);
                router.push({path:'/authenticated'});
            })
            .catch(err => {
                store.commit(USER_FAILED, err)
            });
    }
};

const mutations = {
    [USER_FETCH](state, payload){
        state.fetching = payload;
    },
    [USER_AUTH_SUCCESSFUL] (state, payload) {
        console.log(payload)
        state.user = payload;
    },
    [USER_FAILED] (state, payload) {
        console.log(payload);
        state.error = payload;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};