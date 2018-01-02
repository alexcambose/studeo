import Path from '../components/pages/user/path/Path';

export default [
    {
        path: '/paths',
        component: Path,
        name: 'paths',
        meta: { onlyAuth: true },
    },
];
