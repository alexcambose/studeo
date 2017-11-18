<template>
    <div>
        <b-field label="Scopul cursului">
            <b-input
                    maxlength="2000"
                    type="textarea"
                    placeholder="Ce vor invața cei ce se vor uita la curs ?"
                    :value="newCourse.purpose"
                    rows="6"
                    @blur="setPurpose"
            ></b-input>
        </b-field>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        methods: {
            setPurpose(e) {
                this.$store.dispatch('updateNewCourseData', { purpose: e.target.value });
            },
        },
        computed: {
            ...mapState({
                newCourse: state => state.newCourse,
            }),
        },
    };
</script>