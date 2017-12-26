<template>
    <div class="share-button">
        <button @click="courseShare" :class="['button', 'is-dark', 'is-small', fetching ? 'is-loading is-link' : '']">
            <b-icon pack="fa" icon="share-alt"></b-icon>
        </button>
    </div>
</template>

<script>
    import config from '../../../../config';
    export default {
        props: {
            course: {
                type: Object,
                required: true,
            },
        },
        data() {
            return {
                fetching: false,
            };
        },
        methods: {
            courseShare() {
                this.fetching = true;
                axios.post(config.url.USER_SHARE_COURSE_ADD + this.course.id)
                    .then(() => {
                        this.fetching = false;
                        this.$toast.open({ message: 'Cursul a fost distribuit', type: 'is-success' });
                    })
                    .catch(() => this.$toast.open({ message: 'Eroare', type: 'is-danger' }));
            },
        },
    };
</script>