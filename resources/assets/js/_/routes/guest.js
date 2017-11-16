import Login from '../components/pages/guest/Login';
import Register from '../components/pages/guest/Register';
import Welcome from '../components/pages/guest/Welcome';

export default [
    {
        path: '/welcome',
        name: 'welcome',
        component: Welcome,
        meta: { onlyGuest: true },

    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: { onlyGuest: true },
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: { onlyGuest: true },
    },
];
