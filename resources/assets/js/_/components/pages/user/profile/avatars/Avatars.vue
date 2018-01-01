<template>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Caractere</p>
        </header>
        <section class="modal-card-body">

            <div v-if="selectedAvatarType" >
                <avatar-details :avatar="avatars.find(e => e.type === selectedAvatarType)" :user="user" @buy="handleBuy" @activate="handleActivate"></avatar-details>
            </div>
            <div v-else v-for="(avatarsGroup, index) in chunk(avatars, 3)" :key="index" class="columns">
            <div v-for="avatar in avatarsGroup" class="column is-4">
                <avatar :avatar="avatar" :user="user" @select="avatarSelected" @buy="handleBuy" @activate="handleActivate"></avatar>
            </div>
        </div>
        </section>
        <footer class="modal-card-foot">
            <button class="button" @click="$parent.close()">Închide</button>
            <button v-if="selectedAvatarType" class="button is-primary" @click="selectedAvatarType = null">Înapoi</button>
        </footer>
    </div>
</template>

<script>
    import _ from 'lodash';
    import config from '../../../../../../config';
    import Avatar from './Avatar.vue';
    import AvatarDetails from './AvatarDetails.vue';
    import { mapState } from 'vuex';
    export default {
        mounted() {
            this.getAvatars();
        },
        data() {
            return {
                avatars: [],
                selectedAvatarType: null,
            };
        },
        computed: {
            ...mapState({
                user: ({ user }) => user.user,
            }),
        },
        methods: {
            chunk: _.chunk,
            getAvatars() {
                axios.get(config.url.AVATAR_ALL)
                    .then(({ data }) => {
                        this.avatars = data.avatars;
                    });
            },
            avatarSelected(type) {
                this.selectedAvatarType = type;
            },
            handleBuy(avatarType) {
                this.$store.dispatch('buyAvatar', { avatarType })
                    .then(avatars => this.avatars = avatars);
            },
            handleActivate(avatarType) {
                this.$store.dispatch('activateAvatar', { avatarType });
            },
        },
        components: {
            AvatarDetails,
            Avatar,
        },
    };
</script>