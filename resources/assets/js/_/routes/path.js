import All from '../components/pages/user/path/All';
import Path from '../components/pages/user/path/Path';

export default [
    {
        path: '/paths',
        component: All,
        name: 'paths',
        meta: { onlyAuth: true },
    },
    {
        path: '/path/:path',
        component: Path,
        name: 'path',
        meta: { onlyAuth: true },
    },
];
