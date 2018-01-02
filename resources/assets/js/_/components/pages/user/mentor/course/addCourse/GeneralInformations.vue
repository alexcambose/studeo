<template>
    <div>
        <b-field label="Titlu">
            <b-input
                    :value="newCourse.title"
                    @blur="setTitle"
                    maxlength="100"
                    minlength="4"
                    required
            ></b-input>
        </b-field>
        <button @click="fetchBestSlug" :class="['button', 'is-small', 'is-pulled-right', (fetchingSlug ? 'is-loading': '')]">Alege cea mai bună variantă</button>
        <b-field label="Legătură permanentă" :message="`Link-ul cursului tău va fi <em>${courseLink}</em>`">
                <b-input
                        :value="decodeURIComponent(newCourse.slug)"
                        @input.native="setData('slug', $event.target.value)"
                        maxlength="100"
                        minlength="4"
                        expanded
                        required
                ></b-input>
        </b-field>
        <course-tag-input v-model="tags" placeholder="Adaugă câteva etichete pentru a face cursul mai ușor de găsit"></course-tag-input>
        <b-field label="Categorie">
            <b-select expanded
                      placeholder="Alege o categorie"
                      :value="newCourse.category"
                      @blur="setData('category', parseInt($event.target.value))">
                <option v-for="category in classes" :value="category.id">{{ category.name }}</option>
            </b-select>
        </b-field>
        <b-field label="Scurtă descriere">
            <b-input
                    maxlength="240"
                    required
                    type="textarea"
                    :value="newCourse.short_description"
                    @blur="setData('short_description', $event.target.value)"
            ></b-input>
        </b-field>
        <b-field label="Descriere completă">
            <markdown-textarea
                    maxlength="4000"
                    required
                    type="textarea"
                    :value="newCourse.description"
                    @blur="setData('description', $event.target.value)"
            ></markdown-textarea>
        </b-field>
        <hr>
        <b-field label="Dificultate">
            <b-select expanded placeholder="Selectează un nivel de dificultate" :value="newCourse.difficulty" @blur="setData('difficulty', parseInt($event.target.value))">
                <option value="1">Ușor</option>
                <option value="2">Mediu</option>
                <option value="3">Greu</option>
            </b-select>
        </b-field>
        <multiple-fields
                :value="newCourse.prerequisites"
                label="Cerințe preliminare"
                addFieldLabel="Adaugă cerință nouă"
                @change="values => setData('prerequisites', values)"
        ></multiple-fields>
        <div class="mt-10">
            <upload-image title="Imaginea cursului" v-model="image"></upload-image>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';
    import config from '../../../../../../../config';
    import MultipleFields from '../../../../../../components/includes/dumb/MultipleFields.vue';
    import UploadImage from '../../../../../includes/dumb/UploadImage.vue';
    import CourseTagInput from '../../../../../includes/course/CourseTagInput.vue';
    import { MATERII } from '../../../../../../../utils';
    import MarkdownTextarea from '../../../../../includes/dumb/MarkdownTextarea';

    export default {
        data() {
            return {
                fetchingSlug: false,
                classes: MATERII,
            };
        },
        computed: {
            ...mapState({
                newCourse: state => state.newCourse,
            }),
            tags: {
                get() {
                    return this.newCourse.tags;
                },
                set(value) {
                    this.setData('tags', value);
                },
            },
            image: {
                get() {
                    return this.newCourse.image;
                },
                set (value) {
                    this.setData('image', value);
                },
            },
            courseLink() {
                return `${window.location.host}/curs/<b>${encodeURIComponent(this.newCourse.slug)}</b>`;
            },
        },
        methods: {
            ...mapActions(['updateNewCourseData']),
            setData(key, value) {
                this.updateNewCourseData({ [key]: value });
            },
            setTitle(e) {
                this.updateNewCourseData('title', e.target.value);
                if (this.newCourse.slug.trim() === '') {
                    this.updateNewCourseData('slug', e.target.value.replace(' ', '-').toLowerCase());
                }
            },
            fetchBestSlug() {
                this.fetchingSlug = true;
                axios.get(config.url.COURSE_BEST_SLUG + this.newCourse.title)
                    .then(({ data }) => {
                        this.fetchingSlug = false;
                        this.setData('slug', encodeURIComponent(data.slug));
                        console.log(this.newCourse.slug);
                    });
            },
        },
        components: {
            MarkdownTextarea,
            CourseTagInput,
            MultipleFields,
            UploadImage,
        },
    };
</script>