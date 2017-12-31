<template>
    <form @submit="submit" class="mb-30 mt-10">
        <div class="columns">
            <div class="column is-8">
                <b-field label="Copertă">
                    <input
                            type="color"
                            class="input is-fullwidth"
                            v-model="cover_color"
                    >
                </b-field>
            </div>
            <div class="column is-4 has-text-centered">
                <image-container class="settings_img" :src="image"></image-container>
                <div class="image-change">
                    <upload-image-modal
                            title="Adaugă fotografie"
                            @submit="updateImage"
                            ref="updateImageModal"
                    ></upload-image-modal>
                    <button @click="$refs.updateImageModal.show()" class="button is-primary is-fullwidth">Schimbă imaginea</button>
                </div>
            </div>
        </div>

        <b-field label="Descriere">
            <markdown-textarea
                    v-model="description"
                    type="textarea"
                    maxlength="250"
            >
            </markdown-textarea>
        </b-field>
        <div class="columns">
            <div class="column">
                <b-field label="Studii" >
                    <b-input expanded
                            v-model="school"
                            icon-pack="fa"
                            icon="graduation-cap"
                    >
                    </b-input>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Nivel de studii">
                    <b-select expanded
                              v-model="school_level"
                              icon-pack="fa"
                              icon="university"
                    >
                        <option v-for="(level, index) in classLevels" :value="index">{{level}}</option>
                    </b-select>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Funcție">
                    <b-select v-model="is_teacher" icon="account" expanded>
                        <option :value="0">Elev</option>
                        <option :value="1">Profesor</option>
                    </b-select>
                </b-field>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <b-field label="Zi de naștere" expanded>
                    <b-datepicker
                            v-model="birthday"
                            :max-date="new Date(2009, 0, 0)"
                            :month-names="monthNames"
                            :day-names="dayNames"
                            placeholder="Apasă pentru a selecta ziua de naștere"
                            icon="calendar-today"
                    >
                    </b-datepicker>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Oraș" expanded>
                    <b-select
                            expanded
                            v-model="city"
                            icon-pack="fa"
                            icon="building"
                    >
                        <option v-for="(item, index) in cities" :value="index">{{ item }}</option>
                    </b-select>
                </b-field>
            </div>
        </div>
        <b-field label="Număr de telefon">
            <b-input
                    v-model="phone"
                    type="number"
                    icon-pack="fa"
                    icon="phone"
            >
            </b-input>
        </b-field>
        <b-field label="Sex">
            <b-select
                    expanded
                    v-model="sex"
                    icon="opacity"
            >
                <option value="0">Masculin</option>
                <option value="1">Feminin</option>
                <option value="2">Altceva</option>
            </b-select>
        </b-field>

        <b-field label="Poreclă">
            <b-input
                    v-model="nickname"
                    maxlength="20"
                    icon-pack="fa"
                    icon="address-book-o"
            ></b-input>
        </b-field>
        <submit :fetching="fetching" :success="success">Salvează</submit>
    </form>
</template>

<script>
    import ImageContainer from '../../../includes/dumb/ImageContainer.vue';
    import Submit from '../../../../components/includes/dumb/Submit.vue';
    import UploadImageModal from '../../../../components/includes/dumb/UploadImageModal.vue';
    import config from '../../../../../config';
    import { cities, monthNames, dayNames } from '../../../../../utils';
    import MarkdownTextarea from '../../../includes/dumb/MarkdownTextarea';

    export default {
        computed: {
            image() {
                return this.$store.state.user.user._image.filename;
            },
        },
        data() {
            const user = this.$store.state.user.user;
            return {
                cities: cities,
                nickname: user.nickname,
                city: user.city,
                sex: user.sex,
                phone: user.phone,
                birthday: new Date(user.birthday),
                description: user.description,
                school: user.school,
                school_level: user.school_level,
                is_teacher: user.is_teacher,
                fetching: false,
                cover_color: user.cover_color,
                success: '',
                classLevels: config.classLevels,
                monthNames, dayNames,
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
            updateImage(file) {
                // this.$refs.updateImageModal.setProgress(12);
                this.$store.dispatch('updateUserProfileImage', { file, progressCallback: value => this.$refs.updateImageModal.setProgress(value) })
                    .then(() => {
                        this.$refs.updateImageModal.hide();
                    });
            },
        },
        components: {
            MarkdownTextarea,
            Submit,
            UploadImageModal,
            ImageContainer,
        },
    };
</script>