<template>
    <div>
        <b-field :label="'Răspunsuri - ' + answers.length"></b-field>
        <b-field v-for="(answer, index) in answers" :key="index">
            <b-input
                    :value="answer.content"
                    @input="value => updateAnswer({ lesson_id, question_index, answer_index: index, data: {content: value}})"
                    expanded
            ></b-input>
            <p class="control">
                <button
                        @click="updateAnswer({ lesson_id, question_index, answer_index: index, data: {isTrue: !answer.isTrue}})"
                        :class="['button', 'is-' + (answer.isTrue ? 'success' : 'default')]"
                >Corect</button>
            </p>
            <p class="control">
                <button
                        @click="deleteAnswer({lesson_id, question_index, answer_index: index})"
                        class="button is-danger"
                ><b-icon pack="fa" icon="trash" size="is-small"></b-icon></button>
            </p>
        </b-field>
        <button
                @click="addAnswer({lesson_id, question_index})"
                class="button is-info"
                :disabled="answers.length !== 0 && !answers[answers.length-1].content"
        ><b-icon pack="fa" icon="plus" size="is-small"></b-icon> &nbsp; Adaugă răspuns posibil</button>

    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
        props: {
            lesson_id: {
                type: Number,
                required: true,
            },
            question_index: {
                type: Number,
                required: true,
            },
        },
        computed: {
            ...mapGetters(['newLessonById', 'questionByIndex']),
            answers() {
                return this.questionByIndex(this.lesson_id, this.question_index).answers;
            },
        },
        methods: {
            ...mapActions(['addAnswer', 'deleteAnswer', 'updateAnswer']),
        },
    };
</script>