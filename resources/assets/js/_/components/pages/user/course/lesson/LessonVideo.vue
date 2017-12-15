<template>
    <div>
        <div class="title is-4">{{lesson.short_description}}</div>
        <video-player
                :onEnded="onVideoEnded"
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
    import { mapActions } from 'vuex';
    import VideoPlayer from '../../../../includes/dumb/VideoPlayer.vue';
    export default {
        computed: {
            lesson() {
                const state = this.$store.state;
                const { currentLessonIndex } = state.course;
                return state.course.lessons[currentLessonIndex];
            },
        },
        methods: {
            ...mapActions(['lessonMarkAsViewed']),
            onVideoEnded() {
                if (this.lesson._quesions) {
                    alert('Are intrabeari');
                } else if (!this.lesson._watched) {
                    this.lessonMarkAsViewed()
                        .then(() => {
                            this.$dialog.alert({
                                title: 'Ai terminat o lecție!',
                                message: `Felicitări pentru terminarea lecției <b>${this.lesson.title}</b>.`,
                                confirmText: 'Următoarea lecție!',
                            });
                        });
                }
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