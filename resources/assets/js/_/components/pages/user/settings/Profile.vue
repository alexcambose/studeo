<template>
    <div>
        <div class="image-change">
        </div>
        <form @submit="submit">
            <b-field label="Poreclă">
                <b-input v-model="nickname" maxlength="20"></b-input>
            </b-field>
            <b-field label="Sex">
                <b-select expanded v-model="sex">
                    <option value="0">Masculin</option>
                    <option value="1">Feminin</option>
                    <option value="2">Altceva</option>
                </b-select>
            </b-field>
            <submit :fetching="fetching" :success="success">Salvează</submit>
        </form>
    </div>
</template>

<script>
    import Submit from '../../../../components/includes/dumb/Submit';

    export default {
        data(){
            const user = this.$store.state.user.user;
            return {
                nickname: user.nickname,
                sex: user.sex,

                fetching: false,
                success: '',
            };
        },
        methods: {
            submit(e) {
                e.preventDefault();
                this.fetching = true;
//..
            }
        },
        components: {
            Submit,
        },
    }
</script>