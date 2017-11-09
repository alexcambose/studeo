const SERVER = 'http://localhost:8000/';
export default {
    url: {
        LOGIN: SERVER + 'login',
        LOGOUT: SERVER + 'logout',
        REGISTER: SERVER + 'register',
        USER: SERVER + 'user',
        USERUPDATE: SERVER + 'user/update',
        USERUPDATEPASSWORD: SERVER + 'user/update/password',
    },
    notifications: {
        PASSWORD_CHANGED: 'Parola ta a fost schimbata!',
    },



};