<template>
    <card :title="'SALUTARE DOMNULE ' + this.$store.state.user.user.name">
       <button class="button" @click="makeLogout">Logout</button>
    </card>
</template>

<script>
    import Card from '../includes/dumb/Card';

    export default {
        methods: {
            makeLogout(){
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push({name: 'login'});
                    });
            }
        },
        components:{
            'card': Card,
        },
    }
</script>