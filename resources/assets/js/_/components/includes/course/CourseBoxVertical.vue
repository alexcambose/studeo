<template>
    <div :class="['card', 'course-box', course._joined ? 'course-joined' : '']">
        <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }" >
            <!--todo refactor-->
            <div class="card-image">
                <image-container class="course-image" :src="course._image.filename"></image-container>
                <div class="image-footer">
                    <b-tag type="is-dark" class="difficulty-tag">{{difficultyLabel}}</b-tag>
                </div>
            </div>
        </router-link>

        <add-to-playlist-dropdown :course="course"></add-to-playlist-dropdown>

        <div class="card-content cp">
            <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }" >
                <span class="course-title">{{course.id}} | {{course.title}}</span>

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
    import AddToPlaylistDropdown from './AddToPlaylistDropdown.vue';
    export default {
        props: {
            course: {
                type: Object,
                required: true,
            },
        },
        computed: {
            difficultyLabel() {
                if (this.course.difficulty === 3) return 'Greu';
                if (this.course.difficulty === 2) return 'Mediu';
                return 'Ușor';
            },
        },
        components: {
            ImageContainer,
            UserBox,
            AddToPlaylistDropdown,
        },
    };
</script>