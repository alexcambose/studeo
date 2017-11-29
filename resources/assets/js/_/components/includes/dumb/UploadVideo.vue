<template>
        <b-upload multiple
                  v-model="file"
                  drag-drop
                  accept=".mp4">
            <section class="section">
                <div class="content has-text-centered">
                    <p>
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
                        <small>(.mp4, max 500 MB)</small>
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
            };
        },
        watch: {
            file(value) {
                this.$emit('input', value[0]);
            },
        },
    };
</script>