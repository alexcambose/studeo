<template>
    <div>
        <div class="title is-4">{{lesson.short_description}}</div>
        <video-player
                :onEnded="onEnded"
                :src="lesson._video.filename"
                :thumbnail="lesson._thumbnail.filename"
                class="video"
        ></video-player>
        <div v-html="lessonContent" class="box content"></div>
    </div>
</template>

<script>
    import VideoPlayer from '../../../../includes/dumb/VideoPlayer.vue';
    import { markdown } from 'markdown';

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
            lessonContent() {
                return markdown.toHTML(this.lesson.content);
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