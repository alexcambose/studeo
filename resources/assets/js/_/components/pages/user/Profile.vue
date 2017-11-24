<template>
    <div class="profilPage">
        <div class="banner" :style="{backgroundColor: bannerColor}"></div>
        <div class="profileNav">
            <navbar-profile></navbar-profile>
            <div class="container">
                <image-container class="profileImage" :image="user._image.filename"></image-container>
                <div class="avatarImage"></div>
            </div>
        </div>
        <div class="mainUser container">
            <div class="columns">
                <div class="column is-one-quarter">
                    <div class="userDetails">
                        <h3 class="fullname">{{ fullname }}</h3>
                        <router-link :to="{ name: 'profile', params: {username: user.username}}">&nbsp; @{{ user.username }}</router-link>

                        <div class="description" v-if="user.description">
                            &nbsp; {{ user.description }}
                        </div>

                        <div v-for="item in userInfo">
                            <div :class="item.name">
                                <i :class="item.icon"></i>
                                {{ item.content }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <curs></curs>
                    <curs></curs>
                    <curs></curs>
                </div>
                <div class="column is-one-quarter">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Recompense
                            </p>
                            <a href="#" class="card-header-icon">
                          <span class="icon">
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                          </span>
                            </a>
                        </header>
                        <div class="card-content">
                            <item></item>
                            <item></item>
                            <item></item>
                            <item></item>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import Curs from '../../includes/dumb/Curs.vue';
    import Item from '../../includes/dumb/Item.vue';
    import ImageContainer from '../../includes/dumb/ImageContainer.vue';
    import NavbarProfile from '../../includes/NavbarProfile.vue';
    import { mapState, mapGetters } from 'vuex';

    export default {
        computed: {
            ...mapState({
                user: state => state.user.user,
            }),
            ...mapGetters([
                'fullname',
            ]),
            userInfo() {
                const { city, birthday, school, created_at } = this.user;
                return [
                    { 'name': 'city', 'icon': 'fa fa-building fa-lg', 'content': city },
                    { 'name': 'birthday', 'icon': 'fa fa-birthday-cake fa-lg', 'content': `Născut la ${this.displayDate(birthday)}`},
                    { 'name': 'school', 'icon': 'fa fa-graduation-cap fa-lg', 'content': school },
                    { 'name': 'created_at', 'icon': 'fa fa-calendar-check-o fa-lg', 'content': ` S-a alăturat în ${created_at}` },
                ];
            },
        },
        methods: {
            displayDate: function(e) {
                return e.slice(0, 10);
            },
        },
        components: {
            Curs,
            Item,
            NavbarProfile,
            ImageContainer,
        },
    };
</script>