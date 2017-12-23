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
        props: {},
        mounted() {
            axios.get(config.url.COURSE_TAGS)
                .then(({ data }) => {
                    this.availableTags = data.tags;
                    this.filteredTags = data.tags;
                });
        },
        data() {
            return {
                tags: [],
                availableTags: [],
                filteredTags: [],
            };
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
    }
</script>