<template>
    <div>
        <form @submit="submitPassword">
            <b-field label="Parola actuala">
                <b-input
                        type="password"
                        v-model="current_password"
                        class="is-half"
                        icon-pack="fa"
                        icon="key"
                        minlength="6"
                        maxlength="20"
                        :has-counter="false"
                        password-reveal
                        required
                ></b-input>
            </b-field>
            <b-field label="Parola noua">
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
            <b-field label="Confirma parola actuala">
                <b-input
                        type="password"
                        v-model="cpassword"
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
            <submit :error="error" :success="success" :fetching="fetching">Actualizeaza Parola</submit>
        </form>
    </div>
</template>

<script>
    import Submit from '../../../../components/includes/dumb/Submit';
    export default {
        data: function() {
            return {
                fetching: false,
                error: '',
                success: '',
                current_password: '123456',
                password: '123456',
                cpassword: '123456',
            };
        },
        methods: {
            submitPassword(e) {
                e.preventDefault();

                if(this.password !== this.cpassword) {
                    this.error = 'Parolele nu se potrivesc!';
                    return;
                }

                this.fetching = true;
                this.$store.dispatch('updateUserPassword', this)
                    .then(() => {
                        this.fetching = false;
                        this.error = '';
                        this.success = 'Parola a fost schimbata!';
                        this.current_password = '';
                        this.password = '';
                        this.cpassword = '';
                    })
                    .catch(err => {
                        this.fetching = false;
                        this.error = err;
                    });
            }
        },
        components: {
            'submit': Submit,
        },
    }
</script>