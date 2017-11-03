<template>
    <nav class="navbar" style="height: 60px" role="navigation" aria-label="main navigation">
        <div class="container">

            <div class="navbar-start">
                <div class="navbar-brand">
                    <a class="navbar-item" href="">
                        <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
                    </a>

                    <button class="button navbar-burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="navbar-start" v-if="logged">
                    <a href="#" class="navbar-item is-hoverable is-tab is-hidden-mobile">Acasa</a>
                    <a href="#" class="navbar-item is-hoverable is-tab is-hidden-mobile">Quiz</a>
                    <div class="navbar-link cp"><span class="icon"><i class="fa fa-bars"></i></span></div>
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
                    <a href="#" class="navbar-link">User</a>
                    <div class="navbar-dropdown">
                        <a href="#" class="navbar-item"><span class="icon"><i class="fa fa-user"></i> </span>&nbsp; Profile</a>
                        <a href="#" class="navbar-item"><span class="icon"><i class="fa fa-comment"></i></span>&nbsp; Notifications</a>
                        <a href="#" class="navbar-item"><span class="icon"><i class="fa fa-cog"></i></span>&nbsp; Settings</a>

                        <a href="" class="navbar-item"><span class="icon"><i class="fa fa-lock"></i></span>&nbsp; Admin Panel</a>

                        <hr class="navbar-divider">

                        <a href="" class="navbar-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span class="icon"><i class="fa fa-sign-out"></i></span>&nbsp; Log out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
    import { mapState } from 'vuex';

    export default {
        computed: mapState({
            logged: state => state.user.logged,
        })
    };
</script>
<style>

</style>