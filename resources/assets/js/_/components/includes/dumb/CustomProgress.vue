<template>
    <div class="progress-custom">
        <div class="progress-bar" :style="{width: percentage, backgroundColor: color}"></div>
    </div>

</template>

<script>
    export default {
        props: ['color', 'percentage'],
    }
</script>

<style>
    .progress-custom {
        -moz-appearance: none;
        -webkit-appearance: none;
        border: none;
        border-radius: 290486px;
        display: block;
        height: 1rem;
        overflow: hidden;
        padding: 0;
        width: 100%;
        background-color: whitesmoke;
    }

    .progress-bar {
        height: 20px;
    }
</style>