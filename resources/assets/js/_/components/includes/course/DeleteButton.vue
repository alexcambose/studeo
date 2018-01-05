<template>
    <div class="delete-button">
        <button @click="handleDelete" :class="['button', 'is-danger', 'is-small', fetching ? 'is-loading is-warning' : '']">
            <b-icon pack="fa" icon="trash"></b-icon>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            course: {
                type: Object,
                required: true,
            },
        },
        methods: {
            handleDelete() {
                this.$dialog.confirm({
                    title: 'Ștergere',
                    message: 'Ești sigur ca vrei sa ștergi acestă distribuire ?',
                    confirmText: 'Da',
                    cancelText: 'Nu',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        axios.delete(config.url.USER_SHARE_COURSE_DELETE + course.id)
                            .then(({ data }) => {
                                this.$emit('deleted');
                                this.courses = data.courses;
                            });
                    },
                });
            },
        },
    };
</script>