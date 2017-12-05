<template>
    <div v-if="!fetching" class="course-welcome">
        <section class="hero course-hero is-medium" :style="{backgroundImage: `url(${course._image.filename})`}">
            <div class="background-filter"></div>
            <div class="hero-body">
                <div class="container content-lower">
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
                    <div class="notification is-warning">
                        <div class="title is-4">Cerințe preliminare</div>
                        <div v-for="(skill, index) in course.prerequisites" :key="index">
                            <b-icon pack="fa" icon="check"></b-icon> &nbsp; {{skill}}
                        </div>
                    </div>
                    <div class="title is-2">Descriere</div>
                    <hr>
                    {{course.description}}
                    <hr>
                    <div class="title is-2">Lecții - {{lessons.length}}</div>
                    <lesson-box v-for="(lesson, index) in lessons" :key="index" :lesson="lesson"></lesson-box>
                </div>
                <div class="column is-4">

                    <div class="notification is-link">
                        <div class="title is-4">Ce vei învăța ?</div>
                        <div v-for="(skill, index) in course.purpose_what_will_learn" :key="index">
                            <b-icon pack="fa" icon="check"></b-icon> &nbsp; {{skill}}
                        </div>
                    </div>

                    <div class="card margin-bottom">
                        <div class="card-header">
                            <p class="card-header-title">Dificultate</p>
                        </div>
                        <div class="card-content has-text-centered">
                            <b-tag v-if="course.difficulty == 1" type="is-success" size="is-large">Ușor</b-tag>
                            <b-tag v-else-if="course.difficulty == 2" type="is-info" size="is-large">Mediu</b-tag>
                            <b-tag v-else type="is-danger" size="is-large">Greu</b-tag>
                        </div>
                    </div>

                    <user-card :user="user"></user-card>
                    <!--<button class="button is-success is-fullwidth mt-10">Înscriere</button>-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import config from '../../../../../config';
    import UserCard from '../../../../components/includes/dumb/UserCard.vue';
    import LessonBox from '../../../../components/includes/dumb/LessonBox.vue';

    export default {
        mounted() {
            const loadingComponent = this.$loading.open();
            axios.get(config.url.COURSE + this.$route.params.slug)
                .then(({ data }) => { // get course data
                    this.course = data.course;
                    if (!data.course) {
                        loadingComponent.close();
                        this.fetching = false;
                        this.$router.push({ name: '404' });
                    } else { // if the course was found
                        return axios.post(config.url.USER + data.course.user_id)
                            .then(({ data }) => { // get course user data
                                this.user = data.user;
                                return axios.get(config.url.LESSON_ALL + this.course.id);
                            }).then(({ data }) => {
                                this.lessons = data.lessons;
                                loadingComponent.close();
                                this.fetching = false;
                            });
                    }
                });
        },
        data() {
            return {
                course: {},
                user: {},
                lessons: [],
                fetching: true,
            };
        },
        components: {
            UserCard,
            LessonBox,
        },
    };
</script>