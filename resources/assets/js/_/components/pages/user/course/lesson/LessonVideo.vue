<template>
    <div>
        <div class="title is-4">{{lesson.short_description}}</div>
        <video-player
                :onEnded="onEnded"
                :src="lesson._video.filename"
                :thumbnail="lesson._thumbnail.filename"
                class="video"
        ></video-player>
        <div class="box">
            {{lesson.content}}
        </div>
    </div>
</template>

<script>
    import VideoPlayer from '../../../../includes/dumb/VideoPlayer.vue';
    export default {
        props: {
            onEnded: {
                type: Function,
            },
        },
        computed: {
            lesson() {
                const state = this.$store.state;
                const { currentLessonIndex } = state.course;
                return state.course.lessons[currentLessonIndex];
            },
        },
        components: {
            VideoPlayer,
        },
    };
</script>

<style scoped>
    .video{
        width: 100%;
    }
</style>