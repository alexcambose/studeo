<template>
    <div>
        <div class="notification is-success" v-if="success">
            {{success}}
        </div>
        <div class="notification is-danger" v-if="error">
            {{error}}
        </div>
        <button v-if="!success" type="submit" :class="['button','is-primary',fullwidth ? 'is-fullwidth' : '', (fetching ? 'is-loading' : '')]"><slot/></button>
    </div>
</template>

<script>
    export default {
        props: {
            error: String,
            success: String,
            fetching: Boolean,
            fullwidth: {
                type: Boolean,
                default: true,
            },
        },
    };
</script>