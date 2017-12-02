import Welcome from '../components/pages/user/course/Welcome.vue';

export default [
    {
        path: '/curs/:slug',
        name: 'courseWelcome',
        component: Welcome,
        meta: { onlyAuth: true },
    },
];
