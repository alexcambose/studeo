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
                                    <div class="path box thumbnail" :style="{ background: 'linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),' + 'url(' + path.image + ')' }">
                                        <div class="has-text-centered white">
                                            <div class="title path-title" style="margin: 0">{{ path.title }}</div>
                                            <span class="nr-courses inline visible">{{ path.courses.length }} cursuri</span>
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
    import config from '../../../../../config'

    export default {
        data() {
            return {
                categories: MATERII,
                isAddModalActive: false,
                paths: config.paths,
            };
        },
        methods: {
            pathsByCategory(category) {
                return this.paths.filter(e => {
                    return e.category_id == category;
                });
            },

        },
    };
</script>