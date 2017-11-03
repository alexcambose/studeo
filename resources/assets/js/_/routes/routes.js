import Login from '../components/pages/Login';
import Register from '../components/pages/Register';
import Authenticated from '../components/pages/Authenticated';
import store from '../store/index';
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

// console.log(window.axios)

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.onlyAuth))
        if (!store.state.user.logged) next({name: 'login'}); else next();

    else if(to.matched.some(record => record.meta.onlyGuest))
        if (store.state.user.logged) next({name: 'root'}); else next();

    else next();
});

export default router;