<template>
    <div class="buttons has-addons">
        <span @click="lessonOrderUp(lesson_id)" :disabled="isFirst" class="button is-small">
            <b-icon pack="fa" icon="angle-up"></b-icon>
        </span>
        <span @click="lessonOrderDown(lesson_id)" :disabled="isLast" class="button is-small">
            <b-icon pack="fa" icon="angle-down"></b-icon>
        </span>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
        props: ['lesson_id'],
        computed: {
            ...mapGetters(['newLessons', 'newLessonById']),
            isFirst() {
                return (this.newLessonById(this.lesson_id).order_index === 0);
            },
            isLast() {
                return (this.newLessonById(this.lesson_id).order_index === this.newLessons.length -1);
            },
        },
        methods: {
            ...mapActions(['lessonOrderUp', 'lessonOrderDown']),
        },
    };
</script>