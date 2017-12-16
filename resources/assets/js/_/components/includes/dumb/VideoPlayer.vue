<template>
    <video
            controls
            controlsList="nodownload"
            v-bind="$attrs"
            ref="video"
            :poster="thumbnail ? thumbnailUrl : ''"
    >
        <source :src="url" type="video/mp4">
        Ne pare rău dar browserul tău nu suporta acest format.
    </video>
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
</style>