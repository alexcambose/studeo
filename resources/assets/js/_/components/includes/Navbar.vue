<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="container">

            <div class="navbar-start">
                <div class="navbar-brand">
                    <router-link class="navbar-item" to="/">
                        <img src="http://www.bibleadvocacy.org/plugins/templates/ibac/images/IBAC_logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="50">
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
                            <i class="material-icons">grid_on</i>
                        </a>

                        <div class="navbar-dropdown navbar-classes">
                            <catmenu></catmenu>
                        </div>
                    </div>
                    <!--navbar secundar -->
                    <b-field style="padding-top: 12px">
                        <b-input placeholder="Search..."
                                 type="search"
                                 icon="search">
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
                        <i class="material-icons">notifications</i>
                        <span v-if="unreadNotificationsCount" class="tag is-rounded is-primary">{{unreadNotificationsCount}}</span>
                    </a>

                    <div class="navbar-dropdown navbar-notifications">
                        <notifmenu></notifmenu>
                    </div>
                </div>

                <div class="navbar-item is-hoverable has-dropdown">
                    <a href="#" class="navbar-link">Salut, {{user.first_name}}</a>
                    <div class="navbar-dropdown">
                        <router-link :to="{name: 'profile'}" class="navbar-item"><span class="icon"><i class="fa fa-user"></i> </span>&nbsp; Profil</router-link>
                        <router-link :to="{name: 'notifications'}" class="navbar-item"><span class="icon"><i class="fa fa-comment"></i></span>&nbsp; Notificări</router-link>
                        <router-link :to="{name: 'settings'}" class="navbar-item"><span class="icon"><i class="fa fa-cog"></i></span>&nbsp; Setări</router-link>

                        <router-link to="/admin" class="navbar-item"><span class="icon"><i class="fa fa-lock"></i></span>&nbsp; Panou admin</router-link>

                        <hr class="navbar-divider">

                        <router-link to="/asd" class="navbar-item"><span class="icon"><i class="fa fa-question-circle"></i></span>&nbsp; Ajutor</router-link>

                        <hr class="navbar-divider">

                        <a class="navbar-item" @click="logout">
                            <span class="icon"><i class="fa fa-sign-out"></i></span>&nbsp; Deautentificare
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