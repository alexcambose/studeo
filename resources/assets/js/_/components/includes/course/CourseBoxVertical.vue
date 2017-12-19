<template>
    <div :class="['card', 'course-box', course._joined ? 'course-joined' : '']">
        <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }" >
            <!--todo refactor-->
            <div class="card-image">
                <image-container class="course-image" :src="course._image.filename"></image-container>
            </div>
        </router-link>

        <b-dropdown @active-change="active => dropdownActive = active" class="playlist-button">
            <button class="button is-small is-dark" slot="trigger">
                <b-icon v-if="dropdownActive" icon="menu-down"></b-icon>
                <b-icon v-else icon="plus"></b-icon>
            </button>
            <b-dropdown-item class="playlist-button-header" custom>
                Biblioteca mea
            </b-dropdown-item>
            <b-dropdown-item separator></b-dropdown-item>
            <b-dropdown-item v-for="(playlist, index) in Math.floor(Math.random() * 100) + 1">
                Playlist no #{{playlist}}
            </b-dropdown-item>
        </b-dropdown>

        <div class="card-content cp">
            <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }" >
                <span class="course-title">{{course.title}}</span>

                <div class="course-content">
                    {{course.short_description}}
                </div>
                <user-box :user="course._user" size="is-small"></user-box>
            </router-link>
        </div>
    </div>
</template>
<script>
    import ImageContainer from '../../includes/dumb/ImageContainer.vue';
    import UserBox from '../../includes/dumb/UserBox.vue';

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
        components: {
            ImageContainer,
            UserBox,
        },
    };
</script>