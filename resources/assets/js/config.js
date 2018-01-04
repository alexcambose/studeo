const SERVER = 'http://localhost:8000/';
export default {
    url: {
        SERVER,
        LOGIN: SERVER + 'login/', // post
        LOGOUT: SERVER + 'logout/', // post
        REGISTER: SERVER + 'register/', // post
        USER: SERVER + 'user/get/', // get
        USER_ACTIVITY: SERVER + 'user/activity/', // get
        USER_BY_USERNAME: SERVER + 'user/get/username/', // get
        USER_UPDATE: SERVER + 'user/update/', // post
        USER_UPDATE_PASSWORD: SERVER + 'user/update/password/', // post
        USER_MENTOR: SERVER + 'user/mentor/register/', // post
        USER_UPDATE_PROFILE: SERVER + 'user/update/profile/', // post
        USER_UPDATE_PROFILE_IMAGE: SERVER + 'user/update/profileImage/', // post
        USER_SHARE_COURSE_ALL: SERVER + 'user/share/', // get
        USER_SHARE_COURSE_ADD: SERVER + 'user/share/', // post
        USER_SHARE_COURSE_DELETE: SERVER + 'user/share/', // delete
        USER_RECOMMENDED: SERVER + 'user/recommended', // post
        USER_REPORT: SERVER + 'user/report', // put
        POST_ALL: SERVER + 'user/post/', // get
        POST_ADD: SERVER + 'user/post/', // post
        POST_UPDATE: SERVER + 'user/post/', // put
        POST_DELETE: SERVER + 'user/post/', // delete
        POST_TOGGLE_LIKE: postId => SERVER + `user/post/${postId}/like/`, // post
        ACHIEVEMENT_ALL: SERVER + 'achievement/all/',
        ACHIEVEMENTS_USER: SERVER + 'achievement/user/',
        AVATAR_ALL: SERVER + 'avatar/all/',
        AVATAR_BUY: SERVER + 'avatar/buy/',
        AVATAR_ACTIVATE: SERVER + 'avatar/activate/',
        NOTIFICATION: SERVER + 'notification/',
        NOTIFICATION_TOGGLE_READ: SERVER + 'notification/toggle/',
        NOTIFICATION_TOGGLE_READ_ALL: SERVER + 'notification/toggleReadAll/',
        COURSE: SERVER + 'course/slug/',
        COURSE_FIND: SERVER + 'course/find/',
        COURSE_TAGS: SERVER + 'course/tag/',
        COURSE_ALL: SERVER + 'course/all/',
        COURSE_ADD: SERVER + 'course/add/',
        COURSE_BEST_SLUG: SERVER + 'course/slug/best/',
        COURSE_USER_JOIN: SERVER + 'course/user/join/',
        COURSE_UPDATE_NOTE: SERVER + 'course/user/note/update/',
        COURSE_ADD_NOTE: SERVER + 'course/user/note/add/',
        COURSE_DELETE_NOTE: SERVER + 'course/user/note/delete/',
        COURSE_LESSON_WATCHED: SERVER + 'course/user/lesson/watched/',
        LESSON_ALL: SERVER + 'lesson/all/',
        PLAYLISTS: SERVER + 'playlist/',
        PLAYLIST_CREATE: SERVER + 'playlist/create/',
        PLAYLIST_DELETE: SERVER + 'playlist/delete/',
        PLAYLIST_EDIT: SERVER + 'playlist/update/',
        PLAYLIST_ADD_COURSE: (playlistId, courseId) => SERVER + `playlist/${playlistId}/addCourse/${courseId}`,
        PLAYLIST_DELETE_COURSE: (playlistId, courseId) => SERVER + `playlist/${playlistId}/addCourse/${courseId}`,
        PATH_ALL: SERVER + 'path/all/',
        PATH_BY_ID: SERVER + 'path/get/',
    },
    notifications: {
        PASSWORD_CHANGED: {
            title: () => 'Parola schimbată',
            message: ({ f_created_at }) => `Parola a fost schimbată cu ${f_created_at}.`,
        },
        BECAME_MENTOR: {
            title: () => 'Ai devenit mentor',
            message: () => 'Tocmai ai devenit mentor! Contribuie și tu la succesul altora!',
        },
        COURSE_FINISHED: {
            title: () => 'Ai terminat un curs',
            message: () => 'Tocmai ai terminat un curs. Bravo!',
        },
        FIRST_COURSE_JOINED: {
            title: () => 'Te-ai înscris prima dată la un curs!',
            message: () => 'Spor la învățat!',
        },
        FIRST_COURSE_POSTED: {
            title: () => 'Ai publicat primul tău curs!',
            message: () => 'Felicitări pentru contribuție!',
        },
        AWARDED_XP: {
            title: () => 'Ai primit XP!',
            message: e => `Ai primit ${e.data.data} xp!`,
        },
        UNLOCKED_ACHIEVEMENT: {
            title: () => 'Ai realizat on nouă realizare!',
            message: e => `${e.data.data}!`,
        },
    },
    classLevels: ['Altceva', 'Școala generală', 'Gimnaziu', 'Liceu', 'Facultate'],
    course: {
        loadAmount: 10,
    },
    profile: {
        postsLoadAmount: 10,
    },
    xpLevelColors: {
        10: '#dfdbff',
        20: '#afff9d',
        30: '#ffed41',
        40: '#991fff',
        50: '#ff4d00',
        60: '#4d7edc',
    },
};
