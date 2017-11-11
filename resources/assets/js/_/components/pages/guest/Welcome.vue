<template>
    <div>
        <div class="hero-body">
            <h1 class="title is-1">
                Bine ai venit pe cea mai buna platformă pentru viitorul tău!
            </h1>
            <h2 class="subtitle is-4">
                Daca nu iți doresti sa lucrezi la <span class="has-text-danger">McDonalds</span> sau <span
                    class="has-text-danger">KFC</span> intra pe <span class="has-text-success">iBac</span> si <span
                    class="has-text-success">i</span>a <span class="has-text-success">Bac</span>ul fara sa te bată parinții!
            </h2>
        </div>
        <hr>
        <div class="has-text-centered">
            <h1 class="title is-2">Ce spun utilizatorii platformei <span class="has-text-success">iBac</span> ?</h1>
            <div class="columns">
                <div class="column" v-for="(t, index) in testimonials" :key="index">
                    <article class="media">
                        <figure class="media-left">
                            <img :src="t.image" class="image is-64x64 is-rounded">
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <em class="has-text-weight-light">
                                    <span class="has-text-weight-light title is-3">{{t.name}}</span>
                                    <br/>
                                    <div class="mt-10 has-text-weight-light subtitle is-5" v-html="t.content"></div>
                                </em>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <hr>
        <div class="hero-body has-text-centered">
            <h1 class="title is-1">
                Incearcă și tu!
            </h1>
            <div class="columns">
                <div class="column is-offset-2 is-8">
                    <div class="columns">
                        <div class="column">
                            <router-link to="login" class="button is-primary is-outlined is-fullwidth is-large">Autentificare</router-link>
                        </div>
                        <div class="column">
                            <router-link to="register" class="button is-info is-outlined is-fullwidth is-large">Înregistrare</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                testimonials: [
                    {
                        image: 'https://cdn.pixabay.com/photo/2017/01/25/19/57/raptor-2008891__180.jpg',
                        name: "Vladut Cap De Vultur",
                        date: new Date(),
                        title: "Excelent",
                        content: "De cand am inceput sa folosesc aceasta platforma rezultatele la scoala s-au imbunatatit si nu mai mananc frigiderul parintilor."
                    },
                    {
                        image: 'https://i.ytimg.com/vi/ARH5YzT7lqw/hqdefault.jpg',
                        name: "Martinel Isoscel",
                        date: new Date(),
                        title: "Excelent",
                        content: "Am inceput sa imi bat degetele in cuie fara sa simt nici o durere. Le sunt recunoscator tuturor profesorilor pentru efortul depus!"
                    },
                    {
                        image: 'http://www.crestereagainilor.info/wp-content/uploads/2012/07/Gaina-rasa-Sussex.jpg',
                        name: "Mirabela Găină",
                        date: new Date(),
                        title: "Excelent",
                        content: "Viata mea s-a schimbat complet. Multumesc <b>iBac</b> pentru faptul ca m-a ajutat sa ma sinucid."
                    }
                ],
            }
        }
    };
</script>