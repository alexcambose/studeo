<template>
    <div>
        <!-- TODO: Modal/Dialog cu SALUTARE DOMNULE SANDEL -->
        <!--<div>-->
        <!--<card :title="'SALUTARE DOMNULE, ' + $store.state.user.user.first_name">-->
        <!--<hr>-->
        <!--Tu:-->
        <!--<pre>{{$store.state.user.user}}</pre>-->
        <!--</card>-->
        <!--</div>-->

        <nav class="nav-home is-centered" role="navigation" aria-label="dropdown navigation">
            <ul>
                <li class="nav-home-item"><router-link :to="{ path: '/'}"><b-icon pack="fa" icon="globe" size="is-small"></b-icon> Toate categoriile</router-link></li>
                <li class="nav-home-item" v-for="(item, index) in classes"><router-link :to="{ name: 'category', params: { category: item.slug } }"><b-icon pack="fa" :icon="item.icon" size="is-small"></b-icon> {{ item.name }}</router-link></li>
            </ul>
        </nav>
        <div class="container">
            <div class="columns is-multiline">
                <div v-for="(course, index) in courses" :key="index" class="column is-one-fifth mt-15">
                    <course-box-vertical :course="course" small></course-box-vertical>
                </div>
            </div>
            <div  v-if="!fetching" class="more-home">
                <router-link v-if="$route.params.category" :to="{ name: 'courses', query: { categorie: $route.params.category } }" class="button is-primary is-outlined">Vezi mai mult &nbsp; <i class="fa fa-arrow-right"></i></router-link>
                <router-link v-else :to="{ name: 'courses'}" class="button is-primary is-outlined">Vezi mai mult &nbsp; <i class="fa fa-arrow-right"></i></router-link>
            </div>
            <div v-if="!fetching" class="columns mt-10">
                <div class="column">
                    <a @click="moveLeft" class="button is-rounded"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="column" style="text-align: center">
                    <div class="recommended-title">Recomandate pentru tine</div>
                </div>
                <div class="column">
                    <a @click="moveRight" class="button is-rounded" style="float: right"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div v-if="!fetching" class="columns" id="recomandate" style="overflow-x: auto;">
                <div v-for="(course, index) in recommended" class="column is-3">
                    <course-box-vertical :course="course" id="course" small></course-box-vertical>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import HomeCard from '../../includes/dumb/HomeCard.vue';
    import Card from '../../includes/dumb/Card.vue';
    import UploadImage from '../../includes/dumb/UploadImage.vue';
    import MarkdownTextarea from '../../includes/dumb/MarkdownTextarea';
    import { MATERII } from '../../../../utils';
    import config from '../../../../config';
    import CourseBoxVertical from '../../includes/course/CourseBoxVertical';
    export default {
        mounted() {
            const loadingComponent = this.$loading.open();
            this.fetching = true;
            this.category = this.$route.params.category;
            this.getCourses(this.category).then(() => {
                loadingComponent.close();
                this.fetching = false;
            });
            this.getRecommendations();
        },
        data: function() {
            return {
                classes: MATERII,
                courses: [],
                fetching: false,
                category: '',
                recommended: [],
            };
        },
        watch: {
            '$route.params.category'() {
                this.fetching = true;
                this.courses = [];
                const loadingComponent = this.$loading.open();
                this.category = this.$route.params.category;
                this.getCourses(this.category).then(() => { this.fetching = false; loadingComponent.close(); });
            },
        },
        methods: {
            getCourses(categorySlug) {
                return new Promise((resolve, reject) => {
                    axios.get(config.url.COURSE_ALL)
                        .then(({ data }) => {
                            if (data.courses.length ) {
                                data.courses.sort((a, b) => b.views - a.views);
                                if (this.$route.params.category != undefined) {
                                    let category = this.classes.find(e => e.slug == categorySlug);
                                    data.courses.forEach(course => {
                                        if (this.courses.length < 5) {
                                            if (!this.courses.find(e => e.id === course.id) && course.category == category.id) this.courses.push(course);
                                        }
                                    });
                                } else {
                                    data.courses.forEach(course => {
                                        if (this.courses.length < 5) {
                                            if (!this.courses.find(e => e.id === course.id)) this.courses.push(course);
                                        }
                                    });
                                }
                                resolve(data.courses);
                            } else {
                                reject();
                            }
                        }).catch(err => reject(err));
                });
            },
            getRecommendations() {
                return new Promise( (resolve, reject) => {
                    axios.get(config.url.USER_RECOMMENDED)
                        .then(({ data }) => {
                            this.recommended = data.courses;
                            if (data.courses.length < 4) {
                                this.recommended = [...this.recommended, ...this.courses];
                            }
                            resolve(data.courses);
                        })
                        .catch(err => reject(err));
                });
            },
            moveLeft() {
                let width = document.getElementById('course').offsetWidth * 3;
                document.getElementById('recomandate').scrollBy({
                    left: -width,
                    behavior: 'smooth',
                });
            },
            moveRight() {
                let width = document.getElementById('course').offsetWidth * 3;
                document.getElementById('recomandate').scrollBy({
                    left: width,
                    behavior: 'smooth',
                });

            },
        },
        components: {
            MarkdownTextarea,
            Card,
            HomeCard,
            UploadImage,
            CourseBoxVertical,
        },
    };
</script>

<style scoped>
    .is-exact-active {
        color: #00d1b2 !important;
    }
    .recommended-title {
        font-size: 20px;
        color: #505763;
        font-width: 50;
    }
</style>