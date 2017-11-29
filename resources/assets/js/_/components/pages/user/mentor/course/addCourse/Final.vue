<template>
    <div>
        <span class="is-size-2">Finalizare curs</span>
        <hr>
        <b-notification type="is-danger" v-if="errors.length">
            <ul>
                <li v-for="error in errors" v-html="error"></li>
            </ul>
        </b-notification>
        <div>

        </div>
        <div class="has-text-centered">
            <button @click="sendCourse" class="button is-large is-success" v-if="!errors.length">Trimite</button>
            <span v-else>Te rugăm să rezolvi erorile</span>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            const course = this.course;
            if (!course.title.trim() || !course.shortDescription.trim() || !course.description.trim()) {
                this.errors.push('Titlul, descrierea scurtă sau descrierea completă nu sunt valide');
            }
            if (!course.purpose.trim()) this.errors.push('Scopul cursului nu poate fi gol');
            course.lessons.forEach(lesson => {
                if (!lesson.title.trim() || !lesson.content.trim() || !lesson.shortDescription.trim()) {
                    this.errors.push(`Toate campurile din <b>${lesson.title.trim() || `lecția a ${lesson.order_index}-a`}</b> sunt obligatorii`);
                }
            });
        },
        computed: {
            course() {
                return this.$store.state.newCourse;
            },
        },
        data() {
            return {
                errors: [],
            };
        },
        methods: {
            sendCourse() {
                this.$store.dispatch('courseAdd');
            },
        },
    };
</script>