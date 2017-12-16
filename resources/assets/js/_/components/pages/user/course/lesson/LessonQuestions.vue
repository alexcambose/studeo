<template>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Întrebări finale<span v-if="startedQuiz && !finishedQuiz" class="has-text-weight-light has-text-grey is-size-6 has-text-centered ml-10">{{questions.length - questionIndex}} din {{questions.length}} rămase</span></p>
            <div v-if="startedQuiz" class="is-pulled-right">
                <div v-if="!finishedQuiz">
                    <b-tag v-if="answers.filter(e => e.is_true).length === 1" type="is-info">Un singur răspuns</b-tag>
                    <b-tag v-else type="is-info">Răspunsuri multiple</b-tag>
                </div>
            </div>
        </header>
        <section class="modal-card-body">
            <div v-if="!startedQuiz && !finishedQuiz">
                <b-message>
                    Pentru a trece la următoarea lecție trebuie să răspunzi la {{questions.length}} întrebări.
                </b-message>
            </div>
            <div v-else-if="!finishedQuiz">
                <div class="title is-5">{{question.content}}</div>
                <div  v-for="(answer, index) in answers" :key="index" class="field">
                    <b-checkbox v-model="currentAnswer" :native-value="answer.id">
                    {{answer.is_true}} | {{answer.content}}
                    </b-checkbox>
                </div>
            </div>
            <div v-else>
                <b-message v-if="correctAnswersCount === questions.length" type="is-success" has-icon>
                    <div class="title is-4">Ai răspuns corect la toate întrebările!</div>
                    Bravo! <button @click="onSuccess ? onSuccess() : null" class="button is-success is-small">Următoarea lecție</button>
                </b-message>
                <b-message v-else type="is-danger" has-icon>
                    <div class="title is-4">Ai răspuns la {{correctAnswersCount}} din {{questions.length}} întrebări corect.</div>
                    Pentru a trece la următoarea lecție trebuie sa raspunzi la toate cele {{questions.length}} întrebări corect. Ne pare rău dar trebuie sa urmărești din nou lecția.
                </b-message>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button class="button" type="button" @click="$parent.close()">Close</button>
            <button v-if="!startedQuiz" @click="questionIndex = 0" class="button is-primary">Continuă</button>
            <div v-else class="field has-addons">
                <p v-if="!finishedQuiz" class="control">
                    <button @click="previousQuestion" :disabled="questionIndex === 0" class="button is-info">
                        <b-icon pack="fa" icon="angle-double-left"></b-icon> &nbsp; Înapoi
                    </button>
                </p>
                <p class="control">
                    <button v-if="startedQuiz && questionIndex < this.questions.length-1" @click="nextQuestion" :disabled="!currentAnswer.length || questionIndex === this.questions.length-1" class="button is-info">
                        Înainte &nbsp; <b-icon pack="fa" icon="angle-double-right"></b-icon>
                    </button>
                    <button v-else-if="!finishedQuiz" @click="finishQuiz" class="button is-success">Finalizează &nbsp; <b-icon pack="fa" icon="check" size="is-small"></b-icon></button>
                </p>
            </div>
        </footer>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        props: {
            onSuccess: {
                type: Function,
            },
        },
        computed: {
            ...mapGetters(['lessons']),
            questions() {
                const currentLessonIndex = this.$store.state.course.currentLessonIndex;
                return this.lessons[currentLessonIndex]._questions;
            },
            question() {
                return this.questions[this.questionIndex];
            },
            answers() {
                return this.question._answers;
            },
            startedQuiz() {
                return this.questionIndex >= 0;
            },
        },
        data() {
            return {
                finishedQuiz: false,
                questionIndex: -1,
                currentAnswer: [],
                allAnswers: {},
                correctAnswersCount: 0,
            };
        },
        methods: {
            finishQuiz() {
                if (this.checkAnswer()) this.correctAnswersCount++;
                this.finishedQuiz = true;
                this.allAnswers[this.questionIndex] = this.currentAnswer;
            },
            nextQuestion() {
                if (this.checkAnswer()) this.correctAnswersCount++;
                this.allAnswers[this.questionIndex] = this.currentAnswer;
                this.questionIndex++;
                this.currentAnswer = this.allAnswers[this.questionIndex] || [];
            },
            previousQuestion() {
                this.allAnswers[this.questionIndex] = this.currentAnswer;
                this.questionIndex--;
                this.currentAnswer = this.allAnswers[this.questionIndex] || [];
            },
            checkAnswer() {
                const correctAnswers = this.question._answers.filter(e => e.is_true);
                if (this.currentAnswer.length !== correctAnswers.length) return false;
                for (let answer of this.currentAnswer) {
                    if (correctAnswers.filter(e => e.id === answer).length === 0) return false;
                }
                return true;
            },
        },
    };
</script>