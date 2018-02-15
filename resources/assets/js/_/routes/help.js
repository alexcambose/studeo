import Help from '../components/pages/user/help/Help.vue';
import Questions from '../components/pages/user/help/Questions.vue';
import BugReport from '../components/pages/user/help/BugReport.vue';

export default [
    {
        path: '/ajutor',
        component: Help,
        name: 'help',
        redirect: '/ajutor/intrebari',
        meta: { onlyAuth: true },
        children: [
            {
                path: 'intrebari',
                component: Questions,
                name: 'help-questions',
                meta: { onlyAuth: true },
            },
            {
                path: 'raport',
                component: BugReport,
                name: 'help-report',
                meta: { onlyAuth: true },
            },
        ],
    },
];
