import Home from '../components/pages/Home';
import Profile from '../components/pages/user/Profile';
import Notifications from '../components/pages/user/Notifications';
import Help from '../components/pages/Help';
import guestRoutes from './guest';
import mentorRoutes from './mentor';
import settingsRoutes from './settings';
import store from '../store/index';
import config from '../../config';
import VueRouter from 'vue-router';

const router = new VueRouter({
    linkExactActiveClass: 'is-active',
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'root',
            meta: { onlyAuth: true },
        },
        {
            path: '/profil',
            component: Profile,
            name: 'profile',
            meta: { onlyAuth: true },
        },
        {
            path: '/notificari',
            component: Notifications,
            name: 'notifications',
            meta: { onlyAuth: true },
        },
        {
            path: '/ajutor',
            component: Help,
            name: 'help',
            meta: { onlyAuth: true },
        },
        ...guestRoutes,
        ...mentorRoutes,
        ...settingsRoutes,
    ],
});

router.beforeEach((to, from, next) => {
    store.dispatch('getNotification');
    const user = store.state.user;

    const check = () => {
        if (to.matched.some(record => record.meta.onlyAuth)) {
            if (!user.logged) next({ name: 'welcome' });
            else next();
        }
        if (to.matched.some(record => record.meta.onlyGuest)) {
            if (user.logged) next({ name: 'root' });
            else next();
        }
        if (to.matched.some(record => record.meta.onlyMentor)) {
            if (user.user.role < 2) next({ name: 'becomeMentor' });
            else if (!user.logged) next({ name: 'welcome' });
            else next();
        } else next();
    };
    if (user.logged) {
        check();
    } else {
        axios.post(config.url.USER).then(({ data }) => {
            if (data.success) {
                store.dispatch('setUser', data);
                // the user {}, has a notifications[] property
                store.dispatch('setNotification', data.user);
            }
            else store.dispatch('logout');
            check();
        });
    }
});

export default router;