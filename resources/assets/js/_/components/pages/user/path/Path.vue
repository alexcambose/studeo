<template>
    <div>
        <section class="hero is-bold path-has-bg-img" :style="{ background: 'linear-gradient(42deg,#fff 27%,rgba(255,255,255,.7) 37%,rgba(0,139,201,.45) 74%,rgba(0,157,165,.5) 100%),' + 'url(' + path.image + ') no-repeat center' }">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column">
                            <div class="title">
                                {{ path.title }}
                            </div>
                            <div>
                                {{ path.description }}
                            </div>
                        </div>
                        <div class="column"></div>
                    </div>
                </div>
            </div>
            <div class="path-bottom bottom">
                <div class="container">
                    <div class="columns columns-vcentered">
                        <div class="column has-text-centered column-path-vcentered">
                            <b-icon icon="play" size="is-medium"></b-icon>&nbsp;<strong>{{ totalDuration(courses) }}</strong>&nbsp;de Lorem ipsum.
                        </div>
                        <div class="column has-text-centered column-path-vcentered">
                            <b-icon icon="certificate" size="is-medium"></b-icon>&nbsp;<strong>Invata</strong>&nbsp;lucruri noi.
                        </div>
                        <div class="column has-text-centered column-path-vcentered">
                            <b-icon icon="check-all" size="is-medium"></b-icon>&nbsp;Pune in&nbsp;<strong>practica</strong>&nbsp;ce-ai invatat.
                        </div>
                        <div class="column has-text-centered column-path-vcentered">
                            <b-icon icon="weather-night" size="is-medium"></b-icon>&nbsp;<strong>Avanseaza</strong>&nbsp;in cariera.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div v-for="(course, index) in courses">
                <div class="columns is-centered is-vcentered">
                    <div class="column is-3 has-text-centered">
                        <div class="timeline">
                            <router-link to="" :class="['button', 'is-rounded', checkCourse(course)]" style="z-index: 1">
                                {{ index + 1 }}
                            </router-link>
                        </div>
                    </div>
                    <div class="column">
                        <course-box-horizontal :course="course"></course-box-horizontal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import config from '../../../../../config';
    import CourseBoxHorizontal from '../../../../components/includes/course/CourseBoxHorizontal';
    import { timeConvert } from '../../../../../utils';
    export default {
        mounted() {
            this.pathById();
            this.path.courses.forEach(e => {
                this.getCourse(e).then(() => {
                    this.courses.push(this.course);
                });
            });
        },
        data() {
            return {
                path: '',
                fetching: false,
                paths: config.paths,
                course: '',
                courses: [],
            };
        },
        methods: {
            getCourse(id) {
                return new Promise((resolve, reject) => {
                    axios.get(config.url.COURSE_BY_ID + id)
                        .then(({ data }) => {
                            if (data.success) {
                                this.course = data.course;
                                resolve(data.course);
                            } else {
                                reject();
                            }
                        }).catch(err => reject(err));
                });
            },
            totalDuration(courses) {
                let totalDuration = courses
                    .reduce((total, path) => {
                        return total + path._lessons.reduce((seconds, lesson) => seconds + lesson.length, 0);
                    }, 0);
                return timeConvert(totalDuration);
            },
            pathById() {
                let id = this.$route.params.path;
                this.path = this.paths.find(e => e.id === id);
            },
            checkCourse(course) {
                let lessons = course._lessons;
                let watchedLessons = lessons.filter(e => e._watched).length;
                if (watchedLessons === 0) {
                    return 'is-link';
                } else if ( watchedLessons === lessons.length ) {
                    return 'is-primary';
                } else {
                    return 'is-danger';
                }
            },
        },
        components: {
            CourseBoxHorizontal,
        },
    };
</script>