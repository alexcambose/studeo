<template>
    <div>
        <b-field label="Titlu">
            <b-input
                    :value="newCourse.title"
                    @blur="setTitle"
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
        <b-field label="Cerințe preliminare">
            <b-input
                    maxlength="1000"
                    type="textarea"
                    :value="newCourse.prerequisites"
                    @blur="setPrerequisites"
            ></b-input>
        </b-field>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

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
            setPrerequisites(e) {
                this.$store.dispatch('updateNewCourseData', { prerequisites: e.target.value });
            },
        },
        computed: {
            ...mapState({
                newCourse: state => state.newCourse,
            }),
        },
    };
</script>