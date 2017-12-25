<template>
    <b-dropdown @active-change="active => dropdownActive = active" class="playlist-button">
        <button :class="['button', 'is-small','is-dark', fetching ? 'is-loading is-link' : '']" slot="trigger">
            <b-icon v-if="dropdownActive" icon="menu-down"></b-icon>
            <b-icon v-else icon="plus"></b-icon>
        </button>
        <b-dropdown-item class="playlist-button-header" custom>
            Biblioteca mea
        </b-dropdown-item>
        <b-dropdown-item separator></b-dropdown-item>
        <b-dropdown-item v-for="(playlist, index) in playlists" :key="index" paddingless custom>
            <div @click="togglePlaylist(index)" class="playlist-item">
                <b-icon v-if="playlist._courses.find(e => e.id === course.id)" pack="fa" icon="check" size="is-small" :style="{color: playlist.color}"></b-icon>
                &nbsp; <span :style="{color: playlist.color}">{{playlist.title}}</span>
            </div>
        </b-dropdown-item>
    </b-dropdown>
</template>

<script>
    import { mapState } from 'vuex';
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
                dropdownActive: false,
            };
        },
        computed: {
            ...mapState({
                playlists: state => state.playlist.playlists,
            }),
        },
        methods: {
            togglePlaylist(playlistIndex) {
                this.fetching = true;
                const shouldDelete = this.playlists[playlistIndex]._courses.find(e => e.id === this.course.id);
                this.$store.dispatch(shouldDelete ? 'deleteCoursePlaylist' : 'addCoursePlaylist', { playlistIndex, courseId: this.course.id })
                    .then(() => {
                        this.$store.dispatch('getAllPlaylists').then(() => {
                            this.fetching = false;
                            if (shouldDelete) {
                                this.$toast.open({
                                    message: 'Cursul a fost eliminat din playlist!',
                                    type: 'is-danger',
                                });
                            } else {
                                this.$toast.open({
                                    message: 'Cursul a fost adăugat in playlist!',
                                    type: 'is-success',
                                });
                            }
                        });
                    });
            },
        },
    };
</script>

<style scoped>

</style>