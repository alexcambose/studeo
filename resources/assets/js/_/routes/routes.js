import Home from '../components/pages/Home.vue';
import Notifications from '../components/pages/user/Notifications.vue';
import Category from '../components/pages/user/Category.vue';
import Help from '../components/pages/Help.vue';
import NotFound404 from '../components/pages/404.vue';
import guestRoutes from './guest';
import mentorRoutes from './mentor';
import settingsRoutes from './settings';
import playlistsRoutes from './playlists';
import profileRoutes from './profile';
import courseRoutes from './course';
import pathRoutes from './path';
import store from '../store/index';
import config from '../../config';
import VueRouter from 'vue-router';

const router = new VueRouter({
    linkExactActiveClass: 'is-exact-active',
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'root',
            meta: { onlyAuth: true },
        },
        {
            path: '/categorie/:category',
            component: Home,
            name: 'category',
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
        {
            path: '/legal',
            // component: Legal, il facem cand terminam
            name: 'legal',
        },
        ...guestRoutes,
        ...mentorRoutes,
        ...settingsRoutes,
        ...playlistsRoutes,
        ...courseRoutes,
        ...profileRoutes,
        ...pathRoutes,
        {
            path: '/404',
            component: NotFound404,
            name: '404',
        },
        {
            path: '*',
            component: NotFound404,
        },
    ],
});

router.beforeEach((to, from, next) => {
    const user = store.state.user;
    if (user.logged) store.dispatch('getNotification');
    if (!store.state.playlist.playlists.length) store.dispatch('getAllPlaylists');
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
        axios.get(config.url.USER).then(({ data }) => {
            if (data.success) {
                store.dispatch('setUser', data);
                store.dispatch('getNotification');
            }
            else store.dispatch('logout');
            check();
        });
    }
});

export default router;
