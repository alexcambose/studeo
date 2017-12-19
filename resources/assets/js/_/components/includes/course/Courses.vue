<template>
    <div>
        <div class="is-clearfix">
            <dropdown :values="[
            {
              title: 'Data postării crescătoare',
              subtitle: 'De la cel mai vechi până la cel mai nou curs',
              icon: 'sort-numeric-asc',
              value: 'date-asc'
            },{
              title: 'Data postării descrescătoare',
              subtitle: 'De la cel mai nou până la cel mai vechi curs',
              icon: 'sort-numeric-desc',
              value: 'date-desc'
            },
            {
              title: 'Alfabetic crescător',
              subtitle: 'Ordine alfabetică crescătoare',
              icon: 'sort-alpha-asc',
              value: 'alph-asc'
            },{
              title: 'Alfabetic descrescător',
              subtitle: 'Ordine alfabetică descrescătoare',
              icon: 'sort-alpha-desc',
              value: 'alph-desc'
            }
            ]" v-model="sorting" :changed="resetCourses" label="Sortează după: " class="is-pulled-right"></dropdown>

        </div><hr>
        <div v-for="(courseGroup, index) in chunkArray(courses, 4)" :key="index" class="columns">
            <div class="column is-3" v-for="(course, index) in courseGroup" :key="index">
                <course-box :course="course"></course-box>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
            <span slot="no-more">Nu mai sunt cursuri de încărcat! :)</span>
        </infinite-loading>
    </div>
</template>
<script>
    import config from '../../../../config';
    import { chunkArray } from '../../../../utils';
    import CourseBoxVertical from './CourseBoxVertical.vue';
    import Dropdown from '../dumb/Dropdown.vue';
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        data: function() {
            return {
                courses: [],
                loadIndex: 0,
                sorting: 'date-desc',
            };
        },
        mounted() {
            this.getCourses();
        },
        methods: {
            chunkArray,
            infiniteHandler($state) {
                this.getCourses()
                    .then(courses => {
                        if (courses.length) {
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    });
            },
            getCourses() {
                return new Promise((resolve, reject) => {
                    axios.get(config.url.COURSE_ALL + this.$store.state.user.user.id, {
                        params: {
                            start: this.loadIndex,
                            end: config.course.loadAmount,
                            sort: this.sorting,
                        },
                    }).then(({ data }) => {
                        if (data.courses.length) {
                            this.loadIndex += config.course.loadAmount;
                            data.courses.forEach(course => {
                                this.courses.push(course);
                            });
                            resolve(data.courses);
                        } else {
                            resolve(data.courses);
                        }
                    });
                });
            },
            resetCourses() {
                this.courses = [];
                this.loadIndex = 0;
                this.$nextTick(() => {
                    this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                });
            },
        },
        components: {
            CourseBoxVertical,
            Dropdown,
            InfiniteLoading,
        },
    };
</script>