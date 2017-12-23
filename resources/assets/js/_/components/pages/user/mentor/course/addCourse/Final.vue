<template>
    <div>
        <span class="is-size-2">Finalizare curs</span>
        <hr>
        <b-notification v-if="errors.length" v-for="(error, index) in errors" v-html="error" :key="index" type="is-danger"></b-notification>
        <progress v-if="fetching" class="progress is-success" :value="progress" max="100"></progress>
        <div class="has-text-centered">
            <button @click="sendCourse" :class="['button','is-large', 'is-success', (fetching ? 'is-loading' : '')]">Trimite</button>
        </div>
    </div>

</template>
<script>
    export default {
        computed: {
            course() {
                return this.$store.state.newCourse;
            },
        },
        data() {
            return {
                errors: [],
                success: false,
                progress: 0,
                fetching: false,
            };
        },
        methods: {
            sendCourse() {
                this.success = false;
                this.fetching = true;
                this.$store.dispatch('courseAdd', progress => this.progress = progress)
                    .then(() => {
                        this.$router.push({ name: 'dashboard' });
                        this.success = true;
                        this.fetching = false;
                    })
                    .catch(err => {
                        this.errors = err;
                        this.fetching = false;
                    });
            },
        },
    };
</script>