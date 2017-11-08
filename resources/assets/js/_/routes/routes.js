import Login from '../components/pages/guest/Login';
import Register from '../components/pages/guest/Register';
import Welcome from '../components/pages/guest/Welcome';
import Home from '../components/pages/Home';
import Profile from '../components/pages/user/Profile';
import Account from '../components/pages/user/settings/Account';
import Security from '../components/pages/user/settings/Security';
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
            path: '/profile',
            component: Profile,
            name: 'profile',
            meta: { onlyAuth: true }
        },
        {
            path: '/settings',
            component: Settings,
            name: 'settings',
            redirect: '/settings/account',
            meta: { onlyAuth: true },
            children: [
                {
                    path: 'account',
                    component: Account,
                    name: 'account',
                    meta: { onlyAuth: true }
                },
                {
                    path: 'security',
                    component: Security,
                    name: 'security',
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

    if(store.state.user.logged){
        check();
    } else {
        axios.post(config.USER).then(({ data }) => {
            if(data.success) store.dispatch('setuser', data.user);
            else store.dispatch('logout');
            check();
        });
    }
});

export default router;