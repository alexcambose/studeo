<template>
    <div>
        <b-field label="Titlu">
            <b-input
                    :value="newCourse.title"
                    @blur="setTitle"
                    maxlength="100"
                    minlength="4"
                    required
            ></b-input>
        </b-field>
        <button @click="fetchBestSlug" :class="['button', 'is-small', 'is-pulled-right', (fetchingSlug ? 'is-loading': '')]">Alege cea mai bună variantă</button>
        <b-field label="Legătură permanentă" :message="`Link-ul cursului tău va fi <em>${courseLink}</em>`">
                <b-input
                        :value="decodeURIComponent(newCourse.slug)"
                        @input.native="setSlug"
                        maxlength="100"
                        minlength="4"
                        expanded
                        required
                ></b-input>
        </b-field>
        <b-field label="Scurtă descriere">
            <b-input
                    maxlength="240"
                    required
                    type="textarea"
                    :value="newCourse.shortDescription"
                    @blur="setShortDescription"
            ></b-input>
        </b-field>
        <b-field label="Descriere completă">
            <b-input
                    maxlength="4000"
                    required
                    type="textarea"
                    :value="newCourse.description"
                    @blur="setDescription"
            ></b-input>
        </b-field>
        <hr>
        <b-field label="Dificultate">
            <b-select expanded placeholder="Selectează un nivel de dificultate" :value="newCourse.difficulty" @blur="setDifficulty">
                <option value="1">Ușor</option>
                <option value="2">Mediu</option>
                <option value="3">Greu</option>
            </b-select>
        </b-field>
        <multiple-fields
                :value="newCourse.prerequisites"
                label="Cerințe preliminare"
                addFieldLabel="Adaugă cerință nouă"
                @change="setPrerequisites"
        ></multiple-fields>
        <div class="mt-10">
            <upload-image title="Imaginea cursului" v-model="image"></upload-image>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import config from '../../../../../../../config';
    import MultipleFields from '../../../../../../components/includes/dumb/MultipleFields.vue';
    import UploadImage from '../../../../../includes/dumb/UploadImage.vue';

    export default {
        methods: {
            setTitle(e) {
                this.$store.dispatch('updateNewCourseData', { title: e.target.value });
                if (this.newCourse.slug.trim() === '') {
                    this.$store.dispatch('updateNewCourseData', { slug: e.target.value.replace(' ', '-').toLowerCase() });
                }
            },
            setSlug(e) {
                this.$store.dispatch('updateNewCourseData', { slug: encodeURIComponent(e.target.value) });
            },
            setShortDescription(e) {
                this.$store.dispatch('updateNewCourseData', { shortDescription: e.target.value });
            },
            setDescription(e) {
                this.$store.dispatch('updateNewCourseData', { description: e.target.value });
            },
            setDifficulty(e) {
                this.$store.dispatch('updateNewCourseData', { difficulty: e.target.value });
            },
            setPrerequisites(values) {
                this.$store.dispatch('updateNewCourseData', { prerequisites: values });
            },
            fetchBestSlug() {
                this.fetchingSlug = true;
                axios.get(config.url.COURSE_BEST_SLUG + this.newCourse.slug)
                    .then(({ data }) => {
                        this.fetchingSlug = false;
                        this.$store.dispatch('updateNewCourseData', { slug: encodeURIComponent(data.slug) });
                    });
            },
        },
        computed: {
            ...mapState({
                newCourse: state => state.newCourse,
            }),
            image: {
                get() {
                    return this.newCourse.image;
                },
                set (value) {
                    this.$store.dispatch('updateNewCourseData', { image: value });
                },
            },
            courseLink() {
                return `${window.location.host}/curs/<b>${encodeURIComponent(this.newCourse.slug)}</b>`;
            },
        },
        data() {
            return {
                fetchingSlug: false,
            };
        },
        components: {
            MultipleFields,
            UploadImage,
        },
    };
</script>