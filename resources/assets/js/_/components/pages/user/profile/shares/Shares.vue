<template>
    <div>
        <div v-for="(courseGroup, index) in chunk(courses, 2)" :key="index" class="columns is-centered">
            <div v-for="course in courseGroup" :key="course.id" class="column is-6">
                <course-box-vertical :course="course" small :as-shared="user.id === $store.state.user.user.id"></course-box-vertical>
            </div>
        </div>
    </div>

</template>

<script>
    import config from '../../../../../../config';
    import moment from 'moment';
    import _ from 'lodash';
    import CourseBoxVertical from '../../../../includes/course/CourseBoxVertical.vue';
    export default {
        props: {
            user: Object,
        },
        mounted() {
            axios.get(config.url.USER_SHARE_COURSE_ALL + this.user.id)
                .then(({ data }) => {
                    this.courses = data.courses;
                });
        },
        data() {
            return {
                courses: [],
            };
        },
        methods: {
            moment,
            chunk: _.chunk,
        },
        components: {
            CourseBoxVertical,
        },
    };
</script>