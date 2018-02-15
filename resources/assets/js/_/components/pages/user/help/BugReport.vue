<template>
    <form @submit.prevent="submit">
        <b-field label="Email">
            <b-input
                    required
                    type="email"
                    maxlength="200"
                    v-model="email"
                    :has-counter="false"
            >
            </b-input>
        </b-field>
        <b-field label="Tip">
            <b-select v-model="type" expanded>
                <option value="1">Eroare</option>
                <option value="2">Sugestie</option>
                <option value="3">Reclamație</option>
            </b-select>
        </b-field>
        <b-field label="Titlu">
            <b-input
                    required
                    maxlength="200"
                    v-model="title"
            >
            </b-input>
        </b-field>
        <b-field label="Descriere">
            <b-input
                    required
                    type="textarea"
                    v-model="body"
                    minlength="50"
                    maxlength="2000"
                    placeholder="Te rugăm sa detaliezi cât mai bine problema"
            >
            </b-input>
        </b-field>

        <submit :fetching="fetching" :success="success">Trimite</submit>
    </form>
</template>

<script>
    import Submit from '../../../includes/dumb/Submit';
    import config from '../../../../../config';
    export default {
        data() {
            return {
                email: this.$store.state.user.user.email,
                title: '',
                body: '',
                type: 1,
                fetching: false,
                success: '',
            };
        },
        methods: {
            submit() {
                const { email, title, body, type } = this;
                this.fetching = true;
                axios.put(config.url.USER_REPORT, { email, title, body, type })
                    .then(({ data }) => {
                        if (data.success) this.success = 'Formularul a fost trimis. Mulțumim!';
                        this.fetching = false;
                    });
            },
        },
        components: {
            Submit,
        },
    };
</script>