<template>
    <b-dropdown @active-change="active => dropdownActive = active" class="playlist-button">
        <button class="button is-small is-dark" slot="trigger">
            <b-icon v-if="dropdownActive" icon="menu-down"></b-icon>
            <b-icon v-else icon="plus"></b-icon>
        </button>
        <b-dropdown-item class="playlist-button-header" custom>
            Biblioteca mea
        </b-dropdown-item>
        <b-dropdown-item separator></b-dropdown-item>
        <b-dropdown-item v-for="(playlist, index) in playlists" :key="index">
            {{playlist.title}}
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
                dropdownActive: false,
            };
        },
        computed: {
            ...mapState({
                playlists: state => state.playlist.playlists,
            }),
        },
    };
</script>

<style scoped>

</style>