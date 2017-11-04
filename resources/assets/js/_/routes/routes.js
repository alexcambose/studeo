import Login from '../components/pages/guest/Login';
import Register from '../components/pages/guest/Register';
import Welcome from '../components/pages/guest/Welcome';
import Authenticated from '../components/pages/Authenticated';
import store from '../store/index';
import config from '../../config';
import VueRouter from 'vue-router';

const router = new VueRouter({
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/',
            component: Authenticated,
            name: 'root',
            meta: { onlyAuth: true }
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