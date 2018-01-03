<template>
    <div class="container content-lower">
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
                        <i class="fa fa-columns"></i>
                        Lecții - {{newLessons.length}}
                    </p>
                    <router-link v-for="lesson in newLessons" :key="lesson.id" :to="{name:'dashboard-add-course-lesson', params: {id: lesson.id}}" class="panel-block">
                        <div style="flex: 1;">
                            <span v-if="lesson.title">{{lesson.title}}</span>
                            <span v-else class="has-text-danger has-text-weight-semibold"><em>Fără titlu</em></span>
                        </div>
                        <div>
                            <UpDownArrows :lesson_id="lesson.id" class="mr-5"></UpDownArrows>
                        </div>
                        <button @click="deleteLesson($event, lesson.id)" class="button is-small is-danger"><b-icon pack="fa" icon="trash"></b-icon></button>
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
                <router-link :to="{name: 'dashboard-add-course-final'}" class="button is-info is-fullwidth">Finalizează</router-link>
            </div>
            <div class="column is-8">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import UpDownArrows from './components/UpDownArrows';
    export default {
        computed: {
            ...mapGetters(['newLessons']),
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
            deleteLesson(e, id) {
                e.preventDefault();
                const index = this.newLessons.findIndex(e => e.id === id);
                console.log(this.newLessons[index - 1]);
                if (this.newLessons[index - 1]) {
                    this.$router.push({
                        name: 'dashboard-add-course-lesson',
                        params: { id: this.newLessons[index - 1].id },
                    });
                } else if (this.newLessons[index + 1]) {
                    this.$router.push({
                        name: 'dashboard-add-course-lesson',
                        params: { id: this.newLessons[index + 1].id },
                    });
                } else {
                    this.$router.push({
                        name: 'dashboard-add-course-informations-general',
                    });
                }
                this.$store.dispatch('deleteLesson', id);
            },
        },
        components: {
            UpDownArrows,
        },
    };
</script>