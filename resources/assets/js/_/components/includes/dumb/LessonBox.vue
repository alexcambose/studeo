<template>
    <div class="card lesson-card">
        <div class="card">
            <div class="card-content">
                <div class="lesson-box">
                    <image-container class="lesson-image" :image="lesson._thumbnail.filename"></image-container>
                    <div class="lesson-info">
                        <div class="lesson-title">{{lesson.title}}</div>
                    </div>
                    <div v-if="lesson._questions.length" class="lesson-meta">
                        <b-tag type="is-dark">{{lesson._questions.length}} întrebări</b-tag>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ImageContainer from './ImageContainer.vue';
    export default {
        props: {
            lesson: {
                type: Object,
                required: true,
            },
        },
        components: {
            ImageContainer,
        },
    };
</script>

<style>
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