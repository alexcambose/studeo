<template>
    <div>
        <div class="box is-clearfix">
            <b-field>
                <markdown-textarea
                        placeholder="Scrie ceva..."
                        maxlength="2000"
                        v-model="newPost.content"
                ></markdown-textarea>
            </b-field>
            <b-checkbox-button v-model="newPost.isPrivate" native-value="1" type="is-danger" class="is-pulled-left">
                <b-icon pack="fa" icon="user-times" size="is-small"></b-icon>
                <span>Privat</span>
            </b-checkbox-button>
            <button @click="addPost" :class="['button', 'is-link', 'is-pulled-right', newPost.fetching ? 'is-loading' : '']" :disabled="!newPost.content.trim().length">Postează</button>
        </div>
        <hr>
        <div v-for="(post, index) in posts" class="box post-box">
            <div class="content" v-html="markdownHtml(post.content)"></div>
            <div class="meta">
                <span class="is-private"><b-icon v-if="post.is_private" pack="fa" icon="lock" class=""></b-icon></span>
                <span class="date" :title="post.created_at">
                    {{moment(post.created_at).fromNow()}}
                </span>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler">
            <slot slot="no-results">Nu sunt postări</slot>
            <slot slot="no-more">Nu mai sunt postări</slot>
        </infinite-loading>
    </div>

</template>

<script>
    import MarkdownTextarea from '../../../includes/dumb/MarkdownTextarea';
    import config from '../../../../../config';
    import InfiniteLoading from 'vue-infinite-loading';
    import moment from 'moment';
    import { markdown } from 'markdown';
    export default {
        data() { console.log(this);
            return {
                newPost: {
                    isPrivate: [], // boolean inside
                    content: '',
                    fetching: false,
                },
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
            addPost() {
                this.newPost.fetching = true;
                axios.post(config.url.POST_ADD, { content: this.newPost.content, isPrivate: !!this.newPost.isPrivate[0] })
                    .then(({ data }) => {
                        this.newPost.fetching = false;
                        this.newPost.content = '';
                        this.newPost.isPrivate = [];
                        this.posts.unshift(data.post);
                        this.$toast.open({ message: 'Postarea a fost adăugată!', type: 'is-success' });
                    })
                    .catch(() => {
                        this.newPost.fetching = false;
                        this.$toast.open({ message: 'Eroare!', type: 'is-danger' });
                    });
            },
            moment,
            markdownHtml(content) {
                return markdown.toHTML(content);
            },
        },
        components: {
            MarkdownTextarea,
            InfiniteLoading,
        },
    };
</script>