<template>
    <router-link :to="{name: 'profile',  params: { username: user.username }}">
        <div class="user-box">
                <image-container class="user-image" :image="user._image.filename"></image-container>
                <div class="user-info">
                    <div class="user-name">{{user.first_name}} {{user.last_name}}</div>
                </div>
        </div>
    </router-link>
</template>
<script>
    import ImageContainer from './ImageContainer.vue';

    export default {
        props: {
            user: {
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
    .user-box{
        display: flex;
    }
    .user-box .user-image{
        height: 36px;
        width: 36px;
        border-radius: 100%;
    }
    .user-box .user-info{
        display: flex;
        flex:1;
        align-items: center;
    }
    .user-box .user-info .user-name{
        margin-left: 10px;
    }
</style>