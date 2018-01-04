<template>
    <div v-if="!fetching">
        <section class="hero is-bold path-has-bg-img" :style="{ background: 'linear-gradient(42deg,#fff 27%,rgba(255,255,255,.7) 37%,rgba(0,139,201,.45) 74%,rgba(0,157,165,.5) 100%),' + 'url(' + path._image.filename + ') no-repeat center' }">
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
                    <div class="columns has-text-centered">
                        <div class="column is-vcentered">
                            <div class="is-vcentered">
                                asdasdasda
                            </div>
                        </div>
                        <div class="column">
                            asdasdad
                        </div>
                        <div class="column">
                            asdasdada
                        </div>
                        <div class="column">
                            dasdsadadsada
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div v-for="course in path._courses">
                <div class="columns is-centered is-vcentered">
                    <div class="column is-3 has-text-centered">
                        <div class="timeline">
                            <router-link to="" :class="['button', 'is-rounded', checkCourse(course)]" style="z-index: 1">
                                {{ course.pivot.order_index }}
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
    import CourseBoxHorizontal from '../../../../components/includes/course/CourseBoxHorizontal'
    export default {
        mounted() {
            this.fetching = true;
            const loadingComponent = this.$loading.open();
            this.pathById().then(() => {
                this.fetching = false;
                loadingComponent.close();
            });
        },
        data() {
            return {
                path: '',
                fetching: false,
            };
        },
        methods: {
            // TODO move to path.js
            pathById() {
                let id = this.$route.params.path;
                return new Promise((resolve, reject) => {
                    axios.get(config.url.PATH_BY_ID + id)
                        .then(({ data }) => {
                            this.path = data.path;
                            console.log(this.path);
                            resolve(data.paths);
                        })
                        .catch(err => reject(err) );
                });
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