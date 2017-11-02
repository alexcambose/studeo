<template>
    <card title="Login">
        <form @submit="makeLogin">
            <b-field label="Email">
                <b-input type="email" v-model="email"></b-input>
            </b-field>

            <b-field label="Parola">
                <b-input type="password" v-model="password" password-reveal></b-input>
            </b-field>

            <div class="checkbox mb-10">
                <b-checkbox v-model="remember">Reține parola</b-checkbox>
            </div>

            <button class="button is-primary is-fullwidth">Autentificare</button>
        </form>
    </card>
</template>

<script>
//    import { mapActions } from 'vuex';
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