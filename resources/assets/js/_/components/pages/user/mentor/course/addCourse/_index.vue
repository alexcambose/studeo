<template>
    <div class="container container-lower">
        <div class="columns">
            <div class="column is-4">
                <nav class="panel">
                    <p class="panel-heading">
                        <i class="fa fa-info-circle"></i>
                        Informații curs
                    </p>
                    <router-link :to="{name: 'dashboard-add-course-informations-general'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-file-text-o"></i>
                        </span>
                        Informații generale
                    </router-link>
                    <router-link :to="{name:'dashboard-add-course-informations-purpose'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-question-circle"></i>
                        </span>
                        Scopul cursului
                    </router-link>
                    <router-link :to="{name:'dashboard-add-course-informations-target'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-bullseye"></i>
                        </span>
                        Publicul țintă
                    </router-link>
                </nav>

                <nav class="panel">
                    <p class="panel-heading">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        Lecții
                    </p>
                    <router-link v-for="lesson in lessons" :key="lesson.id" :to="{name:'dashboard-add-course-lesson', params: {id: lesson.id}}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-bullseye"></i>
                        </span>
                        {{lesson.title}}
                    </router-link>
                    <div class="panel-block">
                        <form @submit="addNewLesson" class="is-fullwidth">
                            <b-field>
                                <b-input
                                        type="text"
                                        v-model="newLessonTitle"
                                        maxlength="40"
                                        minlength="10"
                                        required
                                        placeholder="Apasă enter pentru a adăuga o lecție nouă"
                                ></b-input>
                            </b-field>
                        </form>
                    </div>
                </nav>
            </div>
            <div class="column is-8">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';

    export default {
        computed: {
            ...mapState({
                lessons: state => state.newCourse.lessons,
            }),
        },
        data() {
            return {
                newLessonTitle: '',
            };
        },
        methods: {
            addNewLesson() {
                this.$store.dispatch('addNewLesson', {
                    title: this.newLessonTitle,
                });
                this.newLessonTitle = '';
            },
        },
    };
</script>