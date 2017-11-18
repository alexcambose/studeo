<template>
    <div>
        <b-field label="Nivel de studii">
            <b-select expanded
                      v-model="school_level"
                      placeholder="Selectează o treaptă de studiu in care se situează cursul"
                      icon-pack="fa"
                      icon="university"
            >
                <option v-for="(level, index) in classLevels" :value="index">{{level}}</option>
            </b-select>
        </b-field>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import config from '../../../../../../../config';

    export default {
        computed: {
            ...mapState({
                newCourse: state => state.newCourse,
            }),
        },
        data () {
            return {
                classLevels: config.classLevels,
            };
        },
        methods: {
            setPurpose(e) {
                this.$store.dispatch('updateNewCourseData', { pupose: e.target.value });
            },
        },

    };
</script>