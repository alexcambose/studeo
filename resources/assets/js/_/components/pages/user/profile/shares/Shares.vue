<template>
    <div>
        <div v-for="course in courses" :key="course.id" >
            <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }">
                {{course.title}}
            </router-link>
            <div class="is-clearfix mt-10">
                <button @click="deleteShare(course.pivot.id)" class="button is-danger is-small is-pulled-left">
                    <b-icon pack="fa" icon="trash"></b-icon>
                </button>
                <span :title="course.pivot.created_at" class="is-pulled-right">{{moment(course.pivot.created_at).fromNow()}}</span>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
    import config from '../../../../../../config';
    import moment from 'moment';
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
            deleteShare(pivotId) {
                this.$dialog.confirm({
                    title: 'Ștergere',
                    message: 'Ești sigur ca vrei sa ștergi acestă distribuire ?',
                    confirmText: 'Da',
                    cancelText: 'Nu',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        axios.delete(config.url.USER_SHARE_COURSE_DELETE + pivotId)
                            .then(({ data }) => {
                                this.courses = data.courses;
                            });
                    },
                });
            },
            moment,
        },
    };
</script>