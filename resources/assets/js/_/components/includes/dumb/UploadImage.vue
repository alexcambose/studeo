<template>
    <b-upload multiple
              v-model="file"
              drag-drop
              accept=".png, .jpg, .jpeg">
        <section class="section">
            <div class="content has-text-centered">
                <p v-if="!file.length">
                    <b-icon
                            icon="upload"
                            size="is-large">
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
        props: ['title', 'maxsize'],
        computed: {
            fileSize() {
                if (this.file[0]) {
                    return this.convertFileSizeToHuman(this.file[0].size);
                }
            },
        },
        data() {
            return {
                file: [],
                progress: 0,
                error: '',
                preview: '',
            };
        },
        watch: {
            file(value) {
                const file = value[0];
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
        methods: {
            convertFileSizeToHuman,
            setProgress(value) {
                this.progress = value;
            },
        },
    };
</script>