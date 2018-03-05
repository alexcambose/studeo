<template>
    <div class="welcome">
        <div class="landing-navbar-container">
            <div class="landing-navbar-filter" ref="landingNavbarFilter"></div>
            <div class="landing-navbar" ref="landingNavbar">

                <div class="container navbar-content">
                    <span class="logo"></span>
                    <ul>
                        <li>
                            <router-link :to="{name: 'register'}">Înregistrare</router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'login'}">Autentificare</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="landing-page">
            <div class="landing-page-filter"></div>
            <div class="container landing-page-content">
                    <h1 class="landing-page-title">
                        Studeo
                    </h1>
                    <div class="landing-page-motto">Fiecare moment este o oportunitate de învățare</div>
            </div>
        </section>
        <section class="about-us">
            <div class="title">Credem în potențialul tău</div>
            <div class="subtitle">
                <div class="columns is-centered">
                    <div class="column is-8">
                        Trăim în secolul vitezei si timpul nu este niciodată suficient. Dorința de a te reorienta sau de a acumula noi cunoștințe in domeniul in care activezi deja se lovește de imposibilitatea de a-ti împarți mai bine timpul astfel incat sa poti participa efectiv la diverse cursuri de pregătire si perfecționare.
                        Misiunea: îmbunatățirea rezultatelor la examene si dezvoltarea aptitudinilor utilizatorilor. Aceasta este deschisa oricarui doritor iar informațiile oferite sunt gratis.
                        Astfel nu trebuie sa va mai faceti griji in legătura cu plata pentru meditatii sau profesori particulari.
                    </div>
                </div>
            </div>
        </section>
        <section class="details">
            <div class="background-filter"></div>
            <div class="container">
                <div class="title">Ce oferă platforma ?</div>
                <div class="columns">
                    <div class="column">
                        <div class="icon">
                            <img src="images/book.png"/>
                        </div>
                        <div class="column-title">Cursuri de calitate</div>
                        <div class="content">
                            Neavând un grup țintă, trainingul bazat pecursuri online poate oferi utilizatorilor cu diverse nivele de cunoștințe informații din orice domenii.
                            Administratorii platformei vegează non-stop conținutul acesteia și se asigură ca toate cursurile indeplinesc cele mai inalte standarde de calitate pentru ca tu să inveți ușor și repede.
                        </div>
                    </div>
                    <div class="column">
                        <div class="icon">
                            <img src="images/anywhere.png"/>
                        </div>
                        <div class="column-title">Mobilitate</div>
                        <div class="content">
                            Trăim într-o eră a tehnologiei ceea ce ne permite să fim mereu în contact cu Internetul și cu ce ne poate oferi. Cursurile disponibile într-un mediu online reprezintă astfel o sursă accesibilă oricând și pentru oricine dorește să învețe.
                        </div>
                    </div>
                    <div class="column">
                        <div class="icon">
                            <img src="images/friends.png"/>
                        </div>
                        <div class="column-title">Interacțiune cu prietenii ?</div>
                        <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores atque aut cumque dolores doloribus dolorum ea, natus numquam odit omnis optio quaerat quasi quisquam reiciendis suscipit tenetur ullam vel vero. Accusamus beatae dolores doloribus facilis, iste iure minima molestias non perspiciatis quisquam quo reiciendis repellat saepe tenetur totam, velit vero.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="testimonials">
            <div class="title">Ce spun utilizatorii noștri ?</div>
            <div class="container">
                <div v-for="(someTestimonials, index) in chunkArray(testimonials, 2)" :key="index" class="columns">
                    <div v-for="(testimonial, index) in someTestimonials" :key="index" class="column">
                        <article class="media">
                            <figure class="media-left">
                                <image-container :src="testimonial.image" class="user-image"></image-container>
                            </figure>
                            <div class="media-content">
                                <div class="user-name">{{testimonial.name}}</div>
                                <div class="user-title">{{testimonial.title}}</div>
                                <div class="user-content">{{testimonial.content}}</div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <section class="join">
            <div class="title">Alătură-te și descoperă-ți potențialul!</div>
            <div class="container">
                <div class="columns">
                    <div class="column is-4 is-offset-1"><router-link :to="{name: 'login'}" class="button is-outlined is-info is-large is-fullwidth">Autentificare</router-link></div>
                    <div class="column is-4 is-offset-2"><router-link :to="{name: 'register'}" class="button is-outlined is-info is-large is-fullwidth">Înregistrare</router-link></div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { chunkArray } from '../../../../utils';
    import ImageContainer from '../../includes/dumb/ImageContainer.vue';
    export default {
        mounted() {
            const $landingNavbarFilter = this.$refs.landingNavbarFilter;
            const $landingNavbar = this.$refs.landingNavbar;
            window.addEventListener('scroll', () => {
                if (window.scrollY > window.innerHeight) {
                    $landingNavbarFilter.classList.add('compressed');
                    $landingNavbar.classList.add('compressed');
                } else {
                    $landingNavbarFilter.classList.remove('compressed');
                    $landingNavbar.classList.remove('compressed');
                }
            });
        },
        data() {
            return {
                testimonials: [
                    {
                        image: 'images/boy1.png',
                        name: 'Tudor Silvestru',
                        title: 'Interesant',
                        content: 'Proiectul este o platforma educationala in care utilizatorii pot lua parte la cursuri din diferite domenii. Mesajul este clar formulat. Nu am intampinat nici o problema. In schimb, cred ca ar trebui creat un playlist default (gen "watch later") sau ceva buton cu inima pe pagina cursului. De asemenea, ar trebui incluse review-uri pentru fiecare curs. Pagina cu toate categoriile sa aiba sectiuni pe langa cea cu recomandate, cu trending, new, most viewed, whatever... Usor de navigat, design placut, contine toate functiile necesare unei platforme educationale.',
                    },
                    {
                        image: 'images/girl1.jpeg',
                        name: 'Andreea Bostan',
                        title: 'Excelent',
                        content: 'Proiectul este un site in care poti gasi resurse in domenii diverse Imi place designul, iar interfata este foarte intuitiva. Sunt convinsa ca aceasta platforma are un mare potential. Nu am intampinat nici o problema. Dar ar mai putea fi adaugate cateva lucruri precum recomandare in functie de rating, views etc..'
                    },
                    {
                        image: 'images/boy2.jpeg',
                        name: 'Dorian Popovici',
                        title: 'Are potential',
                        content: 'E vorba despre ajutarea studentilor sa invete pentru bac, sau doar pentru distractie. Unele pasaje de text au diacritice lipsa. Imi place site-ul din punct de vedere estetic, si mi se pare usor de folosit.'
                    },
                ],
            };
        },
        methods: {
            chunkArray,
        },
        components: {
            ImageContainer,
        },
    };
</script>