const SERVER = 'http://localhost:8000/';
export default {
    url: {
        LOGIN: SERVER + 'login',
        LOGOUT: SERVER + 'logout',
        REGISTER: SERVER + 'register',
        USER: SERVER + 'user',
        USERUPDATE: SERVER + 'user/update',
        USERUPDATEPASSWORD: SERVER + 'user/update/password',
        NOTIFICATIONTOGGLEREAD: SERVER + 'notification',
    },
    notifications: {
        PASSWORD_CHANGED: {
            title: 'Parola schimbata',
            message: ({ f_created_at }) => 'Parola a fost schimbata cu ' + f_created_at,
        },
    },
};