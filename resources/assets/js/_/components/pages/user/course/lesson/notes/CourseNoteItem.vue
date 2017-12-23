<template>
        <b-collapse class="card" :open.sync="isOpen" @close="editMode = false; successfullySaved = ''">
            <div slot="trigger" class="card-header">
                <p class="card-header-title">
                    {{title}}
                </p>
                <a class="card-header-icon">
                    <b-icon :icon="isOpen ?
                    'menu-down' : 'menu-up'">
                    </b-icon>
                </a>
            </div>
            <div class="card-content">
                <div class="content">
                    <div v-if="!editMode">
                        {{content}}
                        <div v-if="successfullySaved" class="has-text-success has-text-centered"><hr>Modificările au fost salvate!</div>
                    </div>
                    <div v-else>
                        <form @submit="uploadNote">
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
                            <div class="field has-addons is-fullwidth">
                                <p @click="editCanceled" class="control is-fullwidth">
                                    <button class="button is-fullwidth" type="button">Anulează</button>
                                </p>
                                <p class="control is-fullwidth">
                                    <button :class="['button', 'is-success', 'is-fullwidth', (saving ? 'is-loading' : '')]" type="submit">Salvează</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <a v-if="!editMode" @click="editMode = true" class="card-footer-item">
                    <b-icon pack="fa" icon="edit" size="is-small"></b-icon>
                    &nbsp; Editează
                </a>
                <a @click="removeNote" class="card-footer-item has-text-danger">
                    <b-icon pack="fa" icon="trash" size="is-small"></b-icon>
                    &nbsp; Șterge
                </a>
            </footer>
        </b-collapse>
</template>

<script>
    import config from '../../../../../../../config';
    import { mapActions } from 'vuex';
    export default {
        props: {
            noteIndex: {
                type: Number,
                required: true,
            },
        },
        mounted() {
            this.initialTitle = this.note.title;
            this.initialContent = this.note.content;
        },
        data() {
            return {
                initialTitle: '',
                initialContent: '',
                isOpen: false,
                editMode: false,
                saving: false,
                successfullySaved: false,
            };
        },
        computed: {
            note() {
                return this.$store.state.course.notes[this.noteIndex];
            },
            title: {
                get() {
                    return this.note.title;
                },
                set(title) {
                    this.updateNote({ noteIndex: this.noteIndex, data: { title } });
                },
            },
            content: {
                get() {
                    return this.note.content;
                },
                set(content) {
                    this.updateNote({ noteIndex: this.noteIndex, data: { content } });
                },
            },
        },
        methods: {
            ...mapActions(['updateNote', 'deleteNote', 'saveNote']),
            editCanceled() {
                this.updateNote({ noteIndex: this.noteIndex, data: { title: this.initialTitle } });
                this.updateNote({ noteIndex: this.noteIndex, data: { content: this.initialContent } });
                this.editMode = false;
            },
            uploadNote(e) {
                e.preventDefault();
                this.saving = true;
                this.saveNote({ noteIndex: this.noteIndex, data: this })
                    .then(() => {
                        this.successfullySaved = true;
                        this.saving = false;
                        this.editMode = false;
                    });
            },
            removeNote() {
                this.$dialog.confirm({
                    title: 'Ștergere notă',
                    message: `Ești sigur că vrei să stergi <strong>${this.note.title}</strong> ?`,
                    confirmText: 'Șterge',
                    cancelText: 'Anulează',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        this.deleteNote({ noteIndex: this.noteIndex })
                            .then(() => this.$toast.open('Nota a fost ștearsă') );
                    },
                });
            },
        },
    };
</script>



