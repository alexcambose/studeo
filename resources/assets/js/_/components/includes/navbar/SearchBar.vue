<template>
    <b-field v-bind="$attrs" class="search-bar">
        <b-autocomplete
                v-model="search"
                @input="fetchResults"
                placeholder="Caută..."
                :keep-first="true"
                :data="filteredData"
                field="title"
                type="search"
                icon="magnify"
                :loading="loading"
                @select="onSelected">
            <template slot-scope="props">
                <div class="columns">
                    <div :class="['column', props.option._joined ? 'is-11' : 'is-12']">
                        <div class="media">
                            <div class="media-left">
                                <image-container :src="props.option._image.filename" style="width: 64px;height: 64px;"></image-container>
                            </div>
                            <div class="media-content">
                                <strong class="title is-6" >{{ props.option.title }}</strong>
                                <br>
                                <p class="course-description">{{ props.option.short_description }}</p>
                            </div>
                        </div>
                    </div>
                    <div v-if="props.option._joined" class="column is-1 flex-center">
                        <b-tag type="is-success" class="is-pulled-right">Înscris</b-tag>
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
                search: '',
                loading: false,
                filteredData: [],
            };
        },
        methods: {
            fetchResults: _.debounce(function () {
                this.loading = true;
                axios.get(config.url.COURSE_ALL, { params: { search: this.search } })
                    .then(({ data }) => {
                        this.loading = false;
                        this.filteredData = data.courses;
                    });
            }, 600),
            onSelected(course) {
                if (course) this.$router.push({ name: 'courseWelcome', params: { slug: course.slug }});
            },
        },
        components: {
            ImageContainer,
        },
    };
</script>

<style scoped>
    .columns {
        width: 700px;
    }
    .media-content {
        white-space: normal;
    }
    .course-description {
        font-size: .8rem;
    }
    .dropdown-item {
        padding: 0;
    }
</style>