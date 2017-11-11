<template>
    <span :class="['button', size]" :disabled="loading">
        <span :class="['icon' ,size]">
            <i :class="['fa','fa-refresh',(loading ? 'fa-spin' : '')]"></i>
        </span>
    </span>
</template>

<script>
    export default {
        props: ['loading', 'size'],
    }
</script>