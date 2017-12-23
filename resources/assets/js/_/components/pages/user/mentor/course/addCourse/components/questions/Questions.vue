<template>
    <div>
        <div v-if="questions.length" >
            <question v-for="(question, index) in questions" :key="index" :question_index="index" :lesson_id="lesson_id"></question>
        </div>
        <div v-else class="has-text-centered">
            Nu există întrebari, <span @click="$refs.addQuestionInput.focus()" class="has-text-link cp">adaugă</span> una pentru a verifica cunoștințele la sfârșitul cursului!
        </div>
        <form @submit="addQuestion">
            <b-field class="mt-10">
                <b-input
                    v-model="newQuestionContent"
                    maxlength="120"
                    placeholder="Apasă enter pentru a adauga o întrebare"
                    minlength="10"
                    ref="addQuestionInput"
                    required
                ></b-input>
            </b-field>
        </form>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex';
    import Question from './Question.vue';

    export default {
        props: {
            lesson_id: {
                type: Number,
                required: true,
            },
        },
        computed: {
            ...mapGetters(['newLessonById']),
            questions() {
                return this.newLessonById(this.lesson_id).questions;
            },
        },
        data() {
            return {
                newQuestionContent: '',
            };
        },
        methods: {
            addQuestion() {
                const { lesson_id, newQuestionContent } = this;
                this.$store.dispatch('addQuestion', { lesson_id, content: newQuestionContent });
                this.newQuestionContent = '';
            },
        },
        components: {
            Question,
        },
    };
</script>