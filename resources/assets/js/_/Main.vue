<template>
    <div class="afterApp">
        <b-loading :active="!userFetched" animation="zoom"></b-loading>
        <div v-if="userFetched">
            <navbar v-if="hideNavbar"></navbar>
            <transition name="fade">
                <router-view></router-view>
            </transition>
            <_footer></_footer>
        </div>

    </div>
</template>
<script>
    import Navbar from './components/includes/Navbar';
    import Footer from './components/includes/Footer';
    import { mapState } from 'vuex';

    export default {
        computed: {
            ...mapState({
                userFetched: ({ user }) => user.fetched,
            }),
            hideNavbar() {
                const hideNavbar = this.$route.meta.hideNavbar;
                if (hideNavbar) {
                    document.getElementsByTagName('html')[0].classList.remove('has-navbar-fixed-top');
                } else {
                    document.getElementsByTagName('html')[0].classList.add('has-navbar-fixed-top');
                }
                return !this.$route.meta.hideNavbar;
            },
        },
        components: {
            Navbar,
            _footer: Footer,
        },
    };
</script>

<style>
    .fade-enter{
        transition: all .1s;
        transform: scale(.9);
    }
    .fade-enter-to{
        transition: all .1s;
        transform: scale(1);

    }
    .fade-leave{
        transition: all .1s;
        transform: scale(1);
    }
    .fade-leave-to{
        transition: all .1s;
        transform: scale(.9);

    }
</style>