<template>
    <div v-if="loaded" class="course-welcome">
        <section class="hero course-hero is-medium" :style="{backgroundImage: `url(${course._image.filename})`}">
            <div class="background-filter"></div>
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-5">
                            <video controls>
                                <source src="https://ia800605.us.archive.org/23/items/youtube-GzgavGowD_A/Flutterbye_fairy_toy_flies_into_fire_O_Fortuna-GzgavGowD_A.mp4" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>
                        </div>
                        <div class="column is-7">
                            <div class="title is-2">
                                {{course.title}}
                            </div>
                            <div class="subtitle">
                                {{course.shortDescription}}
                                <div class="apply-container">
                                    <button class="button is-outlined is-success apply">Înscriere</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            {{course.description}}
        </div>
    </div>

</template>
<script>
    import config from '../../../../../config';
    export default {
        mounted() {
            const loadingComponent = this.$loading.open();
            axios.get(config.url.COURSE + this.$route.params.slug)
                .then(({ data }) => {
                    loadingComponent.close();
                    this.loaded = true;
                    this.course = data.course;
                });
        },
        data() {
            return {
                course: {},
                loaded: false,
            };
        },
    };
</script>