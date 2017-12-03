<template>
    <div class="card course-box">
        <div class="card-image">
            <image-container class="course-image" :image="course._image.filename"></image-container>
        </div>
        <div class="card-content cp">
            <router-link :to="{ name: 'courseWelcome', params: { slug: this.course.slug } }" >
                <span class="course-title">{{course.id}} - {{course.title}}</span>

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
        components: {
            ImageContainer,
            UserBox,
        },
    };
</script>