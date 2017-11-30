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
    import MultipleFields from '../../../../../../components/includes/dumb/MultipleFields.vue';
    import UploadImage from '../../../../../includes/dumb/UploadImage.vue';

    export default {
        methods: {
            setTitle(e) {
                this.$store.dispatch('updateNewCourseData', { title: e.target.value });
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
        },
        components: {
            MultipleFields,
            UploadImage,
        },
    };
</script>