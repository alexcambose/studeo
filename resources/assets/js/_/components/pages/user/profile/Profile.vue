<template>
    <div v-if="userLoaded" class="profile-page">
        <div class="header">
            <div class="banner" :style="{backgroundColor: user.cover_color}"></div>
            <nav class="navbar profile-nav">
                <div class="container">
                    <image-container class="profile-image" :src="user._image.filename">
                        <image-container
                                @click.native="user.id === loggedUser.id ? isAvatarModalActive = true : null"
                                :class="['profile-avatar-image', user.id === loggedUser.id ? 'cp' :'']"
                                :src="user._avatar._image._filename"
                        >
                        </image-container>
                    </image-container>
                    <div class="navbar-start">
                        <router-link :to="{name:'profile-posts'}" class="navbar-item is-tab">Postări</router-link>
                        <router-link :to="{name:'profile-recommended'}" class="navbar-item is-tab">Recomandate
                        </router-link>
                    </div>
                    <div class="navbar-end">
                        <div class="navbar-item progress-container">
                            <span class="status">{{userXp}} / {{levelXp}} xp</span>
                            <b-tooltip :label="`${levelXp-userXp}xp până la următorul nivel`" class="flex-center">
                                <progress class="progress is-dark" :value="userXp" :max="levelXp"></progress>
                            </b-tooltip>
                            <level-box :level="level"></level-box>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
        <b-modal :active.sync="isAvatarModalActive">
            <avatars :user="user"></avatars>
        </b-modal>
        <div class="container user-data-container">
            <div class="columns">
                <div class="column is-3">
                    <user-info :user="user"></user-info>
                    <activity v-if="user.id === loggedUser.id" :user="user"></activity>
                </div>
                <div class="column is-6">
                    <router-view :user="user"></router-view>
                </div>
                <div class="column is-3">
                    <achievements :user="user"></achievements>
                    <items :user="user"></items>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Course from '../../../includes/dumb/Course.vue';
    import ImageContainer from '../../../includes/dumb/ImageContainer.vue';
    import LevelBox from '../../../includes/dumb/LevelBox.vue';
    import Achievements from './sidebars/Achievements.vue';
    import Items from './sidebars/Items.vue';
    import { xp, level } from '../../../../../utils';
    import config from '../../../../../config';
    import UserInfo from './sidebars/UserInfo.vue';
    import Activity from './sidebars/Activity.vue';
    import Avatars from './avatars/Avatars.vue';
    import { mapState } from 'vuex';

    export default {
        mounted() {
            this.getUser();
        },
        data() {
            return {
                currentUser: {},
                achievements: [],
                userLoaded: false,
                isAvatarModalActive: false,
            };
        },
        watch: {
            '$route.params'() {
                this.getUser();
            },
        },
        computed: {
            ...mapState({
                loggedUser: ({ user }) => user.user,
            }),
            user() {
                if (this.currentUser.id === this.loggedUser.id) return this.loggedUser;
                return this.currentUser;
            },
            levelXp() {
                return xp(this.level) - xp(this.level - 1);
            },
            userXp() {
                if (this.level > 1) return this.user.xp - xp(this.level - 1);
                return this.user.xp;
            },
            level() {
                return level(this.user.xp);
            },
        },
        methods: {
            getUser() {
                this.userLoaded = false;
                axios.get(config.url.USER_BY_USERNAME + this.$route.params.username)
                    .then(({ data }) => {
                        this.currentUser = data.user;
                        this.userLoaded = true;
                    });
            },
        },
        components: {
            Avatars,
            UserInfo,
            Items,
            Activity,
            Course,
            Achievements,
            LevelBox,
            ImageContainer,
        },
    };
</script>