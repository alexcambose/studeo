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
        },
        computed: {
            url() {
                if (this.src.indexOf('http') !== -1) return this.src;
                return config.url.SERVER + this.src;
            },
        },
    };
</script>