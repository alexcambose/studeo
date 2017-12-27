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
                        <router-link :to="{name:'profile-recommended'}" class="navbar-item is-tab">Recomandate</router-link>
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
                    <h3 class="fullname">{{ fullname }}</h3>
                    <router-link :to="{ name: 'profile', params: {username: user.username}}" class="username-link"> @{{ user.username }}</router-link>
                    <hr>
                    <div class="description" v-if="description" v-html="description"></div>

                    <div v-for="item in userInfo" class="user-info-item">
                        <div>
                            <i :class="item.icon"></i>
                            {{ item.content }}
                        </div>
                    </div>
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
    import Achievements from './sidebar/Achievements.vue';
    import { cities, xp, level, displayDate } from '../../../../../utils';
    import { markdown } from 'markdown';
    import moment from 'moment';
    import config from '../../../../../config';
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
            fullname() {
                return this.user.first_name + ' ' + this.user.last_name;
            },
            description() {
                return markdown.toHTML(this.user.description);
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
            userInfo() {
                const { city, birthday, school, created_at } = this.user;
                return [
                    { 'name': 'city', 'icon': 'fa fa-building fa-lg', 'content': cities[city] },
                    { 'name': 'birthday', 'icon': 'fa fa-birthday-cake fa-lg', 'content': `Născut la ${displayDate(birthday)}` },
                    { 'name': 'school', 'icon': 'fa fa-graduation-cap fa-lg', 'content': school },
                    { 'name': 'created_at', 'icon': 'fa fa-calendar-check-o fa-lg', 'content': ` S-a alăturat cu ${moment(created_at).fromNow()}` },
                ];
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
            Course,
            Achievements,
            LevelBox,
            ImageContainer,
        },
    };
</script>