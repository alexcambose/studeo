import Login from '../components/pages/guest/Login';
import Register from '../components/pages/guest/Register';
import Welcome from '../components/pages/guest/Welcome';
import Home from '../components/pages/Home';
import Profile from '../components/pages/user/Profile';
import Notifications from '../components/pages/user/Notifications';
import Account from '../components/pages/user/settings/Account';
import ProfileSettings from '../components/pages/user/settings/Profile';
import Security from '../components/pages/user/settings/Security';
import BecomeMentor from '../components/pages/user/BecomeMentor';
import Settings from '../components/pages/user/settings/_index.vue';
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
            meta: { onlyAuth: true }
        },
        {
            path: '/profil',
            component: Profile,
            name: 'profile',
            meta: { onlyAuth: true }
        },
        {
            path: '/notificari',
            component: Notifications,
            name: 'notifications',
            meta: { onlyAuth: true }
        },
        {
            path: '/inscriere-mentor',
            component: BecomeMentor,
            name: 'becomeMentor',
            meta: { onlyAuth: true }
        },
        {
            path: '/setari',
            component: Settings,
            name: 'settings',
            redirect: '/setari/profil',
            meta: { onlyAuth: true },
            children: [
                {
                    path: 'profil',
                    component: ProfileSettings,
                    name: 'settings-profile',
                    meta: { onlyAuth: true }
                },
                {
                    path: 'cont',
                    component: Account,
                    name: 'settings-account',
                    meta: { onlyAuth: true }
                },
                {
                    path: 'securitate',
                    component: Security,
                    name: 'settings-security',
                    meta: { onlyAuth: true }
                }
            ],
        },
        {
            path: '/welcome',
            name: 'welcome',
            component: Welcome,
            meta: { onlyGuest: true }

        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: { onlyGuest: true }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: { onlyGuest: true }
        }
    ]
});

router.beforeEach((to, from, next) => {
    const check = () => {
        if (to.matched.some(record => record.meta.onlyAuth))
            if (!store.state.user.logged) next({name: 'welcome'}); else next();

        else if(to.matched.some(record => record.meta.onlyGuest))
            if (store.state.user.logged) next({name: 'root'}); else next();

        else next();
    };
    store.dispatch('getNotification');
    if(store.state.user.logged){
        check();
    } else {
        axios.post(config.url.USER).then(({ data }) => {
            if(data.success){
                store.dispatch('setUser', data);
                store.dispatch('setNotification', data.user); //user has a notifications[] property
            }
            else store.dispatch('logout');
            check();
        });
    }
});

export default router;