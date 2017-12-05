<template>
    <div>
        <form @submit="submit">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Adauga un playlist</p>
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
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="$parent.close()">Close</button>
                    <submit :fetching="fetching" :success="success">Salvează</submit>
                </footer>
            </div>
        </form>
    </div>
</template>
<script>
    import Submit from '../../../../includes/dumb/Submit.vue';
    export default {
        data() {
            return {
                fromProps: {
                    title: '',
                    description: '',
                },
                isComponentModalActive: false,
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
                        this.isComponentModalActive = false;
                        this.$toast.open({
                            message: 'Ati adaugat un playlist',
                            type: 'is-success'
                        });
                        this.$router.push({ name: 'playlists' });
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