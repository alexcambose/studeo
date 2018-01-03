import Welcome from '../components/pages/user/course/Welcome.vue';
import Lesson from '../components/pages/user/course/lesson/Lesson.vue';
import All from '../components/pages/user/course/All.vue';

export default [
    {
        path: '/cursuri',
        name: 'courses',
        component: All,
        meta: { onlyAuth: true },
    },
    {
        path: '/curs/:slug',
        name: 'courseWelcome',
        component: Welcome,
        meta: { onlyAuth: true },
    },
    {
        path: '/curs/:slug/lectii',
        name: 'courseLesson',
        component: Lesson,
        meta: { onlyAuth: true },
    },
];
