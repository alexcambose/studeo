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
            <div class="has-text-danger">{{error}}</div>
            <button type="submit" :class="['button','is-primary','is-fullwidth',(fetching ? 'is-loading' : '')]">Actualizeaza parola</button>
        </form>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                fetching: false,
                error: '',
                success: '',
                current_password: '123456',
                password: '1234566',
                cpassword: '1234566',
            };
        },
        methods: {
            submitPassword(e) {
                e.preventDefault();

                if(this.password !== this.cpassword) {
                    this.error = 'Parolele nu se potrivesc';
                    return;
                }

                this.fetching = true;
                this.$store.dispatch('updateUserPassword', this)
                    .then(() => {
                        this.fetching = false;
                        this.error = '';
                        this.success = 'Parola a fost schimbata';
                        this.current_password = '';
                        this.password = '';
                        this.cpassword = '';
                    })
                    .catch(err => {
                        this.fetching = false;
                        this.error = err;
                    });
            }
        }
    }
</script>