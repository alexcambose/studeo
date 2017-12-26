<template>
    <span :class="['button', size]" :disabled="fetching">
        <span :class="['icon' ,size]">
            <i :class="['fa','fa-refresh',(fetching ? 'fa-spin' : '')]"></i>
        </span>
    </span>
</template>

<script>
    export default {
        props: ['fetching', 'size'],
    };
</script>