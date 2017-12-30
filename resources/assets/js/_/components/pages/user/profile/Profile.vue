<template>
    <div v-if="userLoaded" class="profile-page">
        <div class="header">
            <div class="banner" :style="{backgroundColor: user.cover_color}"></div>
            <nav class="navbar profile-nav">
                <div class="container">
                    <image-container class="profile-image" :src="user._image.filename">
                        <image-container class="profile-avatar-image" src="https://lh3.googleusercontent.com/QdPWD0J-qsqJ64d2GtZEHPk4BnO0ryDQlnA6P0UGiB1zpfdAhC3PKetkzjDmy6NVRXGpenuU5kTFF7AKMgumiWU=s400"></image-container>
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

        <div class="container user-data-container">
            <div class="columns">
                <div class="column is-3">
                    <user-info :user="user"></user-info>
                    <activity :user="user"></activity>
                </div>
                <div class="column is-6">
                    <router-view :user="user"></router-view>
                </div>
                <div class="column is-3">
                    <achievements :user="user"></achievements>
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
    import { xp, level } from '../../../../../utils';
    import config from '../../../../../config';
    import UserInfo from './sidebars/UserInfo.vue';
    import Activity from './sidebars/Activity.vue';

    export default {
        mounted() {
            this.getUser();
        },
        data() {
            return {
                user: {},
                achievements: [],
                userLoaded: false,
            };
        },
        watch: {
            '$route.params'() {
                this.getUser();
            },
        },
        computed: {
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
                        this.user = data.user;
                        this.userLoaded = true;
                    });
            },
        },
        components: {
            UserInfo,
            Activity,
            Course,
            Achievements,
            LevelBox,
            ImageContainer,
        },
    };
</script>