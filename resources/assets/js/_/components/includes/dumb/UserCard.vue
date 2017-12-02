<template>
    <div class="card user-card">
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <image-container class="profileImage" :image="user._image.filename"></image-container>
                </div>
                <div class="media-content">
                    <p class="title is-4">{{user.first_name}} {{user.last_name}}</p>
                    <p class="subtitle is-6">{{user.username}}</p>
                </div>
            </div>
            <div class="content">
                {{user.description}}

            </div>

        </div>
        <footer class="card-footer">
            <div class="card-footer-item">
                <small>S-a alăturat cu {{joined}}</small>
            </div>
        </footer>
    </div>
</template>
<script>
    import ImageContainer from './ImageContainer.vue';
    import moment from 'moment';
    export default {
        props: {
            user: {
                type: Object,
            },
        },
        computed: {
            joined() {
                return moment(this.user.created_at).fromNow();
            },
        },
        components: {
            ImageContainer,
        },
    };
</script>
<style>
    .user-card .profileImage{
        width: 42px;
        height: 42px;
    }
</style>