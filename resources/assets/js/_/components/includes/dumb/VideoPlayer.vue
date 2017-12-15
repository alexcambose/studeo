<template>
    <div class="video-container" ref="videoContainer">
        <video
                controls
                controlsList="nodownload"
                v-bind="$attrs"
                ref="video"
                :poster="thumbnail ? thumbnailUrl : ''">
            <source :src="url" type="video/mp4">
            Ne pare rău dar browserul tău nu suporta acest format.
        </video>
        <!--<div :class="['video-play', playing ? 'hidden' : '']" ref="videoPlay"></div>-->

    </div>
</template>

<script>
    import config from '../../../../config';
    export default {
        props: {
            src: {
                type: String,
                required: true,
            },
            thumbnail: {
                type: String,
                required: false,
            },
            onEnded: {
                type: Function,
                required: false,
            },
            notFromServer: {
                type: Boolean,
                required: false,
            },
        },
        mounted() {
            const $video = this.$refs.video;
            // this.$refs.videoContainer.addEventListener('click', () => {
            //     if (!this.playing) $video.play();
            //     else $video.pause();
            // });
            $video.onplay = () => {
                this.playing = true;
            };
            $video.onpause = () => {
                this.playing = false;
            };
            $video.onended = () => this.onEnded ? this.onEnded() : null;
        },
        data() {
            return {
                playing: false,
            };
        },
        computed: {
            url() {
                return (this.notFromServer ? '' : config.url.SERVER) + this.src;
            },
            thumbnailUrl() {
                return (this.notFromServer ? '' : config.url.SERVER) + this.thumbnail;
            },
        },
    };
</script>

<style scoped>
.video-container{
    position: relative;
}
.video-play {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 38px;
    background-color: #000;
    opacity: 0.5;
    visibility: visible;
}
.video-play.hidden{
    visibility: hidden;
}
</style>