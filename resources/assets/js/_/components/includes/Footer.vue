<template>
    <div class="footer">
        <div class="container">
            <router-link :to="{name: 'becomeMentor'}">Adauga cursuri</router-link>
        </div>
        <div class="footer-bottom">© {{year}}</div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: {
            ...mapState({
                logged: state => state.user.logged,
            }),
            year() {
                return (new Date).getFullYear(); //in caz ca se schimba anul in timp ce userul este pe site :)
            }
        }
    };
</script>