<template>
    <div>
        <button @click="isComponentModalActive = true" class="button is-info">{{buttonLabel}}</button>
        <b-modal :active.sync="isComponentModalActive" has-modal-card>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{modalTitle}}</p>
                </header>
                <section class="modal-card-body">
                    <upload-image v-bind="$attrs" v-model="file"></upload-image>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="isComponentModalActive = false">{{closeLabel}}</button>
                    <button class="button is-primary" @click="submit">{{submitLabel}}</button>
                </footer>
            </div>
        </b-modal>
    </div>
</template>
<script>
    import UploadImage from './UploadImage.vue';
    export default {
        props: {
            buttonLabel: {
                default: 'Adaugă imagine',
            },
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
                isComponentModalActive: false,
                file: [],
            };
        },
        methods: {
            submit() {
                console.log(this.file);
            },
        },
        components: {
            UploadImage,
        },
    };
</script>