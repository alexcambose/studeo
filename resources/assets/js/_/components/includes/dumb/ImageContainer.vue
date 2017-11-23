<template>
    <div v-bind="$attrs" :style="{'background-image': `url(${(notFromServer ? '' : config.url.SERVER)+ image})`, 'background-position': 'center', 'background-size': 'cover'}" ></div>
</template>
<script>
    import config from '../../../../config';

    export default {
        props: ['image', 'notFromServer'],
        data() {
            return { config };
        },
    };
</script>