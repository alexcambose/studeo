<template>
    <!-- redesign soon -->
    <div class="box mt-10" style="max-height: 400px; overflow-y: scroll">
        <button @click="modalActive = true" class="button is-primary is-pulled-right is-small">
            <b-icon pack="fa" icon="plus"></b-icon>
            <span>Adaugă notiță</span>
        </button>
        <b-modal :active.sync="modalActive" has-modal-card>
            <form @submit="addNote">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Adaugă notiță</p>
                    </header>
                    <section class="modal-card-body">
                            <b-field label="Titlu">
                                <b-input
                                        v-model="title"
                                        maxlength="100"
                                        minlength="4"
                                        required
                                ></b-input>
                            </b-field>
                            <b-field label="Conținut">
                                <b-input
                                        v-model="content"
                                        type="textarea"
                                        required
                                        maxlength="1000"
                                        minlength="4"
                                ></b-input>
                            </b-field>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button" type="button" @click="modalActive = false">Anulează</button>
                        <button :class="['button', 'is-success', (saving ? 'is-loading' : '')]" type="submit">Adaugă</button>
                    </footer>
                </div>
            </form>
        </b-modal>
        <p class="title is-4"><b-icon pack="fa" icon="sticky-note" size="is-small"></b-icon> Notițe - {{notes.length}}</p>
        <hr>
        <course-note-item v-for="(note, index) in notes" :note-index="index" :key="index"></course-note-item>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import CourseNoteItem from './CourseNoteItem.vue';
    export default {
        data() {
            return {
                title: '',
                content: '',
                modalActive: false,
                saving: false,
            };
        },
        computed: {
            ...mapState({
                notes: ({ course }) => course.notes,
            }),
        },
        methods: {
            addNote(e) {
                e.preventDefault();
                this.saving = true;
                this.$store.dispatch('addNote', this)
                    .then(() => {
                        this.saving = false;
                        this.modalActive = false;
                    });
            },
        },
        components: {
            CourseNoteItem,
        },
    };
</script>
