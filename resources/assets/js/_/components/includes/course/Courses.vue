<template>
    <div>
        <div class="course-filters">
            <div class="course-display">
                <div class="field has-addons">
                    <p class="control">
                        <b-tooltip label="Afișare in poziție verticală" size="is-small" animated>
                            <button @click="setDisplay(true)" :class="['button', displayVertical ? 'is-primary' : '']">
                                <b-icon icon="reorder-vertical"></b-icon>
                            </button>
                        </b-tooltip>
                    </p>
                    <p class="control">
                        <b-tooltip label="Afișare in poziție orizontală" size="is-small" position="is-bottom" animated>
                            <button @click="setDisplay(false)" :class="['button', displayVertical ? '' : 'is-primary']">
                                <b-icon icon="reorder-horizontal"></b-icon>
                            </button>
                        </b-tooltip>
                    </p>

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
                        ]" v-model="filters.sorting" :changed="resetCourses" label="Sortează după: ">

                </dropdown>

            </div>

        </div>
        <div class="course-more-filters">
            <div :class="['show-more-content', moreFilters ? 'expanded' : '']">
                <b-field class="field">
                    <b-switch v-model="filters.onlyRegistered" @click.native="resetCourses" type="is-info">
                        Înregistrat
                    </b-switch>
                </b-field>

                <b-field label="Categorie">
                    <b-select v-model="filters.category" @input="resetCourses" placeholder="Selectează o categorie" expanded>
                        <option
                                v-for="option in MATERII"
                                :value="option.slug"
                                :key="option.id">
                            {{ option.name }}
                        </option>
                    </b-select>
                </b-field>

                <course-tag-input v-model="filters.tags" @input="resetCourses" placeholder="Găsește doar cursurile care au conținutul comun"></course-tag-input>
                <b-field label="Autor">
                    <b-input v-model="filters.author" @input.native="resetCourses" placeholder="Numele autorului pe care vrei să îl cauți" expanded></b-input>
                </b-field>
                <div class="block">
                    <b-field label="Dificultate"></b-field>
                    <b-checkbox v-model="filters.difficulty" @click.native="resetCourses" native-value="1">
                        Ușor
                    </b-checkbox>
                    <b-checkbox v-model="filters.difficulty" @click.native="resetCourses" native-value="2">
                        Mediu
                    </b-checkbox>
                    <b-checkbox v-model="filters.difficulty" @click.native="resetCourses" native-value="3">
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
        <div v-if="displayVertical" v-for="(courseGroup, index) in chunkArray(courses, 4)"  :key="index" class="columns">
            <div class="column is-3" v-for="course in courseGroup" :key="course.id">
                <course-box-vertical :course="course"></course-box-vertical>
            </div>
        </div>
        <div v-else v-for="(course, index) in courses" :key="index">
            <course-box-horizontal :course="course"></course-box-horizontal>
        </div>
        <infinite-loading @triggered="infiniteHandler" ref="infiniteLoading">
            <slot slot="fetching">Se accesează cursurile</slot>
            <slot slot="completed">Nu mai sunt cursuri</slot>
        </infinite-loading>
    </div>
</template>
<script>
    import config from '../../../../config';
    import _ from 'lodash';
    import { chunkArray, MATERII } from '../../../../utils';
    import CourseBoxVertical from './CourseBoxVertical.vue';
    import CourseBoxHorizontal from './CourseBoxHorizontal.vue';
    import Dropdown from '../dumb/Dropdown.vue';
    import InfiniteLoading from '../../includes/dumb/InfiniteLoading.vue';
    import CourseTagInput from '../../includes/course/CourseTagInput.vue';
    export default {
        props: {
            search: String,
            user: Object,
        },
        mounted() {
            this.updateFilters();
        },
        data: function() {
            return {
                MATERII,
                courses: [],
                startIndex: 0,
                moreFilters: false,
                initialFetch: true,
                displayVertical: localStorage.getItem('displayVertical') === 'true',
                filters: {
                    author: null,
                    category: null,
                    tags: [],
                    difficulty: [],
                    sorting: 'date-asc',
                    onlyRegistered: false,
                },
            };
        },
        watch: {
            '$route.query'() {
                this.updateFilters();
            },
        },
        methods: {
            chunkArray,
            infiniteHandler($state) {
                if (this.initialFetch) return;
                axios.get(config.url.COURSE_ALL + (this.user ? this.user.id : ''), {
                    params: {
                        start: this.startIndex,
                        amount: config.course.loadAmount,
                        sort: this.filters.sorting,
                        onlyRegistered: this.filters.onlyRegistered,
                        author: this.filters.author,
                        difficulty: this.filters.difficulty,
                        tags: this.filters.tags,
                    },
                }).then(({ data }) => {
                    if (data.courses.length) {
                        this.startIndex += config.course.loadAmount;
                        this.courses = [...this.courses, ...data.courses];
                        $state.fetched();
                    } else {
                        $state.completed();
                    }
                });
            },
            resetCourses: _.debounce(function() {
                let queryObject = {};
                const { filters } = this;
                if (filters.sorting !== 'date-asc') queryObject['sortare'] = filters.sorting;
                if (filters.onlyRegistered) queryObject['inregistrat'] = '1';
                if (filters.author) queryObject['autor'] = filters.author;
                if (filters.category) queryObject['categorie'] = filters.category;
                if (filters.difficulty) queryObject['dificultate'] = filters.difficulty;
                if (filters.tags) queryObject['eticheta'] = filters.tags;
                if (this.$router.query !== queryObject) {
                    this.$router.push({ query: queryObject });
                }
            }, 350),
            updateFilters() {
                const queryFilters = this.$route.query;
                let sorting = queryFilters['sortare'] || '';
                if (sorting !== 'alph-asc' && sorting !== 'alph-desc' && sorting !== 'date-asc' && sorting !== 'date-desc') sorting = 'date-asc';
                this.filters.author = queryFilters['autor'] || null;
                this.filters.category = queryFilters['categorie'] || null;
                this.filters.tags = (() => {
                    if (!queryFilters['eticheta']) return [];
                    if (typeof queryFilters['eticheta'] === 'object') {
                        return queryFilters['eticheta'];
                    } else {
                        return [queryFilters['eticheta']];
                    }
                })();
                this.filters.difficulty = [...queryFilters['dificultate'] || []];
                this.filters.sorting = sorting;
                this.filters.onlyRegistered = !!queryFilters['inregistrat'] || false;
                this.moreFilters = (queryFilters['inregistrat'] || queryFilters['categorie'] || queryFilters['autor'] || (queryFilters['eticheta'] && queryFilters['eticheta'].length) || (queryFilters['dificultate'] && queryFilters['dificultate'].length));
                this.courses = [];
                this.startIndex = 0;
                this.initialFetch = false;
                this.$refs.infiniteLoading.trigger();
            },
            setDisplay(isVertical) {
                localStorage.setItem('displayVertical', isVertical);
                this.displayVertical = isVertical;
            },
        },
        components: {
            CourseTagInput,
            CourseBoxVertical,
            CourseBoxHorizontal,
            Dropdown,
            InfiniteLoading,
        },
    };
</script>