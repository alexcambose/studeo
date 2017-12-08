<template>
    <b-collapse class="card" :open.sync="isOpen">
        <div slot="trigger" class="card-header">
            <p class="card-header-title">
                <span v-if="content">{{content}}</span>
                <span v-else class="has-text-danger"><em>Fără titlu</em></span>
            </p>
            <a class="card-header-icon">
                <span class="mr-10">
                    <b-tag v-if="question.answers.filter(e => e.is_true).length === 0" type="is-danger">Fără răspuns</b-tag>
                    <b-tag v-if="question.answers.length && question.answers.filter(e => e.is_true).length === question.answers.length" type="is-danger">Toate variantele sunt corecte</b-tag>
                    <b-tag v-else-if="question.answers.filter(e => e.is_true).length > 1" type="is-dark">Variante multiple</b-tag>
                </span>

                <button @click="deleteQuestion({ lesson_id, question_index }); $event.stopPropagation()" class="button is-danger is-small"><b-icon pack="fa" icon="trash" size="is-small"></b-icon></button>
                <b-icon :icon="isOpen ?
                    'menu-down' : 'menu-up'">
                </b-icon>
            </a>
        </div>
        <div class="card-content">
            <div class="content">
                <b-field label="Întrebare">
                    <b-input
                            v-model="content"
                            placeholder="Care este cel mai rapid animal din lume ?"
                            maxlength="120"
                            minlength="10"
                            required
                    ></b-input>
                </b-field>
                <answers :lesson_id="lesson_id" :question_index="question_index"></answers>
            </div>
        </div>
    </b-collapse>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex';
    import Answers from './Answers.vue';

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
            question() {
                return this.questionByIndex(this.lesson_id, this.question_index);
            },
            content: {
                get() {
                    return this.question.content;
                },
                set(value) {
                    const { lesson_id, question_index } = this;
                    this.$store.dispatch('updateQuestion', {
                        lesson_id,
                        question_index,
                        data: { content: value },
                    });
                },
            },
        },
        data() {
            return {
                isOpen: false,
            };
        },
        methods: {
            ...mapActions(['deleteQuestion']),
        },
        components: {
            Answers,
        },
    };
</script>