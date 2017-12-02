<template>
    <div>
        <div v-for="(courseGroup, index) in chunkArray(courses, 4)" :key="index" class="columns">
            <div class="column is-3" v-for="(course, index) in courseGroup" :key="index">
                <course-box :course="course"></course-box>
            </div>
        </div>
    </div>
</template>
<script>
    import config from '../../../../config';
    import { chunkArray } from '../../../../utils';
    import CourseBox from './CourseBox.vue';
    export default {
        mounted() {
            axios.get(config.url.COURSE_ALL + this.$store.state.user.user.id)
                .then(({ data }) => {
                    this.courses = data.courses;
                });
        },
        data: function() {
            return {
                courses: [],
            };
        },
        methods: {
            chunkArray,
        },
        components: {
            CourseBox,
        },
    };
</script>