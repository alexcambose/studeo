<template>
    <div v-if="!fetching">
        <div>
            <section class="hero is-bold is-medium paths-page-has-bg-img">
                <div class="hero-body has-text-centered">
                    <div class="container">
                        <h1 class="title white">
                            Lorem ipsum.
                        </h1>
                        <h2 class="subtitle white">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti expedita impedit inventore minima officiis perferendis recusandae repellendus, repudiandae voluptates.
                        </h2>
                    </div>
                </div>
            </section>
        </div>
        <div>
            <div class="container">
                <div v-for="category in categories">
                    <div class="subtitle has-text-centered mt-15">
                        {{ category.name }}
                    </div>
                    <div>
                        <div class="columns is-multiline">
                            <div v-for="path in pathsByCategory(category.id)" class="column is-one-quarter">
                                <router-link :to="{ name: 'path', params: { path: path.id } }">
                                    <div class="path box thumbnail" :style="{ background: 'linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),' + 'url(' + path._image.filename + ')' }">
                                        <div class="has-text-centered white">
                                            <div class="title path-title" style="margin: 0">{{ path.title }}</div>
                                            <span class="duration inline visible">{{ totalDuration(path) }} &blacksquare; </span>
                                            <span class="nr-courses inline visible">{{ path._courses.length }} cursuri</span>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { MATERII, timeConvert } from '../../../../../utils';
    import config from '../../../../../config';

    export default {
        mounted() {
            const loadingComponent = this.$loading.open();
            this.fetching = true;
            this.getAllPaths().then(() => {
                this.fetching = false;
                loadingComponent.close();
            });
        },
        data() {
            return {
                categories: MATERII,
                fetching: false,
                paths: [],
            };
        },
        methods: {
            getAllPaths() {
                // TODO: move to path.js
                return new Promise((resolve, reject) => {
                    axios.get(config.url.PATH_ALL)
                        .then(({ data }) => {
                            this.paths = data.paths;
                            resolve(data.paths);
                        })
                        .catch(err => reject(err) );
                });
            },
            pathsByCategory(category) {
                return this.paths.filter(e => {
                    return e.category_id == category;
                });
            },
            totalDuration(path) {
                let totalDuration = path._courses
                    .reduce((total, path) => {
                        return total + path._lessons.reduce((seconds, lesson) => seconds + lesson.length, 0);
                    }, 0);
                return timeConvert(totalDuration);
            },
        },
    }
</script>