<template>
    <div>
        <b-field label="Titlu">
            <b-input
                    v-model="title"
                    maxlength="40"
                    minlength="10"
                    required
            ></b-input>
        </b-field>
        <b-field label="Scurtă descriere">
            <b-input
                    maxlength="240"
                    required
                    type="textarea"
                    :value="lesson.shortDescription"
                    @blur="setShortDescription"
            ></b-input>
        </b-field>
        <b-field label="Conținut">
            <b-input
                    maxlength="4000"
                    required
                    type="textarea"
                    :value="lesson.content"
                    @blur="setContent"
            ></b-input>
        </b-field>
        <questions :lesson_id="this.lesson_id"></questions>
        <div class="columns">
            <div class="column">
                <upload-video title="Adaugă fișierul video" v-model="video"></upload-video>
            </div>
            <div class="column">
                <upload-image title="Adaugă miniatură" v-model="thumbnail"></upload-image>
            </div>
        </div>

    </div>
</template>

<script>
    import UploadVideo from '../../../../../includes/dumb/UploadVideo.vue';
    import UploadImage from '../../../../../includes/dumb/UploadImage.vue';
    import Questions from './components/questions/Questions.vue';

    export default {
        computed: {
            lesson_id() {
                return parseInt(this.$route.params.id);
            },
            lesson() {
                return this.$store.getters.newLessonById(this.lesson_id);
            },
            title: {
                get () {
                    return this.lesson.title;
                },
                set (value) {
                    this.$store.dispatch('updateLesson', { id: this.lesson_id, data: { title: value } });
                },
            },
            video: {
                get() {
                    return this.lesson.video;
                },
                set (value) {
                    this.$store.dispatch('updateLesson', { id: this.lesson_id, data: { video: value } });
                },
            },
            thumbnail: {
                get() {
                    return this.lesson.thumbnail;
                },
                set (value) {
                    this.$store.dispatch('updateLesson', { id: this.lesson_id, data: { thumbnail: value } });
                },
            },
        },
        methods: {
            setShortDescription(e) {
                this.$store.dispatch('updateLesson', { id: this.lesson_id, data: { shortDescription: e.target.value } });
            },
            setContent(e) {
                this.$store.dispatch('updateLesson', { id: this.lesson_id, data: { content: e.target.value } });
            },
        },
        components: {
            UploadVideo,
            UploadImage,
            Questions,
        },
    };
</script>