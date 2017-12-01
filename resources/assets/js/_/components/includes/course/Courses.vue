<template>
    <div>
        <course-box v-for="(course, index) in courses" :key="index" :course="course"></course-box>
    </div>
</template>
<script>
    import config from '../../../../config';
    import CourseBox from './CourseBox.vue';
    export default {
        mounted() {
            axios.get(config.url.COURSE)
                .then(({ data }) => {
                    this.courses = data.courses;
                });
        },
        data: function() {
            return {
                courses: [],
            };
        },
        components: {
            CourseBox,
        },
    };
</script>