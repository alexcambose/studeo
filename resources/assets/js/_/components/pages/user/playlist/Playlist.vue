<template>
    <div v-if="!fetching">
        <b-modal :active.sync="isComponentModalActive" has-modal-card>
            <add-playlist></add-playlist>
        </b-modal>
        <b-modal :active.sync="isEditModalActive" has-modal-card>
            <edit-playlist></edit-playlist>
        </b-modal>
        <div class="container mt-30 mb-30">
            <div class="columns playlists">
                <div class="column is-one-fifth leftsidePlaylists" style="margin: 0; padding: 0">
                    <aside class="menu">
                        <p class="menu-label">
                            Bibliotecă
                        </p>
                        <ul class="menu-list playlistsBar">
                            <li @click="isComponentModalActive = true">
                                <a class="first">
                                    <i class="fa fa-plus"></i>&nbsp;
                                    Creează un nou playlist
                                </a>
                            </li>
                            <li v-for="item in playlists" @click="playlistId = item.id">
                                <router-link :to="{ name: 'playlist', params: { id: item.id } }">{{ item.title }}</router-link>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="column rightsidePlaylists mb-5">
                    <div class="hasId" v-if="playlistId">
                        <div class="header">
                            <div class="playlistDetails">
                                <div class="columns">
                                    <div class="column">
                                        <div class="playlistTitle" :style="{ color: playlist.color }">
                                            {{ playlist.title }}
                                        </div>
                                        <div class="nrCoursesLessons">
                                            Cursuri: <strong>{{ playlist._courses.length }}</strong> &#149; Lecții: <strong>{{ nrLessons }}</strong>
                                        </div>
                                        <div class="playlistTime">
                                            Durata totală: <strong>{{ totalDuration }}</strong>
                                        </div>
                                    </div>
                                    <div class="column is-one-quarter">
                                        <div class="box">
                                            <ul class="playlistActions">
                                                <li><a @click="isEditModalActive = true" :style="{ color: playlist.color }"><i class="fa fa-edit"></i>&nbsp; <span>Editează playlistul</span></a></li>
                                                <li><router-link :to="{ name: 'courseLesson', params: { slug: firstUnwatchedLesson } }" aria-disabled="" :style="{ color: playlist.color }"><i class="fa fa-eye"></i>&nbsp; <span>Vezi playlistul</span></router-link></li>
                                                <li><a @click="removePlaylist" :style="{ color: playlist.color }"><i class="fa fa-trash"></i>&nbsp; <span>Șterge playlistul</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="playlistDescription">
                                    {{ playlist.description }}
                                </div>
                                <div class="playlistProgress mt-15">
                                    <custom-progress :color="playlist.color" :percentage="playlistProgress"></custom-progress>
                                </div>
                            </div>
                        </div>
                        <div class="content mt-20">
                            <hr>
                            <div v-if="playlist._courses.length == 0" class="has-text-centered">
                                <h3>Adauga cursuri la playlist</h3>
                                <p>Apasă pe <i class="fa fa-plus"></i> pentru a adăuga cursul dorit la playlist. Pe aceasta pagină iți poți customiza playlistul.</p>
                            </div>
                            <div class="playlistsCourses" v-for="course in playlist._courses">
                                <course-box-horizontal :course="course" :inPlaylist="true" :playlistIndex="playlistIndex"></course-box-horizontal>
                            </div>
                        </div>
                    </div>
                    <div class="addPlaylistBoxContainer" v-else>
                        <b-tooltip
                                label="Adaugă un playlist"
                                :animated="true"
                        >
                            <div class="box addPlaylistBox" @click="isComponentModalActive = true">
                                <div class="add">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                        </b-tooltip>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CourseBoxHorizontal from '../../../includes/course/CourseBoxHorizontal.vue';
    import AddPlaylist from './components/AddPlaylist.vue';
    import { mapState, mapActions } from 'vuex';
    import { timeConvert } from '../../../../../utils';
    import EditPlaylist from './components/EditPlaylist';
    import CustomProgress from '../../../includes/dumb/CustomProgress';
    import Refresh from '../../../includes/dumb/Refresh';

    export default {
        mounted() {
            const loadingComponent = this.$loading.open();
            this.fetching = true;
            this.$store.dispatch('getAllPlaylists')
                .then(() => {
                    this.getPlaylistById(parseInt(this.$route.params.id));
                    this.playlistId = this.$route.params.id;
                    this.fetching = false;
                    loadingComponent.close();
                });
        },
        data() {
            return {
                isComponentModalActive: false,
                playlist: {},
                playlistId: null,
                isEditModalActive: false,
                fetching: false,
            };
        },
        computed: {
            ...mapState({
                playlists: state => state.playlist.playlists,
            }),
            nrLessons() {
                return this.playlist._courses.reduce((sum, course) => sum + course._lessons.length, 0);
            },
            totalDuration() {
                let totalDuration = this.playlist._courses
                    .reduce((total, course) => {
                        return total + course._lessons.reduce((seconds, lesson) => seconds + lesson.length, 0);
                    }, 0);
                return timeConvert(totalDuration);
            },
            playlistIndex() {
                return this.$store.state.playlist.playlists.findIndex(e => e.id == this.$route.params.id);
            },
            playlistProgress() {
                let progresses = this.playlist._courses.map(x => {
                    let watchedLessons = x._lessons.filter(e => e._watched).length;
                    return watchedLessons / x._lessons.length * 100;
                });
                let sum = progresses.reduce((sum, order) => sum + order, 0);

                return sum/progresses.length + '%';
            },
            firstUnwatchedLesson() {
                if (this.playlist._courses.length > 0) {
                    let lessons = this.playlist._courses.map(x => {
                        return x._lessons;
                    });
                    let lesson = lessons[0].find(x => {
                        if (x._watched === false) {
                            return x;
                        }
                    });
                    let courseId = 0;
                    if (lesson !== undefined) {
                        courseId = lesson.course_id;
                    }
                    if (courseId !== 0) {
                        let course = this.playlist._courses.find(e => {
                            if (e.id === courseId) {
                                return e;
                            }
                        });
                        return course.slug;
                    } else if ( this.playlistProgress == '100%' ) {
                        this.$toast.open('Ai terminat toate cursurile din acest playlist.');
                        return this.playlist._courses[0].slug;
                    }
                }
            },
        },
        watch: {
            '$route.params.id'() {
                this.playlistId = parseInt(this.$route.params.id);
                this.getPlaylistById(this.playlistId);
            },
        },
        methods: {
            ...mapActions(['deletePlaylist']),
            removePlaylist() {
                this.$dialog.confirm({
                    title: 'Ștergere playlist',
                    message: `Ești sigur că vrei să stergi <strong>${this.playlist.title}</strong> ?`,
                    confirmText: 'Șterge',
                    cancelText: 'Anulează',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        this.deletePlaylist({ playlistIndex: this.playlistIndex })
                            .then(() => this.$toast.open('Playlistul a fost șters') );
                    },
                });
            },
            getPlaylistById($id) {
                this.playlist = this.playlists.find(e => e.id === $id);
            },
        },
        components: {
            CourseBoxHorizontal,
            AddPlaylist,
            EditPlaylist,
            CustomProgress,
            Refresh,
        },
    };
</script>

<style scoped>
    .is-exact-active {
        color: #00d1b2 !important;
    }
</style>