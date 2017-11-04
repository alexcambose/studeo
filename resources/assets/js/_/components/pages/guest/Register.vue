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
                ></b-input>
            </b-field>

            <b-field label="Prenume">
                <b-input
                    type="text"
                    v-model="first_name"
                    icon="face"
                    maxlength="30"
                    :has-counter="true"
                ></b-input>
            </b-field>

            <b-field label="Username">
                <b-input
                    type="text"
                     v-model="username"
                     icon-pack="fa"
                     icon="user"
                     minlength="4"
                     maxlength="16"
                     :has-counter="false"
                ></b-input>
            </b-field>

            <b-field label="Email">
                <b-input
                    type="email"
                    icon-pack="fa"
                    icon="envelope"
                    v-model="email"
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
                            icon="key"
                            minlength="6"
                            maxlength="20"
                            :has-counter="false"
                            password-reveal
                        ></b-input>
                    </b-field>
                </div>
                <div class="column">
                    <b-field label="Confirma Parola">
                        <b-input
                            type="password"
                            v-model="rpassword"
                            icon-pack="fa"
                            icon="key"
                            minlength="6"
                            maxlength="20"
                            :has-counter="false"
                            password-reveal
                        ></b-input>
                    </b-field>
                </div>
            </div>

            <button class="button is-primary is-fullwidth">Inregistreaza-te</button>
        </form>
    </card>
</template>

<script>
    import Card from '../../includes/dumb/Card';

    export default {
        data: function(){
            return {
                first_name: '',
                last_name: '',
                email: '',
                password:'',
                rpassword:'',
                username: '',
            };
        },
        methods: {
            makeRegister(e){
                e.preventDefault();
                console.log(this.$store.state.email);
            }
        },
        components: {
            'card': Card,
        },
    }
</script>