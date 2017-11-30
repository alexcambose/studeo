<template>
    <div>
        <div :class="{ 'modal': true, 'is-active': true }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <form @submit="submit">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Creeaza un playlist</p>
                        <button class="delete" aria-label="close"@click="$emit('close')"></button>
                    </header>
                    <section class="modal-card-body">
                            <b-field label="Titlu">
                                <b-input
                                    type="text"
                                    v-model="title"
                                    maxlength="30"
                                    required
                                >
                                </b-input>
                            </b-field>
                            <b-field label="Descriere">
                                <b-input
                                        type="textarea"
                                        v-model="description"
                                        maxlength="500"
                                        required
                                >
                                </b-input>
                            </b-field>
                    </section><footer class="modal-card-foot">
                        <button class="button" @click="$emit('close')">Cancel</button>
                        <submit :fetching="fetching" :success="success">Salvează</submit>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Submit from '../../../../includes/dumb/Submit.vue';
    export default {
        props: ['active'],
        data() {
            return {
                title: '',
                description: '',
                fetching: false,
                success: '',
            }
        },
        methods: {
            submit(e) {
                e.preventDefault();
                this.fetching = true;
                this.$store.dispatch('playlistCreate', this)
                    .then(() => {
                        this.fetching = false;
                        this.title = '';
                        this.description = '';
                        this.$toast.open({
                            message: 'Ati adaugat un playlist',
                            type: 'is-success'
                        })
                    })
                    .catch(err => {
                        this.$toast.open({
                            message: 'A aparut o eroare..',
                            type: 'is-danger',
                        })
                        this.fetching = false;
                        this.error = err;
                    });
            },
        },
        components: {
            Submit,
        },
    }
</script>