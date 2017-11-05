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
                    <router-link to="/" class="navbar-item is-hoverable is-tab is-hidden-mobile">Acasa</router-link>
                    <router-link to="/quiz" class="navbar-item is-hoverable is-tab is-hidden-mobile">Quiz</router-link>

                    <div class="navbar-item is-hoverable has-dropdown">
                        <a class="navbar-link">
                            <i class="material-icons">grid_on</i>
                        </a>

                        <div class="navbar-dropdown">

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
                <div class="navbar-item is-hoverable has-dropdown">
                    <a href="#" class="navbar-link">Salut, {{user.first_name}}</a>
                    <div class="navbar-dropdown">
                        <router-link to="/profile" class="navbar-item"><span class="icon"><i class="fa fa-user"></i> </span>&nbsp; Profile</router-link>
                        <router-link to="/notifications" class="navbar-item"><span class="icon"><i class="fa fa-comment"></i></span>&nbsp; Notifications</router-link>
                        <router-link to="/settings" class="navbar-item"><span class="icon"><i class="fa fa-cog"></i></span>&nbsp; Settings</router-link>

                        <router-link to="/admin" class="navbar-item"><span class="icon"><i class="fa fa-lock"></i></span>&nbsp; Admin Panel</router-link>

                        <hr class="navbar-divider">

                        <a class="navbar-item" @click="logout">
                            <span class="icon"><i class="fa fa-sign-out"></i></span>&nbsp; Log out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
    import { mapState, mapActions } from 'vuex';

    export default {
        computed: mapState({
            user: state => state.user.user,
            logged: state => state.user.logged,
        }),
        methods: {
            logout() {
                this.$store.dispatch('logout').then(() => this.$router.push({name: 'login'}));
            }
        }
    };
</script>
<style>

</style>