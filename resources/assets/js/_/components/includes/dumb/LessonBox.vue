<template>
    <div :class="['card', 'lesson-card', (active ? 'lesson-card-active' : '')]">
        <div class="card-content">
            <div class="lesson-box">
                <image-container class="lesson-image" :image="lesson._thumbnail.filename"></image-container>
                <div class="lesson-info">
                    <div class="lesson-title">{{lesson.title}}</div>
                </div>
                <div class="lesson-meta">
                    <b-tag v-if="lesson._questions.length && showQuestionNumber" type="is-dark">{{pluralize(lesson._questions.length, 'întrebare', 'întrebări')}}</b-tag>
                    <b-icon v-if="watched" pack="fa" icon="eye"></b-icon>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ImageContainer from './ImageContainer.vue';
    import { pluralize } from '../../../../utils';

    export default {
        props: {
            lesson: {
                type: Object,
                required: true,
            },
            showQuestionNumber: {
                type: Boolean,
                default: true,
            },
            active: {
                type: Boolean,
                default: false,
            },
            watched: {
                type: Boolean,
                default: false,
            },
        },
        methods: { pluralize },
        components: {
            ImageContainer,
        },
    };
</script>

<style>
    .lesson-card.lesson-card-active{
        background: #ececec;
    }
    .lesson-card .card-content{
        padding: 12px;
    }
    .lesson-card .lesson-box{
        display: flex;
    }
    .lesson-card .lesson-box .lesson-image{
        height: 40px;
        width: 40px;
        align-self: center;
    }
    .lesson-card .lesson-box .lesson-info{
        display: flex;
        flex:1;
        align-items: center;
    }
    .lesson-card .lesson-box .lesson-meta{
        display: flex;
        margin-right: 10px;
        align-items: center;
    }
    .lesson-card .lesson-box .lesson-info .lesson-title{
        margin-left: 10px;
    }

</style>