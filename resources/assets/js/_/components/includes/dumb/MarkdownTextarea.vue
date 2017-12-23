<template>
    <div class="markdown-textarea">
        <div class="header">
            <b-checkbox @input="toggleAutomaticPreview" :value="automaticPreview" class="toggle-checkbox">
                Previzualizare automată
            </b-checkbox>
            <div v-if="!automaticPreview" class="field has-addons toggle-buttons">
                <p class="control">
                    <button @click="hovered = true" :class="['button', 'is-small', hovered ? 'is-primary' : '']">
                        <b-icon icon="format-text" size="is-small"></b-icon>
                        <span>Simplu</span>
                    </button>
                </p>
                <p class="control">
                    <button @click="hovered = false" :class="['button', 'is-small', hovered ? '' : 'is-primary']">
                        <b-icon icon="sign-text" size="is-small"></b-icon>
                        <span>Formatat</span>
                    </button>
                </p>
            </div>
            <button @click="isHelpModalActive = true" class="button is-small button-help"> ? </button>
        </div>
        <div @mouseover="onEnter" @mouseleave="onLeft">
            <div v-if="hovered">
                <b-input
                        :value="content"
                        @input="onChange"
                        v-bind="$attrs"
                        type="textarea"
                ></b-input>
            </div>
            <div v-else-if="content.trim()" v-html="htmlContent" class="content"></div>
            <div v-else-if="automaticPreview" class="instructions">Poziționează cursorul deasupra pentru a edita</div>
            <div v-else class="instructions">Nu există conținut</div>
        </div>
        <b-modal :active.sync="isHelpModalActive" has-modal-card>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Formatare text</p>
                </header>
                <section class="modal-card-body">
                    ffff
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="isHelpModalActive = false">Close</button>
                </footer>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import { markdown } from 'markdown';
    export default {
        props: {
            value: {
                type: String,
                required: false,
            },
        },
        data() {
            return {
                content: this.value,
                hovered: true,
                automaticPreview: true,
                isHelpModalActive: false,
            };
        },
        computed: {
            htmlContent() {
                return markdown.toHTML(this.content);
            },
        },
        methods: {
            onChange(value) {
                this.content = value;
                this.$emit('input', this.content);
            },
            toggleAutomaticPreview(value) {
                this.automaticPreview = value;
                this.hovered = !this.automaticPreview;
            },
            onEnter() {
                if (!this.automaticPreview) return;
                this.hovered = true;
            },
            onLeft() {
                if (!this.automaticPreview) return;
                this.hovered = false;
            },
        },
    };
</script>

<style>
    .markdown-textarea .instructions{
        text-align: center;
        padding: 10px;
        font-style: italic;
        opacity: .8;
    }
    .markdown-textarea .header{
        display: flex;
        align-items: center;
        margin-bottom: 4px;
    }
    .markdown-textarea .button-help {
        margin-left: auto;
        display: flex;
        justify-self: flex-end;
    }
    .markdown-textarea .toggle-checkbox {

    }
    .markdown-textarea .toggle-buttons {
        display: flex;
        justify-content: flex-end;
        flex: 1;
        margin: 0 4px 0 0;
    }

</style>