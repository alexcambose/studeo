<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="container">

            <div class="navbar-start">
                <div class="navbar-brand">
                    <router-link class="navbar-item" to="/">
                        <img src="https://images-ext-2.discordapp.net/external/m924_7fhxcQssOwPe0kNHO76HXhPVaCrWnQcmDTdCiE/https/i.imgur.com/mH23GwLr.png?width=1025&height=257" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="60">
                    </router-link>

                    <button class="button navbar-burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="navbar-start" v-if="logged">
                    <!--<router-link to="/" class="navbar-item is-hoverable is-tab is-hidden-mobile">Acasa</router-link>-->
                    <router-link to="/quiz" class="navbar-item is-hoverable is-tab is-hidden-mobile">Quiz</router-link>

                    <div class="navbar-item is-hoverable has-dropdown">
                        <a class="navbar-link">
                            <b-icon icon="grid"></b-icon>
                        </a>

                        <div class="navbar-dropdown navbar-classes">
                            <catmenu></catmenu>
                        </div>
                    </div>
                    <!--navbar secundar -->
                    <b-field style="padding-top: 12px">
                        <b-input placeholder="Caută"
                                 type="search"
                                 icon-pack="fa"
                                 icon="search"
                        >
                        </b-input>
                    </b-field>
                </div>
            </div>
            <div class="navbar-end" v-if="!logged">
                <router-link to="login" class="navbar-item is-tab">Autentificare</router-link>
                <router-link to="register" class="navbar-item is-tab">Înregistrare</router-link>
            </div>
            <div class="navbar-end" v-else>
                <router-link v-if="isMentor" :to="{name: 'dashboard'}" class="navbar-item is-tab">
                    Cursurile mele
                </router-link>
                <div class="navbar-item is-hoverable has-dropdown">
                    <a class="navbar-link">
                        <b-icon icon="bell"></b-icon>
                        <span v-if="unreadNotificationsCount" class="tag is-rounded is-primary">{{unreadNotificationsCount}}</span>
                    </a>

                    <div class="navbar-dropdown navbar-notifications">
                        <notifmenu></notifmenu>
                    </div>
                </div>

                <div class="navbar-item is-hoverable has-dropdown">
                    <a href="#" class="navbar-link">Salut, {{user.first_name}}</a>
                    <div class="navbar-dropdown">
                        <router-link :to="{name: 'profile'}" class="navbar-item"><b-icon pack="fa" icon="user"></b-icon> Profil</router-link>
                        <router-link :to="{name: 'notifications'}" class="navbar-item"><b-icon pack="fa" icon="comment"></b-icon> Notificări</router-link>
                        <router-link :to="{name: 'settings'}" class="navbar-item"><b-icon pack="fa" icon="cog"></b-icon> Setări</router-link>

                        <router-link to="/admin" class="navbar-item"><b-icon pack="fa" icon="lock"></b-icon> Panou admin</router-link>

                        <hr class="navbar-divider">

                        <router-link :to="{name: 'help'}" class="navbar-item"><b-icon pack="fa" icon="question-circle"></b-icon> Ajutor</router-link>

                        <hr class="navbar-divider">

                        <a class="navbar-item" @click="logout">
                            <b-icon pack="fa" icon="sign-out"></b-icon> Deconectare
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
    import CatMenu from './navbar/CatMenu';
    import NotifMenu from './navbar/NotifMenu';
    import { mapState, mapActions, mapGetters } from 'vuex';

    export default {
        computed: {
            ...mapState({
                user: state => state.user.user,
                logged: state => state.user.logged,
                isMentor: state => state.user.logged && state.user.user.role === 2,
            }),
            ...mapGetters(['unreadNotificationsCount']),
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => this.$router.push({ name: 'welcome' }));
            },
        },
        components: {
            'catmenu': CatMenu,
            'notifmenu': NotifMenu,
        },
    };
</script>
<style>

</style>