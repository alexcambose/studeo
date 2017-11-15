<template>
    <div class="afterApp">
        <navbar></navbar>
        <router-view></router-view>
        <_footer></_footer>
    </div>
</template>
<script>
    import Navbar from './components/includes/Navbar';
    import Footer from './components/includes/Footer';

    export default {
        components: {
            Navbar,
            _footer: Footer,
        },
    };
</script>