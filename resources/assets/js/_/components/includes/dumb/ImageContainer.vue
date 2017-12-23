<template>
    <div v-bind="$attrs" :style="{
        'background-image': `url(${url})`,
        'background-position': 'center',
        'background-size': 'cover',
        position: 'relative',
    }" >
        <slot></slot>
    </div>
</template>
<script>
    import config from '../../../../config';

    export default {
        props: {
            src: {
                type: String,
                required: true,
            },
            notFromServer: {
                type: Boolean,
                required: false,
            },
        },
        computed: {
            url() {
                return (this.notFromServer ? '' : config.url.SERVER) + this.src;
            },
        },
    };
</script>