const SERVER = 'http://localhost:8000/';
export default {
    url: {
        SERVER,
        LOGIN: SERVER + 'login',
        LOGOUT: SERVER + 'logout',
        REGISTER: SERVER + 'register',
        USER: SERVER + 'user',
        USER_UPDATE: SERVER + 'user/update',
        USER_UPDATE_PASSWORD: SERVER + 'user/update/password',
        USER_MENTOR: SERVER + 'user/mentor/register',
        USER_UPDATE_PROFILE: SERVER + 'user/update/profile',
        NOTIFICATION: SERVER + 'notification/get',
        NOTIFICATION_TOGGLE_READ: SERVER + 'notification',
        NOTIFICATION_TOGGLE_READ_ALL: SERVER + 'notification/toggleReadAll',
    },
    notifications: {
        PASSWORD_CHANGED: {
            title: 'Parola schimbată',
            message: ({ f_created_at }) => 'Parola a fost schimbată cu ' + f_created_at + '.',
        },
        BECAME_MENTOR: {
            title: 'Ai devenit mentor',
            message: () => 'Tocmai ai devenit mentor! Contribuie și tu la succesul altora!',
        },
    },
    classLevels: ['Altceva', 'Școala generală', 'Gimnaziu', 'Liceu', 'Facultate'],
};
