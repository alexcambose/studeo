<template>
    <div>

        <form @submit="submit" class="mb-30 mt-15">
            <div class="columns">
                <div class="column">
                    <b-field label="Copertă">
                        <input
                                type="color"
                                class="is-fullwidth"
                                v-model="cover_color"
                        >
                    </b-field>
                </div>
                <div class="column" style="text-align:center">
                    <img src="http://www.jocuri-kids.ro/files/img/Locomotiva-Thomas-in-Mexic_1405782948.jpg" class="settings_img" height="200" width="200" alt="">
                    <div class="image-change">
                        <upload-image-modal title="Adaugă fotografie"></upload-image-modal>
                    </div>
                </div>
            </div>


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
                    <option v-for="(level, index) in classLevels" :value="index">{{level}}</option>
                </b-select>
            </b-field>

            <b-field label="Zi de naștere">
                <b-datepicker
                         v-model="birthday"
                         :max-date="new Date(2009, 0, 0)"
                         :month-names="['Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie','Octombrie', 'Noiembrie', 'Decembrie']"
                         :day-names="['Lu','Ma','Mi','Jo','Vi','Sb','D']"
                         placeholder="Apasă pentru a selecta ziua de naștere"
                         icon="calendar-today"
                >
                </b-datepicker>
            </b-field>

            <b-field label="Număr de telefon">
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
    import UploadImageModal from '../../../../components/includes/dumb/UploadImageModal';
    import config from '../../../../../config';

    export default {
        data() {
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
                cover_color: user.cover_color,
                success: '',
                classLevels: config.classLevels,
            };
        },
        methods: {
            submit(e) {
                e.preventDefault();
                this.fetching = true;
                this.$store.dispatch('updateUserProfile', this)
                    .then(() => {
                        this.fetching = false;
                        this.success = 'Datele au fost salvate';
                    })
                    .catch(() => this.fetching = false);
            },
        },
        components: {
            Submit,
            UploadImageModal,
        },
    };
</script>