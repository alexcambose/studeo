<template>
    <div>
        <!-- TODO Wrong field<->input-->
        <b-field :label="label">
            <div>
                <b-field v-for="(field, index) in fields" :key="index">
                    <b-input
                            :value="fields[index]"
                            @input.native="setData($event, index)"
                            expanded
                    ></b-input>
                    <p class="control" v-if="fields.length > 1">
                        <button @click="deleteField(index)" class="button is-danger"><b-icon pack="fa" icon="trash" size="is-small"></b-icon></button>
                    </p>
                </b-field>
            </div>
        </b-field>

        <button @click="addField" class="button is-info" :disabled="!fields[fields.length-1] && fields.length > 1"><b-icon pack="fa" icon="plus" size="is-small"></b-icon> &nbsp; {{addFieldLabel}}</button>
    </div>
</template>
<script>
    export default {
        props: {
            label: String,
            addFieldLabel: {
                type: String,
                default: 'Adaugă câmp nou',
            },
            value: {
                type: Array,
                default: () => [],
            },
        },
        data() {
            return {
                fields: [...this.value],
            };
        },
        methods: {
            addField() {
                this.fields.push('');
            },
            deleteField(index) {
                this.fields.splice(index, 1);
                this.emit();
            },
            setData(e, index) {
                this.fields.splice(index, 1, e.target.value);
                this.emit();
            },
            emit() {
                this.$emit('input', this.fields);
                this.$emit('change', this.fields);
            },
        },
    };
</script>