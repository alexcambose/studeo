<template>
    <b-field label="Etichete">
        <b-taginput
                :value="tags"
                @input="changedTags"
                :data="filteredTags"
                autocomplete
                field="label"
                maxtags="16"
                icon="label"
                v-bind="$attrs"
                @typing="getFilteredTags">
        </b-taginput>
    </b-field>
</template>

<script>
    import config from '../../../../config';

    export default {
        props: {
            value: Array,
        },
        mounted() {
            axios.get(config.url.COURSE_TAGS)
                .then(({ data }) => {
                    this.availableTags = data.tags;
                    this.tags = data.tags.filter(tag => !!this.value.find(e => tag.id === parseInt(e)));
                    this.filteredTags = data.tags;
                });
        },
        data() {
            return {
                tags: this.value,
                availableTags: [],
                filteredTags: [],
            };
        },
        watch: {
            value(value) {
                // this.tags = value.map(tag => this.availableTags.filter(e => parseInt(tag) === e.id)); todo daca e nevoie
            },
        },
        methods: {
            changedTags(value) {
                this.tags = value;
                this.$emit('input', this.tags.map(e => e.id));
            },
            getFilteredTags(text) {
                this.filteredTags = this.availableTags.filter(option => {
                    return option.label
                        .toString()
                        .toLowerCase()
                        .indexOf(text.toLowerCase()) >= 0;
                });
            },
        },
    };
</script>