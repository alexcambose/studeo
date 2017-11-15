<template>
    <div class="footer">
        <div class="container">
            <router-link v-if="isMentor"  :to="{name: 'dashboard'}">Adaugă un curs</router-link>
            <router-link v-else :to="{name: 'becomeMentor'}">Adaugă cursuri</router-link>
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
                isMentor: state => state.user.user.role === 2,
            }),
            year() {
                return (new Date).getFullYear(); //in caz ca se schimba anul in timp ce userul este pe site :)
            }
        }
    };
</script>