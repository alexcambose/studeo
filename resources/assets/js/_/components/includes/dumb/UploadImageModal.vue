<template>
    <div>
        <b-modal :active.sync="showModal" has-modal-card>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{modalTitle}}</p>
                </header>
                <section class="modal-card-body">
                    <upload-image ref="uploadImage" v-bind="$attrs" v-model="file"></upload-image>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="hide">{{closeLabel}}</button>
                    <button class="button is-success" @click="submit" :disabled="!file">{{submitLabel}}</button>
                </footer>
            </div>
        </b-modal>
    </div>
</template>
<script>
    import UploadImage from './UploadImage.vue';
    export default {
        props: {
            modalTitle: {
                default: 'Incarcă imagine',
            },
            closeLabel: {
                default: 'Anulează',
            },
            submitLabel: {
                default: 'Trimite',
            },
        },
        data() {
            return {
                showModal: false,
                file: null,
            };
        },
        methods: {
            submit() {
                this.$emit('submit', this.file);
            },
            show() {
                this.showModal = true;
            },
            hide() {
                this.showModal = false;
            },
            setProgress(value) {
                this.$refs.uploadImage.setProgress(value);
            },
        },
        components: {
            UploadImage,
        },
    };
</script>