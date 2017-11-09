<template>
    <card title="Inregistrare" icon="user-plus">
        <form @submit="makeRegister">
            <b-field label="Nume">
                <b-input
                    type="text"
                    v-model="last_name"
                    maxlength="30"
                    icon="face"
                    :has-counter="true"
                    required
                ></b-input>
            </b-field>

            <b-field label="Prenume">
                <b-input
                    type="text"
                    v-model="first_name"
                    icon="face"
                    maxlength="30"
                    :has-counter="true"
                    required
                ></b-input>
            </b-field>

            <b-field label="Nume utilizator">
                <b-input
                    type="text"
                     v-model="username"
                     icon-pack="fa"
                     icon="user"
                     minlength="4"
                     maxlength="16"
                     :has-counter="false"
                    required
                ></b-input>
            </b-field>

            <b-field label="Email">
                <b-input
                    type="email"
                    icon-pack="fa"
                    icon="envelope"
                    v-model="email"
                    required
                ></b-input>
            </b-field>
            <div class="columns">
                <div class="column">
                    <b-field label="Parola">
                        <b-input
                            type="password"
                            v-model="password"
                            class="is-half"
                            icon-pack="fa"
                            icon="lock"
                            minlength="6"
                            maxlength="20"
                            :has-counter="false"
                            password-reveal
                            required
                        ></b-input>
                    </b-field>
                </div>
                <div class="column">
                    <b-field label="Confirma Parola">
                        <b-input
                            type="password"
                            v-model="rpassword"
                            icon-pack="fa"
                            icon="lock"
                            minlength="6"
                            maxlength="20"
                            :has-counter="false"
                            password-reveal
                            required
                        ></b-input>
                    </b-field>
                </div>
            </div>
            <div class="has-text-danger">{{error}}</div>
            <button :class="['button','is-primary','is-fullwidth',(fetching ? 'is-loading' : '')]">Inregistrare</button>
        </form>
    </card>
</template>

<script>
    import Card from '../../includes/dumb/Card';

    export default {
        data: function(){
            return {
                first_name: 'Prenume',
                last_name: 'Nume',
                username: 'pre.nume',
                email: 'email@email.com',
                password:'123456',
                rpassword:'123456',
                error: '',
                fetching: false,
            };
        },
        methods: {
            makeRegister(e){
                e.preventDefault();
                this.fetching = true;
                this.$store.dispatch('register', this)
                    .then(() => {
                        this.fetching = false;
                        this.$router.push({name: 'home'});
                    })
                    .catch(err => {
                        this.error = err;
                        this.fetching = false;
                    });
            }
        },
        components: {
            'card': Card,
        },
    }
</script>