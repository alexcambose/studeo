import BecomeMentor from '../components/pages/user/mentor/BecomeMentor';
import Dashboard from '../components/pages/user/mentor/Dashboard';
import AddCourse from '../components/pages/user/mentor/course/addCourse/_index';
import GeneralInformations from '../components/pages/user/mentor/course/addCourse/GeneralInformations';
import Purpose from '../components/pages/user/mentor/course/addCourse/Purpose';
import TargetAudience from '../components/pages/user/mentor/course/addCourse/TargetAudience';
import Lesson from '../components/pages/user/mentor/course/addCourse/Lesson';
import Final from '../components/pages/user/mentor/course/addCourse/Final';

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
        redirect: '/administrare-cursuri/adauga/informatii/general',
        meta: { onlyMentor: true },
        children: [
            {
                path: '/administrare-cursuri/adauga/informatii/general',
                component: GeneralInformations,
                name: 'dashboard-add-course-informations-general',
                meta: { onlyMentor: true },
            },
            {
                path: '/administrare-cursuri/adauga/informatii/scop',
                component: Purpose,
                name: 'dashboard-add-course-informations-purpose',
                meta: { onlyMentor: true },
            },
            {
                path: '/administrare-cursuri/adauga/informatii/public',
                component: TargetAudience,
                name: 'dashboard-add-course-informations-target',
                meta: { onlyMentor: true },
            },
            {
                path: '/administrare-cursuri/adauga/lectie/:id',
                component: Lesson,
                name: 'dashboard-add-course-lesson',
                meta: { onlyMentor: true },
            },
            {
                path: '/administrare-cursuri/adauga/finalizare',
                component: Final,
                name: 'dashboard-add-course-final',
                meta: { onlyMentor: true },
            },
        ],
    },
];
