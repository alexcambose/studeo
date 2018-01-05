import config from '../../../config';
import { NOTIFICATION_TOGGLE_READ, NOTIFICATION_TOGGLE_READ_ALL, NOTIFICATION_SET_ONLY_UNREAD, NOTIFICATION_SET, NOTIFICATION_APPEND } from '../mutators-types';

const state = {
    notifications: [],
    notificationsCount: 0,
    unreadNotificationsCount: 0,
    startIndex: 0,
    onlyUnread: false,
};

const getters = {
    notifications (state) {
        let notifications = state.notifications;

        // add diffForHumans time
        notifications = notifications.map(e => {
            return {
                id: e.id,
                _created_at: moment(e.created_at).fromNow(),
                _read_at: e.read_at ? moment(e.read_at).fromNow() : null,
                title: config.notifications.messages[e.data.type].title(e),
                message: config.notifications.messages[e.data.type].message(e),
            };
        });

        if (state.onlyUnread) notifications = notifications.filter(e => !e._read_at);
        return notifications;
    },
};

const actions = {
    getNotification({ state, commit }, shouldAppend = false) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.NOTIFICATION, { start: (state.startIndex === 0 && shouldAppend ? state.startIndex+config.notifications.loadAmount : 0), amount: config.notifications.loadAmount })
                .then(({ data }) => {
                    if (shouldAppend) commit(NOTIFICATION_APPEND, data);
                    else commit(NOTIFICATION_SET, data);
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
            axios.post(config.url.NOTIFICATION_TOGGLE_READ, { id, read: !read })
                .then(({ data }) => {
                    commit(NOTIFICATION_TOGGLE_READ, { notification: data.notification, unreadNotificationsCount: data.unreadNotificationsCount });
                    resolve();
                }).catch(err => {
                    reject(err);
                });
        });
    },
    toggleReadAllNotifications({ commit }) {
        return new Promise((resolve, reject) => {
            axios.post(config.url.NOTIFICATION_TOGGLE_READ_ALL)
                .then(({ data }) => {
                    commit(NOTIFICATION_TOGGLE_READ_ALL, data.readAll);
                    resolve();
                }).catch(err => {
                    reject(err);
                });
        });
    },
};

const mutations = {
    [NOTIFICATION_SET](state, { notifications, notificationsCount, unreadNotificationsCount }) {
        state.notifications = notifications;
        state.notificationsCount = notificationsCount;
        state.unreadNotificationsCount = unreadNotificationsCount;
    },
    [NOTIFICATION_APPEND](state, { notifications, notificationsCount, unreadNotificationsCount }) {
        state.notifications = [...state.notifications, ...notifications];
        state.notificationsCount = notificationsCount;
        state.unreadNotificationsCount = unreadNotificationsCount;
        state.startIndex += config.notifications.loadAmount;
    },
    [NOTIFICATION_SET_ONLY_UNREAD](state, value) {
        state.onlyUnread = value;
    },
    [NOTIFICATION_TOGGLE_READ_ALL](state, readAll) {
        if (readAll) state.unreadNotificationsCount = 0;
        else state.unreadNotificationsCount = state.notificationsCount;
        state.notifications = state.notifications.map(e => {
            if (readAll) e.read_at = new Date();
            else e.read_at = null;
            return e;
        });
    },
    [NOTIFICATION_TOGGLE_READ](state, { notification, unreadNotificationsCount }) {
        state.notifications = state.notifications.map(e => {
            if (e.id === notification.id) e = notification;
            return e;
        });
        state.unreadNotificationsCount = unreadNotificationsCount;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
