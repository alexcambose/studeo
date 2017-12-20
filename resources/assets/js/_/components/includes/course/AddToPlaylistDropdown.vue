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
        <b-dropdown-item v-for="(playlist, index) in Math.floor(Math.random() * 100) + 1" :key="index">
            Playlist no #{{playlist}}
        </b-dropdown-item>
    </b-dropdown>

</template>

<script>
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
    };
</script>

<style scoped>

</style>