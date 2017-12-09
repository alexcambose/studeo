<template>
    <div>
        <a v-for="(lesson, index) in lessons" @click="selectLesson(index)" :key="index">
            <lesson-box :lesson="lesson" :show-question-number="false" :active="index === currentLessonIndex" :watched="lesson._watched"></lesson-box>
        </a>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex';
    import { pluralize } from '../../../../../../utils';
    import LessonBox from '../../../../../components/includes/dumb/LessonBox.vue';

    export default {
        computed: {
            ...mapGetters(['lessons']),
            ...mapState({
                currentLessonIndex: ({ course }) => course.currentLessonIndex,
            }),
        },
        methods: {
            selectLesson (index) {
                const skippedLessons = Math.abs(this.currentLessonIndex - index);
                if (skippedLessons > 1) {
                    this.$toast.open({
                        message: `Nu poți sări ${pluralize(skippedLessons - 1, 'lecție', 'lecții')}`,
                        type: 'is-danger',
                    });
                } else this.$store.dispatch('selectLesson', index);
            },
        },
        components: {
            LessonBox,
        },
    };
</script>
