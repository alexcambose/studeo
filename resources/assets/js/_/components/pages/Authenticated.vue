<template>
    <card title="Login">
       A MERS
    </card>
</template>

<script>
    import Card from '../includes/dumb/Card';

    export default {
        data: function(){
            return {
                email: 'sandelultul@ba.lo',
                password:'123456',
                remember: '',
            };
        },
        methods: {
            makeLogin(e){
                e.preventDefault();
                this.$store.dispatch('login', {email:this.email, password: this.password});
                console.log(this.$store, this.password);
            }
        },
        components:{
            'card': Card,
        },
    }
</script>