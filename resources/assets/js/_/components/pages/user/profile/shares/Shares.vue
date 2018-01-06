<template>
    <div>
        <div v-for="(courseGroup, index) in chunk(courses, 2)" :key="index" class="columns is-centered">
            <div v-for="course in courseGroup" :key="course.id" class="column is-6">
                <course-box-vertical :course="course" small :shareButton="user.id !== $store.state.user.user.id">

                    <div slot="header-buttons" class="delete-button">
                        <button @click="deleteShare(course.pivot.id)" :class="['button', 'is-danger', 'is-small', fetching ? 'is-loading is-warning' : '']">
                            <b-icon pack="fa" icon="trash"></b-icon>
                        </button>
                    </div>

                </course-box-vertical>
            </div>
        </div>
        <infinite-loading @triggered="infiniteHandler">
            <slot slot="fetching">Se accesează recomandările</slot>
            <slot slot="completed">Nu mai sunt recomandari</slot>
        </infinite-loading>
    </div>

</template>

<script>
    import config from '../../../../../../config';
    import moment from 'moment';
    import _ from 'lodash';
    import CourseBoxVertical from '../../../../includes/course/CourseBoxVertical.vue';
    import InfiniteLoading from '../../../../includes/dumb/InfiniteLoading';

    export default {
        props: {
            user: Object,
        },
        data() {
            return {
                courses: [],
                start: 0,
                fetching: false,
            };
        },
        methods: {
            infiniteHandler($state) {
                axios.get(config.url.USER_SHARE_COURSE_ALL + this.user.id, { params: {
                    start: this.start,
                    amount: config.profile.sharesLoadAmount,
                } })
                    .then(({ data }) => {
                        if (data.courses.length) {
                            this.start += config.profile.postsLoadAmount;
                            this.courses = [...this.courses, ...data.courses];
                            $state.fetched();

                        } else {
                            $state.completed();

                        }
                    });
            },
            deleteShare(pivotId) {
                this.$dialog.confirm({
                    title: 'Ștergere',
                    message: 'Ești sigur ca vrei sa ștergi acestă distribuire ?',
                    confirmText: 'Da',
                    cancelText: 'Nu',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        this.fetching = true;
                        axios.delete(config.url.USER_SHARE_COURSE_DELETE + pivotId)
                            .then(({ data }) => {
                                this.fetching = false;
                                const courseIndex = this.courses.findIndex(e => e.pivot.id === pivotId);
                                this.courses.splice(courseIndex, 1);
                            });
                    },
                });
            },
            moment,
            chunk: _.chunk,
        },
        components: {
            InfiniteLoading,
            CourseBoxVertical,
        },
    };
</script>