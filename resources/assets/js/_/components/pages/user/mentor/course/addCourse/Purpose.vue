<template>
    <div>
        <b-field label="Scopul cursului">
            <b-input
                    maxlength="2000"
                    type="textarea"
                    placeholder=""
                    :value="newCourse.purpose"
                    rows="6"
                    @blur="setPurpose"
            ></b-input>
        </b-field>
        <multiple-fields
                :value="newCourse.purposeWhatWillLearn"
                label="Ce vor invața cei ce se vor uita la curs ?"
                @change="setPurposeWhatWillLearn"
        ></multiple-fields>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import MultipleFields from '../../../../../../components/includes/dumb/MultipleFields.vue';

    export default {
        methods: {
            setPurpose(e) {
                this.$store.dispatch('updateNewCourseData', { purpose: e.target.value });
            },
            setPurposeWhatWillLearn(value) {
                this.$store.dispatch('updateNewCourseData', { purposeWhatWillLearn: value });
            },
        },
        computed: {
            ...mapState({
                newCourse: state => state.newCourse,
            }),
        },
        components: {
            MultipleFields,
        },
    };
</script>