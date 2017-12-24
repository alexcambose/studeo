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
                    <p class="modal-card-title">Formatare text in markdown</p>
                </header>
                <section class="modal-card-body" style="height: 600px;">
                    <div class="content">
                        <p>Markdown este un instrument de conversie text-la-HTML pentru scriitorii web. Markdown vă
                            permite să
                            scrieți utilizând un format de text simplu, ușor de citit și ușor de scris, apoi să îl
                            convertiți la XHTML valabil structural.</p>
                        <table class="table is-bordered is-fullwidth">
                            <thead>
                            <tr>
                                <th>Tip</th>
                                <th>Rezultat</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr> <td><code># Titlu 1</code></td> <td><h1>Titlu 1</h1> </td> </tr>
                            <tr> <td><code>## Titlu 2</code></td> <td> <h2>Titlu 2</h2> </td> </tr>
                            <tr> <td><code>### Titlu 3</code></td> <td> <h3>Titlu 3</h3> </td> </tr>
                            <tr> <td><code>#### Titlu 4</code></td> <td> <h4>Titlu 4</h4> </td> </tr>
                            <tr> <td><code>##### Titlu 5</code></td> <td> <h5>Titlu 5</h5> </td> </tr>
                            <tr> <td><code>###### Titlu 6</code></td> <td> <h6>Titlu 6</h6> </td> </tr>
                            <tr> <td><code>*Italic*</code></td> <td><em>Italic</em></td> </tr>
                            <tr> <td><code>**Bold**</code></td> <td><strong>Bold</strong></td> </tr>
                            <tr> <td><code>~~Tăiat~~</code></td> <td><del>Tăiat</del></td> </tr>
                            <tr> <td><code>`Cod`</code></td> <td><code>Cod</code></td> </tr>
                            <tr> <td>
<pre><code>* Item 1
* Item 2
    * Item 2a
    * Item 2b</code></pre>
                            </td> <td>
                                <ul>
                                    <li>Item 1</li>
                                    <li>Item 2 <ul><li>Item 2a</li><li>Item 2b</li></ul></li>
                                </ul></td> </tr>
                            <tr> <td>
<pre><code>1. Item 1
2. Item 2
   1. Item 2a
   2. Item 2b</code></pre>
                            </td> <td>
                                <ol>
                                    <li>Item 1</li>
                                    <li>Item 2 <ol><li>Item 2a</li><li>Item 2b</li></ol></li>
                                </ol></td> </tr>
                            <tr> <td><code>![Imagine](/images/logo.png)</code></td> <td><img src="/images/logo.png" alt="Imagine" style="height: 50px;"></td> </tr>
                            <tr> <td><code>[Link](/images/logo.png)</code></td> <td><a href="/images/logo.png">Link</a></td> </tr>
                            <tr> <td><code>---</code></td> <td><hr></td> </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="isHelpModalActive = false">Închide</button>
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
                automaticPreview: false,
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