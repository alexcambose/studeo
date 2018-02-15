<template>
    <div>
        <div v-if="user.id === $store.state.user.user.id">
            <add-post v-model="posts"></add-post>
            <hr>
        </div>

        <post v-for="post in posts" :post="post" :user="user" :key="post.id"></post>
        <infinite-loading @triggered="infiniteHandler">
            <slot slot="fetching">Se accesează postările</slot>
            <slot slot="completed">Nu mai sunt postări</slot>
        </infinite-loading>
    </div>
</template>

<script>
    import AddPost from './AddPost.vue';
    import Post from './Post.vue';
    import config from '../../../../../../config';
    import InfiniteLoading from '../../../../includes/dumb/InfiniteLoading';

    export default {
        props: {
            user: Object,
        },
        data() {
            return {
                start: 0,
                posts: [],
            };
        },
        methods: {
            infiniteHandler($state) {
                axios.get(config.url.POST_ALL + this.$route.params.username, { params: {
                    start: this.start,
                    amount: config.profile.postsLoadAmount,
                } })
                    .then(({ data }) => {
                        if (data.post.length) {
                            this.start += config.profile.postsLoadAmount;
                            this.posts = [...this.posts, ...data.post];
                            $state.fetched();
                        } else {
                            $state.completed();
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