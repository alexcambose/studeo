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
                    <p>{{file[0].name}}</p>
                    <small>{{file[0].size}} *to MB*</small>
                    <div>
                        <button @click="file = []" class="button is-danger is-small"><b-icon pack="fa" icon="times"></b-icon></button>
                    </div>
                </div>
                <div v-else>
                    <p>{{title}}</p>
                    <small>(.png, .jpg, .jpeg, max 10 MB)</small>
                </div>

            </div>
        </section>
    </b-upload>
</template>

<script>
    export default {
        props: ['title'],
        data() {
            return {
                file: [],
                preview: '',
            };
        },
        watch: {
            file(value) {
                this.$emit('input', value[0]);
                if (value[0]) {
                    const reader = new FileReader();
                    reader.readAsDataURL(value[0]);
                    reader.onload = () => {
                        this.preview = reader.result;
                    };
                }
            },
        },
    };
</script>