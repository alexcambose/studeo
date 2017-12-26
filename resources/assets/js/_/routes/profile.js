import Profile from '../components/pages/user/profile/Profile.vue';
import Posts from '../components/pages/user/profile/posts/Posts.vue';
import Shares from '../components/pages/user/profile/shares/Shares.vue';
export default [
    {
        path: '/profil/:username',
        component: Profile,
        name: 'profile',
        redirect: '/profil/:username/postari',
        meta: { onlyAuth: true },
        children: [
            {
                path: 'postari',
                component: Posts,
                name: 'profile-posts',
            },
            {
                path: 'recomandate',
                component: Shares,
                name: 'profile-recommended',
            },
        ],
    },
];
