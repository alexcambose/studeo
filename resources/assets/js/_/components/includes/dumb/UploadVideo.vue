<template>
    <b-upload v-model="file"
              drag-drop
              accept=".mp4">
        <section class="section">
            <div class="content has-text-centered">
                <p v-if="!file.length">
                    <b-icon
                            icon="upload"
                            size="is-large">
                    </b-icon>
                    <b-icon
                            pack="fa"
                            icon="video-camera"
                            size="is-small">
                    </b-icon>
                </p>
                <div v-if="file[0]">
                    <p>{{file[0].name}}</p>
                    <small>{{file[0].size}}</small>
                    <div>
                        <button @click="file = []" class="button is-danger is-small"><b-icon pack="fa" icon="times"></b-icon></button>
                    </div>
                </div>
                <div v-else>
                    <p>{{title}}</p>
                    <small>(.mp4{{maxsize ? `, max ${convertFileSizeToHuman(maxsize)}` : ''}})</small>
                    <p v-if="this.error" class="has-text-danger">{{error}}</p>
                </div>

            </div>
        </section>
    </b-upload>
</template>

<script>
    import { convertFileSizeToHuman } from '../../../../utils';

    export default {
        props: {
            title: String,
            value: File,
            maxsize: {
                type: Number,
                default: 100000000,
            },
        },
        data() {
            const file = this.value ? [this.value] : [];
            this.changed(file);
            return {
                file,
                error: '',
            };
        },
        watch: {
            value(value) {
                this.file = value ? [value] : [];
            },
            file(value) {
                this.changed(value);
            },
        },
        methods: {
            convertFileSizeToHuman,
            changed(newVal) {
                const file = newVal[0];
                if (this.maxsize && file && file.size > this.maxsize) {
                    this.error = 'Fișierul este prea mare!';
                    this.file = [];
                    return 0;
                }
                this.$emit('input', file);
                if (file) {
                    this.error = '';
                }
            },
        },
    };
</script>