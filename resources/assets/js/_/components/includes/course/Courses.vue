<template>
    <div>
        <div v-for="(courseGroup, index) in chunkArray(courses, 4)" :key="index" class="columns">
            <div class="column is-3" v-for="(course, index) in courseGroup" :key="index">
                <course-box :course="course"></course-box>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler">
            <span slot="no-more">Nu mai sunt cursuri de încărcat! :)</span>
        </infinite-loading>
    </div>
</template>
<script>
    import config from '../../../../config';
    import { chunkArray } from '../../../../utils';
    import CourseBox from './CourseBox.vue';
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        data: function() {
            return {
                courses: [],
                loadIndex: 0,
            };
        },
        methods: {
            chunkArray,
            infiniteHandler($state) {
                axios.get(config.url.COURSE_ALL + this.$store.state.user.user.id, {
                    params: {
                        start: this.loadIndex,
                        end: config.course.loadAmount,
                    },
                }).then(({ data }) => {
                    if (data.courses.length) {
                        this.loadIndex += config.course.loadAmount;
                        data.courses.forEach(course => {
                            this.courses.push(course);
                        });
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
            },
        },
        components: {
            CourseBox,
            InfiniteLoading,
        },
    };
</script>