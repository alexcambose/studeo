<template>
    <div :class="['achievement-box', highlighted ? 'highlighted' : '']">
        <image-container :src="achievement._image._filename" class="achievement-image"></image-container>
        <div class="achievement-description">{{achievement.description}}</div>
        <div v-if="achievement.pivot" class="achievement-date">{{moment(achievement.pivot.created_at).fromNow()}}</div>
    </div>
</template>

<script>
    import moment from 'moment';

    import ImageContainer from './ImageContainer.vue';
    export default {
        props: {
            achievement: {
                type: Object,
                required: true,
            },
            highlighted: {
                type: Boolean,
                requried: false,
            },
        },
        methods: {
            moment,
        },
        components: {
            ImageContainer,
        },
    };
</script>


<style scoped>
    .achievement-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 120px;
        padding: 6px;
        transition: all .1s;
    }
    .achievement-box:hover{
        background-color: rgba(0,0,0,.02);
    }
    .achievement-box.highlighted .achievement-image{
        box-shadow: 0 0 10px #00ce00;
    }
    .achievement-image{
        height: 50px;
        width: 50px;
        border-radius: 100%;
    }
    .achievement-description {
        margin-top: 2px;
        font-size: .9rem;
        flex: 1;
        text-align: center;
    }
    .achievement-date {
        margin-top: 2px;
        padding-top: 2px;
        border-top: 1px solid #ededed;
        color: #a7a7a7;
        font-size: .7rem;
        text-align: center;
    }
</style>
