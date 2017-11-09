<template>
    <div>
        <div class="notification is-success" v-if="success">
            {{success}}
        </div>
        <div class="notification is-danger" v-if="error">
            {{error}}
        </div>
        <button type="submit" :class="['button','is-primary','is-fullwidth',(fetching ? 'is-loading' : '')]"><slot/></button>
    </div>
</template>

<script>
    export default {
        props: ['error', 'success', 'fetching']
    }
</script>