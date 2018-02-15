<?php
/*
 *  Niste configuratii ca sa le avem grupate si sa le modificam (oarecum) rapid
 */
return [
    'achievements' => [
        ['1_COURSE_FINISHED', 'Un curs terminat'],
        ['5_COURSE_FINISHED', '5 cursuri terminate'],
        ['10_COURSE_FINISHED', '10 cursuri terminate'],
        ['25_COURSE_FINISHED', '25 de cursuri terminate'],
        ['50_COURSE_FINISHED', '50 de cursuri terminate'],
        ['100_COURSE_FINISHED', '100 de cursuri terminate'],
        ['200_COURSE_FINISHED', '200 de cursuri terminate'],
        ['250_COURSE_FINISHED', '250 de cursuri terminate'],
        ['500_COURSE_FINISHED', '500 de cursuri terminate'],
        ['BECAME_MENTOR', 'Este mentor'],
        ['1_COURSE_PUBLISHED', 'Un curs publicat'],
        ['2_COURSE_PUBLISHED', '2 cursuri publicate'],
        ['6_COURSE_PUBLISHED', '6 cursuri publicate'],
        ['10_COURSE_PUBLISHED', '10 cursuri publicate'],
        ['20_COURSE_PUBLISHED', '20 de cursuri publicate'],
        ['30_COURSE_PUBLISHED', '30 de cursuri publicate'],
        // pentru fiecare tip de achievement adaugat trebuie configurat si in app/listeners/UnlockAchievement.php
    ],
    'avatars' => [
        ['DEFAULT', 'Caracterul standard','', 0],
        ['CAMEL', 'Camil Cămila', 'Camil Cămila este un personaj antic in istoria Africii. Se spune ca acesta se plimbă noaptea prin deșet și manancă nisip.', 10],
        ['PONY', 'Poneiul Fericit', 'Descriere. Descriere. Descriere. Descriere. Descriere. Descriere. Descriere.', 40],
        ['WIZARD', 'Vrăjitorul de Fier', 'Descriere. Descriere. Descriere. Descriere. Descriere. Descriere. Descriere.', 60],
        ['SABIN', 'Sabin Butoi', 'Sabin Butoi face treaba in noroi', 300], // laba
    ],
    'tags' => [
        'matematică',
        'algebră',
        'geometrie',
        'fracție',
        'numere complexe',
        'vectori',
        'grupuri',
        'ecuații',
        'inecuații',
        'intervale',
        'șiruri',
        'monotonie',
        'adunare',
        'scădere',
        'înmultire',
        'împărțire',
        'română',
        'cultura',
        'istorie',
        'arheologie',
        'geografie',
        'politică',
        'castravete',
        'informatica',
        'programare',
        'it',
        'calculator',
        'computer',
        // ...more
    ],
    // ...more
];