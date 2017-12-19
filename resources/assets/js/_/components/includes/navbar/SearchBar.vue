<template>
    <b-field v-bind="$attrs">
        <b-autocomplete
                v-model="query"
                @input="fetchResults"
                placeholder="Caută..."
                :keep-first="true"
                :data="filteredData"
                field="title"
                type="search"
                icon="magnify"
                :loading="loading"
                @select="option => selected = option">
                <template slot-scope="props">
                    <div class="media">
                        <div class="media-left">
                            <image-container :src="props.option._image.filename" style="width: 64px;height: 64px;"></image-container>
                        </div>
                        <div class="media-content">
                            <strong class="title is-6">{{ props.option.title }}</strong>
                            <br>
                            <p style="white-space: normal; font-size: .9em;">{{ props.option.short_description }}</p>
                        </div>
                    </div>
                </template>
        </b-autocomplete>
    </b-field>
</template>

<script>
    import config from '../../../../config';
    import _ from 'lodash';
    import ImageContainer from '../../includes/dumb/ImageContainer.vue';
    export default {
        data() {
            return {
                query: '',
                loading: false,
                filteredData: [],
            };
        },
        methods: {
            fetchResults: _.debounce(function () {
                this.loading = true;
                axios.get(config.url.COURSE_FIND + this.query)
                    .then(({ data }) => {
                        this.loading = false;
                        this.filteredData = data.courses;
                    });
            }, 600),
        },
        components: {
            ImageContainer,
        },
    };
</script>

<style scoped>

</style>