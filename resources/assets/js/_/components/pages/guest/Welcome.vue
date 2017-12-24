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

        <div class="landing-page">
            <div class="landing-page-filter"></div>
            <div class="container landing-page-content">
                    <h1 class="landing-page-title">
                        Cursuri online petru toată lumea
                    </h1>

            </div>
        </div>
        <section class="about-us">
            <div class="title">Credem în potențialul tău</div>
            <div class="subtitle">
                <div class="columns is-centered">
                    <div class="column is-8">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam autem culpa fugit nisi
                        officiis placeat quibusdam? A ab aliquid amet atque aut cupiditate dicta dolore dolorem
                        doloribus ex fugit incidunt laboriosam, modi nisi qui quisquam rerum sapiente similique tempora
                        voluptatibus.

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
                            Administratorii platformei vegează non-stop conținutul acesteia și se asigură ca toate cursurile indeplinesc cele mai inalte standarde de calitate pentru ca tu să inveți ușor și repede. [...]
                        </div>
                    </div>
                    <div class="column">
                        <div class="icon">
                            <img src="images/anywhere.png"/>
                        </div>
                        <div class="column-title">Mobilitate</div>
                        <div class="content">
                            Ai acces la cursurile tale favorite oriunde si oricand. Progresul cursurilot este salvat automat. [...]
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
                <div v-for="(someTestimonials, index) in chunkArray(testimonials, 3)" :key="index" class="columns">
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
                        image: 'https://cdn.pixabay.com/photo/2017/01/25/19/57/raptor-2008891__180.jpg',
                        name: 'Vladut Cap De Vultur',
                        title: 'Excelent',
                        content: 'De cand am inceput sa folosesc aceasta platforma rezultatele la scoala s-au imbunatatit si nu mai mananc frigiderul parintilor.'
                    },
                    {
                        image: 'https://i.ytimg.com/vi/ARH5YzT7lqw/hqdefault.jpg',
                        name: 'Martinel Isoscel',
                        title: 'Excelent',
                        content: 'Am inceput sa imi bat degetele in cuie fara sa simt nici o durere. Le sunt recunoscator tuturor profesorilor pentru efortul depus!'
                    },
                    {
                        image: 'http://www.crestereagainilor.info/wp-content/uploads/2012/07/Gaina-rasa-Sussex.jpg',
                        name: 'Mirabela Găină',
                        title: 'Excelent',
                        content: 'Viata mea s-a schimbat complet. Multumesc iBac pentru faptul ca m-a ajutat sa ma sinucid.',
                    },
                    {
                        image: 'http://www.i-medic.ro/sites/default/files/plante-medicinale/pastarnac.jpg',
                        name: 'Păstârnac Costel',
                        title: 'Recomand',
                        content: 'Cea mai buna modalitate de a petrece timpul invatand eficient. De cand folosesc aceasta platforma am inceput sa folosesc aceasta platforma.',
                    },
                    {
                        image: 'https://upload.wikimedia.org/wikipedia/commons/0/01/What_is_your_problem%2C_graffiti_rock_-_Flickr_-_daveynin.jpg',
                        name: 'Bolovan Claudiu',
                        title: 'De viitor',
                        content: 'Cu autorul acestei platforme am reusit sa iau nota mare la bac. Acum sunt spalator de vase. Voi avea un viitor stralucit.',
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