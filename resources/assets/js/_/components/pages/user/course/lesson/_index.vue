<template>
    <div>
        <section class="hero is-info">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        {{course.title}}
                    </h1>
                    <h2 class="subtitle mt-4 is-pulled-right">
                        <b-icon pack="fa" icon="clock-o"></b-icon>
                        44 minute
                        <!--todo replace time-->
                    </h2>
                    <progress class="progress is-dark" value="45" max="100">45%</progress>

                </div>
            </div>
        </section>
        <div v-if="fetched" class="course-watch">
            <div class="lesson-content">
                <div class="columns">
                    <div class="column is-4">
                        <lesson-sidebar></lesson-sidebar>
                    </div>
                    <div class="column is-8">
                        <lesson-video></lesson-video>
                    </div>
                </div>
            </div>
            <div class="container lesson-footer">
                <lesson-footer></lesson-footer>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    import LessonVideo from './LessonVideo.vue';
    import LessonSidebar from './LessonSidebar.vue';
    import LessonFooter from './LessonFooter.vue';
    // import CourseBox from '../../../../../components/includes/dumb/UserBox';
    // import CourseCard from '../../../../../components/includes/dumb/UserCard';
    export default {
        mounted() {
            const loadingComponent = this.$loading.open();
            this.getLessons(this.$route.params.slug)
                .then(() => this.getCourseInfo(this.$route.params.slug))
                .then(() => {
                    this.fetched = true;
                    loadingComponent.close();
                })
                .catch(() => {
                    this.$router.replace({ name: 'courseWelcome', params: { slug: this.$route.params.slug } });
                    loadingComponent.close();
                });
        },
        data() {
            return {
                fetched: false,
            };
        },
        computed: {
            ...mapState({
                course: ({ course }) => course.courseInfo,
            }),
        },
        methods: mapActions(['getLessons', 'getCourseInfo']),
        components: {
            LessonVideo,
            LessonSidebar,
            LessonFooter,
            // CourseBox,
            // CourseCard,
        },
    };
</script>
