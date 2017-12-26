<template>
    <div>
        <add-post v-model="posts"></add-post>
        <hr>
        <post v-for="post in posts" :post="post" :user="user" :key="post.id"></post>
        <infinite-loading @infinite="infiniteHandler">
            <slot slot="no-results">Nu sunt postări</slot>
            <slot slot="no-more">Nu mai sunt postări</slot>
        </infinite-loading>
    </div>
</template>

<script>
    import AddPost from './AddPost.vue';
    import Post from './Post.vue';
    import config from '../../../../../../config';
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        props: {
            user: Object,
        },
        data() {
            return {
                start: 0,
                end: config.profile.postsLoadAmount,
                posts: [],
            };
        },
        methods: {
            infiniteHandler($state) {
                axios.get(config.url.POST_ALL + this.$route.params.username, { params: {
                    start: this.start,
                    end: this.end,
                } })
                    .then(({ data }) => {
                        if (data.post.length) {
                            this.start += config.profile.postsLoadAmount;
                            this.end += config.profile.postsLoadAmount;
                            this.posts = [...this.posts, ...data.post];
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    });
            },
        },
        components: {
            AddPost,
            Post,
            InfiniteLoading,
        },
    };
</script>