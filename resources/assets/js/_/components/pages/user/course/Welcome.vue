<template>
    <div v-if="loaded" class="course-welcome">
        <section class="hero course-hero is-medium" :style="{backgroundImage: `url(${course._image.filename})`}">
            <div class="background-filter"></div>
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-5">
                            <video controls>
                                <source src="https://ia800605.us.archive.org/23/items/youtube-GzgavGowD_A/Flutterbye_fairy_toy_flies_into_fire_O_Fortuna-GzgavGowD_A.mp4" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>
                        </div>
                        <div class="column is-7">
                            <div class="title is-2">
                                {{course.title}}
                            </div>
                            <div class="subtitle">
                                {{course.shortDescription}}
                                <div class="apply-container">
                                    <button class="button is-outlined is-success apply">Înscriere</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container mt-20">
            <div class="columns">
                <div class="column is-8">
                    {{course.description}}
                </div>
                <div class="column is-4">
                    <div class="card">
                        <user-card :user="user"></user-card>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import config from '../../../../../config';
    import UserCard from '../../../../components/includes/dumb/UserCard.vue';
    export default {
        mounted() {
            const loadingComponent = this.$loading.open();
            axios.get(config.url.COURSE + this.$route.params.slug)
                .then(({ data }) => { // get course data
                    this.course = data.course;
                    return axios.post(config.url.USER + data.course.user_id);
                }).then(({ data }) => { // get couse user data
                    this.user = data.user;
                    loadingComponent.close();
                    this.loaded = true;
                });
        },
        data() {
            return {
                course: {},
                user: {},
                loaded: false,
            };
        },
        components: {
            UserCard,
        },
    };
</script>