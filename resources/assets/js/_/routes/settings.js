import Account from '../components/pages/user/settings/Account';
import ProfileSettings from '../components/pages/user/settings/Profile';
import Security from '../components/pages/user/settings/Security';
import Settings from '../components/pages/user/settings/_index.vue';

export default [
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
                meta: { onlyAuth: true },
            },
            {
                path: 'cont',
                component: Account,
                name: 'settings-account',
                meta: { onlyAuth: true },
            },
            {
                path: 'securitate',
                component: Security,
                name: 'settings-security',
                meta: { onlyAuth: true },
            },
        ],
    },
];
