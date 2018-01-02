<template>
    <div v-if="fetched" class="course-welcome">
        <section ref="courseHeader" class="hero course-hero is-medium" :style="{backgroundImage: `url(${course._image.filename})`}">
            <div class="background-filter"></div>
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-5">
                            <video-player :src="lessons[0]._video.filename"></video-player>
                        </div>
                        <div class="column is-7">
                            <div class="title is-2">
                                {{course.title}}
                            </div>
                            <div class="subtitle">
                                {{course.short_description}}
                                <div class="apply-container">
                                    <button v-if="!course._joined" @click="join" class="button is-outlined is-success apply">Înscriere
                                    </button>
                                    <router-link v-else :to="{ name: 'courseLesson', params: { slug: course.slug, lessonIndex: 1 } }">
                                        <button class="button is-outlined is-primary apply">Continuă</button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container tag-container has-text-centered">
                    <router-link v-for="(tag, index) in course._tags" :key="index" :to="{ name:'courses', query : { eticheta: tag.id } }">
                        <b-tag type="is-dark" class="mr-10">
                            {{tag.label}}
                        </b-tag>
                    </router-link>
                </div>
            </div>
        </section>
        <div class="container mt-20">
            <div class="columns">
                <div class="column is-8">
                    <div v-if="!course._lessons.find(e => !e._watched)" class="notification is-success">
                        <div class="title is-4">Ai terminat acest curs!</div>
                    </div>
                    <div class="notification is-warning">
                        <div class="title is-4">Cerințe preliminare</div>
                        <div v-for="(skill, index) in course.prerequisites" :key="index">
                            <b-icon pack="fa" icon="check"></b-icon> &nbsp; {{skill}}
                        </div>
                    </div>
                    <div class="title is-2">Descriere</div>
                    <hr>
                    <div v-html="courseDescription" class="content"></div>
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

                    <div class="card margin-bottom">
                        <div class="card-header">
                            <p class="card-header-title">Statstici</p>
                        </div>
                        <div class="card-content has-text-centered">
                            <nav class="level">
                                <div class="level-item has-text-centered">
                                    <div>
                                        <p class="heading">Utilizatori</p>
                                        <p class="title">{{course._joined.users || 0}}</p>
                                    </div>
                                </div>
                                <div class="level-item has-text-centered">
                                    <div>
                                        <p class="heading">Vizualizări</p>
                                        <p class="title">{{course.views}}</p>
                                    </div>
                                </div>
                                <div class="level-item has-text-centered">
                                    <div>
                                        <p class="heading">Distribuiri</p>
                                        <p class="title">{{course._shares}}</p>
                                    </div>
                                </div>
                            </nav>
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
    import VideoPlayer from '../../../../components/includes/dumb/VideoPlayer.vue';
    import { markdown } from 'markdown';

    export default {
        mounted () {
            this.fetchCourse();
        },
        data () {
            return {
                course: {},
                user: {},
                lessons: [],
                fetched: false,
            };
        },
        computed: {
            courseDescription() {
                return markdown.toHTML(this.course.description);
            },
        },
        watch: {
            '$route.params.slug'() {
                this.fetchCourse();
            },
        },
        methods: {
            onReady() {
                this.$nextTick(() => {
                    const $courseHeader = this.$refs.courseHeader;
                    window.addEventListener('scroll', () => {
                        $courseHeader.style.backgroundPositionY = (50 + window.scrollY / 10).toFixed(1) + '%';
                        $courseHeader.style.backgroundSize = (100 + window.scrollY/80).toFixed(1) + '%';
                    });
                });
            },
            fetchCourse() {
                this.fetched = false;
                const loadingComponent = this.$loading.open();
                axios.get(config.url.COURSE + this.$route.params.slug)
                    .then(({ data }) => { // get course data
                        this.course = data.course;
                        this.lessons = data.course._lessons;
                        if (!data.course) {
                            loadingComponent.close();
                            this.fetched = true;
                        } else { // if the course was found
                            return axios.get(config.url.USER + data.course.user_id)
                                .then(({ data }) => { // get course user data
                                    this.user = data.user;
                                    loadingComponent.close();
                                    this.fetched = true;
                                    this.onReady();
                                });
                        }
                    })
                    .catch(() => loadingComponent.close());
            },
            join () {
                this.fetching = false;

                axios.post(config.url.COURSE_USER_JOIN, { courseId: this.course.id })
                    .then(({ data }) => {
                        this.fetching = true;
                        this.$router.push({ name: 'courseLesson', params: { slug: this.course.slug } });
                    });
            },
        },
        components: {
            UserCard,
            LessonBox,
            VideoPlayer,
        },
    };
</script>