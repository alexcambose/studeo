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
        <upload-video title="Adaugă fișierul video" subtitle="(.mp4, max 500 MB)"></upload-video>

    </div>
</template>

<script>
    import UploadVideo from '../../../../../includes/dumb/UploadVideo';

    export default {
        computed: {
            lessonId() {
                return parseInt(this.$route.params.id);
            },
            lesson() {
                return this.$store.getters.newLessonById(this.lessonId);
            },
            title: {
                get () {
                    return this.lesson.title;
                },
                set (value) {
                    this.$store.dispatch('updateLesson', { id: this.lessonId, data: { title: value } });
                },
            },
        },
        methods: {
            setShortDescription(e) {
                this.$store.dispatch('updateLesson', { id: this.lessonId, data: { shortDescription: e.target.value } });
            },
            setContent(e) {
                this.$store.dispatch('updateLesson', { id: this.lessonId, data: { content: e.target.value } });
            },
        },
        components: {
            UploadVideo,
        },
    };
</script>