<template>
    <div>
        <nav-bar></nav-bar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Navbar from './components/includes/Navbar';

    export default {
        components: {
            'nav-bar': Navbar,
        },
    };
</script>