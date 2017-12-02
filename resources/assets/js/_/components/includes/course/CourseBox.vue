<template>

    <div class="card course-box">
        <div class="card-image">
            <image-container class="course-image" :image="course._image.filename"></image-container>
        </div>
        <div class="card-content cp" @click="goto">
            <span class="course-title">{{course.title}}</span>

            <div class="course-content">
               {{course.shortDescription}}
            </div>

            <user-box :user="course._user"></user-box>
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
        methods: {
            goto() {
                this.$router.push({});
            },
        },
        components: {
            ImageContainer,
            UserBox,
        },
    };
</script>