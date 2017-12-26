<template>
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
        <div class="is-pulled-right">
            <button @click="$emit('canceled')" v-if="editMode" class="button">Anulează</button>
            <button @click="editMode ? updatePost() : addPost()" :class="['button', 'is-link', newPost.fetching ? 'is-loading' : '']" :disabled="!newPost.content.trim().length">{{editMode ? 'Actualizează' : 'Postează'}}</button>
        </div>
    </div>
</template>

<script>
    import MarkdownTextarea from '../../../../includes/dumb/MarkdownTextarea.vue';
    import config from '../../../../../../config';
    export default {
        props: {
            value: {}, // all posts data, or, if edit model post object
            editMode: Boolean,
            changed: Function,
            canceled: Function,
        },
        mounted() {
            if (this.editMode) {
                this.newPost = this.value;
                this.newPost.isPrivate = [this.value.is_private ? '1' : '0'];
            }
        },
        watch: {
            value(value) {
                if (this.editMode) {
                    this.newPost = value;
                    this.newPost.isPrivate = [this.value.is_private ? '1' : '0'];
                } else {
                    this.posts = value;
                }
            },
        },
        data() {
            return {
                newPost: {
                    isPrivate: [], // boolean inside
                    content: '',
                    fetching: false,
                    id: null, // only for update mode
                },
                posts: [],
            };
        },
        methods: {
            addPost() {
                this.newPost.fetching = true;
                axios.post(config.url.POST_ADD, { content: this.newPost.content, isPrivate: !!this.newPost.isPrivate[0] })
                    .then(({ data }) => {
                        this.newPost.fetching = false;
                        this.newPost.content = '';
                        this.newPost.isPrivate = [];
                        this.posts.unshift(data.post);
                        this.$emit('input', this.posts);
                        this.$toast.open({ message: 'Postarea a fost adăugată!', type: 'is-success' });
                    })
                    .catch(() => {
                        this.newPost.fetching = false;
                        this.$toast.open({ message: 'Eroare!', type: 'is-danger' });
                    });
            },
            updatePost() {
                this.newPost.fetching = true;
                axios.put(config.url.POST_UPDATE + this.newPost.id, { content: this.newPost.content, isPrivate: !!this.newPost.isPrivate[0] })
                    .then(({ data }) => {
                        this.newPost.fetching = false;
                        this.newPost.content = '';
                        this.newPost.isPrivate = [];
                        this.$emit('changed', data.post);
                        this.$toast.open({ message: 'Postarea a fost actualizată!', type: 'is-success' });
                    })
                    .catch(() => {
                        this.newPost.fetching = false;
                        this.$toast.open({ message: 'Eroare!', type: 'is-danger' });
                    });
            },
            deletePost() {

            },
        },
        components: {
            MarkdownTextarea,
        },
    };
</script>