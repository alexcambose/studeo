import Profile from '../components/pages/user/profile/Profile.vue';
import Posts from '../components/pages/user/profile/Posts.vue';
import Recommended from '../components/pages/user/profile/Recommended.vue';
export default [
    {
        path: '/profil/:username',
        component: Profile,
        name: 'profile',
        meta: { onlyAuth: true },
        children: [
            {
                path: 'postari',
                component: Posts,
                name: 'profile-posts',
            },
            {
                path: 'recomandate',
                component: Recommended,
                name: 'profile-recommended',
            },
        ],
    },
];
