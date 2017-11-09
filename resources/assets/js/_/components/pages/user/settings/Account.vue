<template>
    <div>
        <form @submit="updateUser">
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

            <b-field label="Nume utilizator" :message="`Link-ul profilului tau va fi <em>${profileLink}</em>`">
                <b-input
                        type="text"
                        v-model="username"
                        icon-pack="fa"
                        icon="user"
                        minlength="4"
                        maxlength="16"
                        :has-counter="true"
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
            <button type="submit" class="button">Salveaza</button>
        </form>
    </div>
</template>
<script>
    export default {

        data: function() {
            const user = this.$store.state.user.user;
            return {
                first_name: user.first_name,
                last_name: user.last_name,
                username: user.username,
                email: user.email,
            };
        },
        computed: {
            profileLink() {
                return `${window.location.host}/profil/<b>${this.username.split(' ').join('-')}</b>`;
            }
        },
        methods: {
            updateUser(e) {
                e.preventDefault();
                this.$store.dispatch('updateUser')
                    .then(() => {

                    })
                    .catch();
            }
        }
    };
</script>