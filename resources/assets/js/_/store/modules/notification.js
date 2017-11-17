import config from '../../../config';
import { NOTIFICATION_TOGGLE_READ, NOTIFICATION_TOGGLE_READ_ALL, NOTIFICATION_SET_ONLY_UNREAD, NOTIFICATION_SET } from '../mutators-types';

const state = {
    notifications: [],
    onlyUnread: false,
};


const getters = {
    notifications (state) {
        let notifications = state.notifications;

        // add diffForHumans time
        notifications = notifications.map(e => {
            e.f_created_at = moment(e.created_at).fromNow();
            if (e.read_at) e.f_read_at = moment(e.read_at).fromNow();
            e.data.title = config.notifications[e.data.type].title;
            e.data.message = config.notifications[e.data.type].message(e);
            return e;
        });

        if (state.onlyUnread)
            notifications = notifications.filter(e => !e.read_at);

        return notifications;
    },
    unreadNotificationsCount(state) {
        return state.notifications.filter(e => !e.read_at).length;
    },
    notificationsCount(state) {
        return state.notifications.length;
    },
};


const actions = {
    getNotification({ commit }){
        return new Promise((resolve, reject) => {
            axios.post(config.url.NOTIFICATION)
                .then(({ data }) => {
                    commit(NOTIFICATION_SET, data);
                    resolve();
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    setNotification({ commit }, user) {
        commit(NOTIFICATION_SET, user);
    },
    setOnlyUnreadNotification({ commit }, value) {
        commit(NOTIFICATION_SET_ONLY_UNREAD, value);
    },
    toggleReadNotification({ state, commit }, id) {
        const read = !!state.notifications.find(e => e.id === id).read_at;
        return new Promise((resolve, reject) => {
            axios.post(config.url.NOTIFICATION_TOGGLE_READ, {
                id,
                read: !read,
            }).then(({ data }) => {
                commit(NOTIFICATION_TOGGLE_READ, { id, data });
                resolve();
            }).catch(err => {
                reject(err);
            });
        });
    },
    toggleReadAllNotifications({ state, commit, getters }) {
        console.log(getters.unreadNotificationsCount);
        return new Promise((resolve, reject) => {
            axios.post(config.url.NOTIFICATION_TOGGLE_READ_ALL)
                .then(({ data }) => {
                    commit(NOTIFICATION_TOGGLE_READ_ALL, data.readall);
                    resolve();
                }).catch(err => {
                    reject(err);
                });
        });
    }
};


const mutations = {
    [NOTIFICATION_SET](state, { notifications }) {
        state.notifications = notifications;
    },
    [NOTIFICATION_SET_ONLY_UNREAD](state, value) {
        state.onlyUnread = value;
    },
    [NOTIFICATION_TOGGLE_READ_ALL]() {},
    [NOTIFICATION_TOGGLE_READ](state, { id, data }) {
        state.notifications = state.notifications.map(e => {
            if(e.id === id) e = data;
            return e;
        });
    }
};



export default {
    state,
    getters,
    actions,
    mutations,
}