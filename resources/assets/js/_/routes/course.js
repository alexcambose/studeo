import Welcome from '../components/pages/user/course/Welcome.vue';
import Lesson from '../components/pages/user/course/lesson/_index.vue';

export default [
    {
        path: '/curs/:slug',
        name: 'courseWelcome',
        component: Welcome,
        meta: { onlyAuth: true },
    },
    {
        path: '/curs/:slug/:lessonIndex',
        name: 'courseLesson',
        component: Lesson,
        meta: { onlyAuth: true },
    },
];
