<template>
    <div>
        <div class="course-filters">
            <div class="course-filter-joined">
                <div class="field">
                    <b-switch v-model="filters.onlyRegistered" @input="resetCourses" type="is-info">
                        Înregistrat
                    </b-switch>
                </div>
            </div>

            <div class="course-filter-sorting">
                <dropdown :values="[
                        {
                          title: 'Data postării crescătoare',
                          subtitle: 'De la cel mai vechi până la cel mai nou curs',
                          icon: 'sort-numeric-asc',
                          value: 'date-asc'
                        },{
                          title: 'Data postării descrescătoare',
                          subtitle: 'De la cel mai nou până la cel mai vechi curs',
                          icon: 'sort-numeric-desc',
                          value: 'date-desc'
                        },
                        {
                          title: 'Alfabetic crescător',
                          subtitle: 'Ordine alfabetică crescătoare',
                          icon: 'sort-alpha-asc',
                          value: 'alph-asc'
                        },{
                          title: 'Alfabetic descrescător',
                          subtitle: 'Ordine alfabetică descrescătoare',
                          icon: 'sort-alpha-desc',
                          value: 'alph-desc'
                        }
                        ]" v-model="filters.sorting" :changed="resetCourses" label="Sortează după: "
                          class="is-pulled-right">
                    
                </dropdown>
            </div>


        </div>
        <div class="course-more-filters">
            <div :class="['show-more-content', moreFilters ? 'expanded' : '']">
                <course-tag-input v-model="filters.tags" @input="resetCourses" placeholder="Găsește doar cursurile care au conținutul comun"></course-tag-input>
                <b-field label="Autor">
                    <b-input v-model="filters.author" @input.native="resetCourses" placeholder="Numele autorului pe care vrei să îl cauți" expanded></b-input>
                </b-field>
                <div class="block">
                    <b-field label="Dificultate"></b-field>
                    <b-checkbox v-model="filters.difficulty" @input="resetCourses" native-value="1">
                        Ușor
                    </b-checkbox>
                    <b-checkbox v-model="filters.difficulty" @input="resetCourses" native-value="2">
                        Mediu
                    </b-checkbox>
                    <b-checkbox v-model="filters.difficulty" @input="resetCourses" native-value="3">
                        Greu
                    </b-checkbox>
                </div>
            </div>
            <div class="course-show-more-filters">

                <hr>
                <button @click="moreFilters = !moreFilters" class="button is-small">Filtre avansate &nbsp;
                    <b-icon pack="fa" :icon="moreFilters ? 'angle-up' : 'angle-down'"></b-icon>
                </button>
            </div>

        </div>
        <div v-for="(courseGroup, index) in chunkArray(courses, 4)" :key="index" class="columns">
            <div class="column is-3" v-for="(course, index) in courseGroup" :key="index">
                <course-box-vertical :course="course"></course-box-vertical>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
            <span slot="no-more">Nu mai sunt cursuri de încărcat! :)</span>
        </infinite-loading>
    </div>
</template>
<script>
    import config from '../../../../config';
    import _ from 'lodash';
    import { chunkArray } from '../../../../utils';
    import CourseBoxVertical from './CourseBoxVertical.vue';
    import Dropdown from '../dumb/Dropdown.vue';
    import InfiniteLoading from 'vue-infinite-loading';
    import CourseTagInput from '../../includes/course/CourseTagInput.vue';

    export default {
        props: {
            search: {
                type: String,
            },
        },
        data: function() {
            const queryFilters = this.$route.query;
            let sorting = queryFilters['sortare'] || '';
            if (sorting !== 'alph-asc' && sorting !== 'alph-desc' && sorting !== 'date-asc' && sorting !== 'date-desc') sorting = 'date-asc';
            return {
                courses: [],
                loadIndex: 0,
                moreFilters: !!Object.keys(queryFilters).length,
                filters: {
                    author: queryFilters['autor'] || null,
                    tags: queryFilters['etichete'] || [],
                    difficulty: [...queryFilters['dificultate'] || []],
                    sorting: sorting,
                    onlyRegistered: !!queryFilters['inregistrat'] || false,
                },
            };
        },
        mounted() {
            this.getCourses();
        },
        methods: {
            chunkArray,
            infiniteHandler($state) {
                this.getCourses()
                    .then(courses => {
                        if (courses.length) {
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    });
            },
            getCourses() {
                return new Promise((resolve, reject) => {
                    axios.get(config.url.COURSE_ALL + this.$store.state.user.user.id, {
                        params: {
                            start: this.loadIndex,
                            end: config.course.loadAmount,
                            sort: this.filters.sorting,
                            onlyRegistered: this.filters.onlyRegistered,
                            author: this.filters.author,
                            difficulty: this.filters.difficulty,
                            tags: this.filters.tags,
                        },
                    }).then(({ data }) => {
                        if (data.courses.length) {
                            this.loadIndex += config.course.loadAmount;
                            data.courses.forEach(course => {
                                this.courses.push(course);
                            });
                            resolve(data.courses);
                        } else {
                            resolve(data.courses);
                        }
                    });
                });
            },
            resetCourses: _.debounce(function() {
                let queryObject = {};
                const { filters } = this;
                if (filters.sorting !== 'date-asc') queryObject['sortare'] = filters.sorting;
                if (filters.onlyRegistered) queryObject['inregistrat'] = '1';
                if (filters.author) queryObject['autor'] = filters.author;
                if (filters.difficulty) queryObject['dificultate'] = filters.difficulty;
                if (filters.tags) queryObject['eticheta'] = filters.tags;
                this.$router.push({ query: queryObject });

                this.courses = [];
                this.loadIndex = 0;
                this.$nextTick(() => {
                    this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                });
            }, 350),
        },
        components: {
            CourseTagInput,
            CourseBoxVertical,
            Dropdown,
            InfiniteLoading,
        },
    };
</script>