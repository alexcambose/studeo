<template>
    <div v-if="deleted && !hideDeleted" class="deleted">
        Postare ștearsă
    </div>
    <div v-else-if="deleted && hideDeleted"></div>
    <div v-else-if="!editMode" :class="['box', 'post-box', thePost.is_private ? 'post-box-private' : '']">
        <div class="content" v-html="markdownHtml(thePost.content)"></div>
        <div class="meta">
            <div @click="toggleLike" class="meta-section like">
                <span>
                    <b-icon v-if="thePost._likes.includes(user.id)" pack="fa" icon="heart" class="like-active"></b-icon>
                    <b-icon v-else pack="fa" icon="heart-o"></b-icon>
                    {{thePost._likes.length}}
                </span>
            </div>
            <div class="meta-section">
                <div v-if="user.id === $store.state.user.user.id" class="field has-addons">
                    <p class="control">
                        <button @click="editMode = true" class="button is-link is-small">
                            <b-icon pack="fa" icon="pencil" size="is-small"></b-icon>
                        </button>
                    </p>
                    <p class="control">
                        <button @click="deletePost" class="button is-danger is-small">
                            <b-icon pack="fa" icon="trash" size="is-small"></b-icon>
                        </button>
                    </p>
                </div>
            </div>
            <div class="meta-section">
                <div :title="thePost.created_at" class="meta-date"> {{moment(thePost.created_at).fromNow()}} </div>
                <b-icon v-if="thePost.is_private" pack="fa" icon="lock"></b-icon>
                <b-icon v-if="thePost.created_at !== post.updated_at" :title="post.updated_at" pack="fa" icon="pencil"></b-icon>
            </div>
        </div>
    </div>
    <add-post v-else="!deleted" v-model="thePost" edit-mode @changed="data => { thePost = data; editMode = false }" @canceled="editMode = false"></add-post>

</template>

<script>
    import AddPost from './AddPost.vue';
    import moment from 'moment';
    import config from '../../../../../../config';
    import { markdown } from 'markdown';
    export default {
        props: {
            post: {
                type: Object,
                required: true,
            },
            user: {
                type: Object,
                required: true,
            },
        },
        data() {
            return {
                thePost: this.post,
                editMode: false,
                deleted: false,
                hideDeleted: false,
            };
        },
        methods: {
            deletePost() {
                this.$dialog.confirm({
                    title: 'Ștergere',
                    message: 'Ești sigur ca vrei sa ștergi acestă postare ?',
                    confirmText: 'Da',
                    cancelText: 'Nu',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        axios.delete(config.url.POST_DELETE + this.post.id)
                            .then(() => {
                                this.$toast.open({ message: 'Postarea a fost stearsă!', type: 'is-danger' });
                                this.deleted = true;
                                setTimeout(() => this.hideDeleted = true, 3000);
                            });
                    },
                });
            },
            toggleLike() {
                axios.post(config.url.POST_TOGGLE_LIKE(this.post.id))
                    .then(({ data }) => {
                        if (data.liked) {
                            this.thePost._likes.push(this.user.id);
                        } else {
                            this.thePost._likes.splice(this.thePost._likes.findIndex(e => e === this.user.id), 1);
                        }
                    });
            },
            moment,
            markdownHtml(content) {
                return markdown.toHTML(content);
            },
        },
        components: {
            AddPost,
        },
    };
</script>