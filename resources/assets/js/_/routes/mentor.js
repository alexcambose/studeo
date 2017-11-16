import BecomeMentor from '../components/pages/user/mentor/BecomeMentor';
import Dashboard from '../components/pages/user/mentor/Dashboard';
import AddCourse from '../components/pages/user/mentor/course/AddCourse';

export default [
    {
        path: '/inscriere-mentor',
        component: BecomeMentor,
        name: 'becomeMentor',
        meta: { onlyAuth: true },
    },
    {
        path: '/administrare-cursuri',
        component: Dashboard,
        name: 'dashboard',
        meta: { onlyMentor: true },
    },
    {
        path: '/administrare-cursuri/adauga',
        component: AddCourse,
        name: 'dashboard-add-course',
        meta: { onlyMentor: true },
    },
];
