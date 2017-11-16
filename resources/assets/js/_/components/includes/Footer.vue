<template>
    <div class="footer" v-if="logged">
        <div class="footer-content">
            <router-link v-if="isMentor" :to="{name: 'dashboard'}">Cursurile mele</router-link>
            <router-link v-else :to="{name: 'becomeMentor'}">Adaugă cursuri</router-link>
        </div>


        <div class="footer-bottom">© {{year}}</div>
    </div>
    <div v-else class="footer">
        <div class="footer-content">
            <router-link :to="{name: 'legal'}">Termeni si conditii</router-link>
        </div>
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
                // in caz ca se schimba anul in timp ce userul este pe site :)
                return (new Date).getFullYear();
            },
        },
    };
</script>