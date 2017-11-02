import Login from '../components/pages/Login';
import Register from '../components/pages/Register';
import Authenticated from '../components/pages/Authenticated';
import VueRouter from 'vue-router';

const router = new VueRouter({
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/authenticated',
            component: Authenticated,
        },
        {
            path: '/login',
            component: Login,
        },
        {
            path: '/register',
            component: Register,
        }
    ]
});

export default router;