<template>
    <div>
        {{lesson.title}}
    </div>
</template>

<script>
export default {
    computed: {
        lesson() {
            return this.$store.getters.getNewLessonById(this.$route.params.id);
        },
    },
};
</script>