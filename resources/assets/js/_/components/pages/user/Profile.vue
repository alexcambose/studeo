<template>
    <div class="profilPage">
        <div class="banner" :style="{backgroundColor: user.cover_color}"></div>
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

                        <div v-for="item in userInfo" class="userInfo">
                            <div>
                                <i :class="item.icon"></i>
                                {{ item.content }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <course></course>
                    <course></course>
                    <course></course>
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
    import Course from '../../includes/dumb/Course.vue';
    import Item from '../../includes/dumb/Item.vue';
    import ImageContainer from '../../includes/dumb/ImageContainer.vue';
    import NavbarProfile from '../../includes/NavbarProfile.vue';
    import { mapState, mapGetters } from 'vuex';
    import { cities } from '../../../../utils';

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
                    { 'name': 'city', 'icon': 'fa fa-building fa-lg', 'content': cities[city] },
                    { 'name': 'birthday', 'icon': 'fa fa-birthday-cake fa-lg', 'content': `Născut la ${this.displayDate(birthday)}`},
                    { 'name': 'school', 'icon': 'fa fa-graduation-cap fa-lg', 'content': school },
                    { 'name': 'created_at', 'icon': 'fa fa-calendar-check-o fa-lg', 'content': ` S-a alăturat în ${this.displayDate(created_at)}` },
                ];
            },
        },
        methods: {
            displayDate: function(e) {
                const monthNames = ['Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie','Octombrie', 'Noiembrie', 'Decembrie'];
                let date = new Date(e);
                return date.getDay() + ' ' +  monthNames[date.getMonth()] + ' ' +  date.getFullYear();
            },
        },
        components: {
            Course,
            Item,
            NavbarProfile,
            ImageContainer,
        },
    };
</script>