<template>
    <div class="profilPage">
        <div class="banner" :style="{backgroundColor: bannerColor}"></div>
        <div class="profileNav">
            <navbar-profile></navbar-profile>
            <div class="container">
                <div class="profileImage" style="background: url('http://3.bp.blogspot.com/_d70o0QbCQYg/ShA41KQQn1I/AAAAAAAABf8/-tffws7CMjc/s400/Internet_man+slave+of+computer+3.bmp')"></div>
                <div class="avatarImage"></div>
            </div>
        </div>
        <div class="mainUser container">
            <div class="columns">
                <div class="column is-one-quarter">
                    <div class="userDetails">
                        <h3 class="fullname">{{ this.fullname }}</h3>
                        <router-link :to="{ name: 'profile', params: {username: user.username}}">&nbsp; @{{ user.username }}</router-link>
                        <div class="shortDescription">
                            &nbsp; {{ user.description }}
                        </div>
                        <div class="oras" v-if="user.city">
                            <i class="fa fa-building fa-lg"></i>
                            {{ user.city }}
                        </div>
                        <div class="dataNastere" v-if="user.birthday">
                            <p>
                                <i class="fa fa-birthday-cake fa-lg"></i>
                            Născut la {{ displayDate(user.birthday) }}
                            </p>
                        </div>
                        <div class="scoala">
                            <i class="fa fa-graduation-cap fa-lg"></i>
                            {{ user.school }}
                        </div>
                        <div class="dataAlaturare">
                            <i class="fa fa-calendar-check-o fa-lg"></i>
                            S-a alăturat în {{ displayDate(user.created_at) }}
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
    import Curs from '../../includes/dumb/Curs.vue'
    import Item from '../../includes/dumb/Item.vue'
    import NavbarProfile from '../../includes/ProfileNavbar.vue'
    import { mapState, mapActions, mapGetters } from 'vuex'
    export default {
        components: {
            'curs': Curs,
            'item': Item,
            'navbar-profile': NavbarProfile,
        },
        computed: {
            ...mapState({
                bannerColor: state => state.user.user.cover_color,
                user: state => state.user.user,
            }),

            ...mapGetters([
               'fullname',
            ]),

        },
        methods: {
            displayDate: function(e) {
                return e.slice(0, 10);
            }
        },
    }
</script>