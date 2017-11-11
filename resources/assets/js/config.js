const SERVER = 'http://localhost:8000/';
export default {
    url: {
        LOGIN: SERVER + 'login',
        LOGOUT: SERVER + 'logout',
        REGISTER: SERVER + 'register',
        USER: SERVER + 'user',
        USER_UPDATE: SERVER + 'user/update',
        USER_UPDATE_PASSWORD: SERVER + 'user/update/password',
        NOTIFICATION: SERVER + 'notification/get',
        NOTIFICATION_TOGGLE_READ: SERVER + 'notification',
        NOTIFICATION_TOGGLE_READ_ALL: SERVER + 'notification/toggleReadAll',
    },
    notifications: {
        PASSWORD_CHANGED: {
            title: 'Parola schimbata',
            message: ({ f_created_at }) => 'Parola a fost schimbata cu ' + f_created_at + '.',
        },
    },
};