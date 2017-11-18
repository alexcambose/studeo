<template>
    <div>
        <div class="image-change">
        </div>
        <form @submit="submit" class="mb-30">
            <b-field label="Descriere">
                <b-input
                        v-model="description"
                        type="textarea"
                        maxlength="250"
                >
                </b-input>
            </b-field>

            <b-field label="Studii">
                <b-input
                    v-model="school"
                    icon-pack="fa"
                    icon="graduation-cap"
                >
                </b-input>
            </b-field>

            <b-field label="Nivel de studii">
                <b-select expanded
                          v-model="school_level"
                          icon-pack="fa"
                          icon="university"
                >
                    <option value="0">Altceva</option>
                    <option value="1">Scoala generala</option>
                    <option value="2">Gimnaziu</option>
                    <option value="3">Liceu</option>
                    <option value="4">Facultate</option>
                </b-select>
            </b-field>

            <b-field label="Zi de naștere">
                <b-datepicker
                         v-model="birthday"
                         placeholder="Apasa pentru a selecta ziua de nastere"
                         icon="calendar-today"
                >
                </b-datepicker>
            </b-field>

            <b-field label="Numar de telefon">
                <b-input
                        v-model="phone"
                        type="number"
                        icon-pack="fa"
                        icon="phone"
                >
                </b-input>
            </b-field>

            <b-field label="Poreclă">
                <b-input
                        v-model="nickname"
                        maxlength="20"
                        icon-pack="fa"
                        icon="address-book-o"
                ></b-input>
            </b-field>

            <b-field label="Sex">
                <b-select
                        expanded
                        v-model="sex"
                        icon-pack="fa"
                        icon="genderless"
                >
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
                phone: user.phone,
                birthday: new Date(user.birthday),
                description: user.description,
                school: user.school,
                school_level: user.school_level,
                fetching: false,
                success: '',
            };
        },
        methods: {
            makeDate(e) {
                return new Date(e);
            },
            submit(e) {
                e.preventDefault();
                this.fetching = true;
                this.$store.dispatch('updateUserProfile', this)
                    .then(() => {
                        this.fetching = false;
                        this.success = "Datele au fost salvate";
                    })
                    .catch(() => this.fetching = true);
            }
        },
        components: {
            Submit,
        },
    }
</script>