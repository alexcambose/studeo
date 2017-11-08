<template>
    <div>
        <nav-bar></nav-bar>
        <router-view></router-view>
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