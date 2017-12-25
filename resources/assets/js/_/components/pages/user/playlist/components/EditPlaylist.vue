<template>
    <div>
        <form @submit="updatePlaylist">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Editează playlistul</p>
                </header>
                <section class="modal-card-body">
                    <b-field label="Titlu">
                        <b-input
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

                    <b-field label="Culoare:">
                        <b-input
                                type="color"
                                v-model="color"
                                required
                        >
                        </b-input>
                    </b-field>

                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="$parent.close()">Anulează</button>
                    <submit :fetching="fetching" :success="success">Salvează</submit>
                </footer>
            </div>
        </form>
    </div>
</template>

<script>
    import Submit from '../../../../includes/dumb/Submit';
    import { mapState, mapActions } from 'vuex';
    export default {
        props: ['playlist'],
        mounted() {
            this.title = this.$store.state.playlist.playlists[this.playlistIndex].title;
            this.description = this.$store.state.playlist.playlists[this.playlistIndex].description;
            this.color = this.$store.state.playlist.playlists[this.playlistIndex].color;
        },
        data() {
            return {
                fetching: false,
                success: '',
                title: '',
                description: '',
                color: '',
            };
        },
        computed: {
            playlistIndex() {
                return this.$store.state.playlist.playlists.findIndex(e => e.id == this.$route.params.id);
            },
        },
        methods: {
            ...mapActions(['savePlaylist']),
            updatePlaylist(e) {
                e.preventDefault();
                this.fetching = true;
                let playlists = this.$store.state.playlist.playlists;
                let playlistIndex = playlists.findIndex(e => e.id == this.$route.params.id);
                this.savePlaylist({ playlistIndex: playlistIndex, data: this })
                    .then(() => {
                        this.fetching = false;
                        this.$toast.open({
                            message: 'Ați editat un playlist',
                            type: 'is-success',
                        });
                    })
            },
        },
        components: {
            Submit,
        }
    }
</script>

