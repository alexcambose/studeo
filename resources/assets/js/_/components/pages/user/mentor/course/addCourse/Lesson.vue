<template>
    <div>
        <pre>
{{lesson}}
        </pre>
    </div>
</template>

<script>
export default {
    computed: {
        lesson() {
            return this.$store.getters.newLessonById(this.$route.params.id);
        },
    },
};
</script>