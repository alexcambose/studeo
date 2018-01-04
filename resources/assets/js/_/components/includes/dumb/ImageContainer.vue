<template>
    <div v-bind="$attrs" :style="{
        backgroundImage: `url(${url})`,
        backgroundPosition: 'center',
        backgroundSize: 'cover',
        position: 'relative',
        boxShadow: '0 0 3px 1px ' + colorLevel,
    }" >
        <slot></slot>
    </div>
</template>
<script>
    import config from '../../../../config';
    import { levelColor } from '../../../../utils';

    export default {
        props: {
            src: {
                type: String,
                required: true,
            },
            level: {
                type: Number,
                required: false,
            },
        },
        computed: {
            colorLevel() {
                if (!this.level) return false;
                return levelColor(this.level);
            },
            url() {
                if (this.src.indexOf('http') !== -1) return this.src;
                return config.url.SERVER + this.src;
            },
        },
    };
</script>