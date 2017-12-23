<template>
    <b-upload v-model="file"
              drag-drop
              accept=".png, .jpg, .jpeg">
        <section class="section">
            <div class="content has-text-centered">
                <p v-if="!file.length">
                    <b-icon
                            icon="upload"
                            size="is-large">
                    </b-icon>
                    <b-icon
                            pack="fa"
                            icon="picture-o"
                            size="is-small">
                    </b-icon>
                </p>
                <div v-else class="preview-image-container">
                    <span class="preview-image" :style="{'background': `url(${preview})`}"></span>
                </div>
                <div v-if="file[0]">
                    <div>{{file[0].name}}</div>
                    <small>{{fileSize}}</small>
                    <div>
                        <button @click="file = []" class="button is-danger is-small"><b-icon pack="fa" icon="times"></b-icon></button>
                    </div>
                    <progress v-if="progress" class="progress is-success mt-10" :value="progress" max="100">{{progress}}%</progress>
                </div>
                <div v-else>
                    <p>{{title}}</p>
                    <small>(.png, .jpg, .jpeg{{maxsize ? `, max ${convertFileSizeToHuman(maxsize)}` : ''}})</small>
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
                default: 10000000,
            },
        },
        computed: {
            fileSize() {
                if (this.file[0]) {
                    return this.convertFileSizeToHuman(this.file[0].size);
                }
            },
        },
        data() {
            const file = this.value ? [this.value] : [];
            this.changed(file);
            return {
                file,
                progress: 0,
                error: '',
                preview: '',
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
            setProgress(value) {
                this.progress = value;
            },
            changed(newVal) {
                const file = newVal[0];
                if (this.maxsize && file && file.size > this.maxsize) {
                    this.error = 'Imaginea este prea mare!';
                    this.file = [];
                    return 0;
                }
                this.$emit('input', file);
                if (file) {
                    this.error = '';
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        this.preview = reader.result;
                    };
                }
            },
        },
    };
</script>