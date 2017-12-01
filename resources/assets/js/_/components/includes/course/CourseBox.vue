<template>
    <div>
        <pre>
            {{course}}
        </pre>
        <hr>
    </div>
</template>
<script>
    export default {
        props: {
            course: {
                type: Object,
                required: true,
            },
        },
    };
</script>