<template>
    <card title="Login" icon="sign-in">
        <form @submit="makeLogin">
            <b-field label="Email">
                <b-input
                        type="email"
                        icon-pack="fa"
                        icon="envelope"
                        v-model="email"
                        required
                ></b-input>
            </b-field>

            <b-field label="Parola">
                <b-input
                        type="password"
                        v-model="password"
                        icon-pack="fa"
                        icon="key"
                        :has-counter="false"
                        password-reveal
                        required
                ></b-input>
            </b-field>

            <div class="checkbox mb-10">
                <b-checkbox v-model="remember">Reține parola</b-checkbox>
            </div>
            <div class="has-text-danger">{{error}}</div>
            <button :class="['button','is-primary','is-fullwidth',(fetching ? 'is-loading' : '')]">Autentificare</button>
        </form>
    </card>
</template>

<script>
//    import { mapActions } from 'vuex';
    import Card from '../../includes/dumb/Card';

    export default {
        data: function(){
            return {
                email: 'sandel@sandica.com',
                password:'123456',
                remember: '',
                fetching: false,
                error: '',
            };
        },
        methods: {
            makeLogin(e){
                this.fetching = true;
                e.preventDefault();
                this.$store.dispatch('login', {email:this.email, password: this.password})
                    .then(() => {
                        this.$router.push({name:'root'});

                        this.fetching = false;
                    })
                    .catch(err => {
                        this.error = err;
                        this.fetching = false;
                    });
            }
        },
        components:{
            'card': Card,
        },
    }
</script>