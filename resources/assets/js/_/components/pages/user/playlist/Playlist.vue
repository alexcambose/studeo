<template>
    <div>
        <b-modal :active.sync="isComponentModalActive" has-modal-card>
            <add-playlist></add-playlist>
        </b-modal>
        <div class="container mt-30 mb-30">
            <div class="columns playlists">
                <div class="column is-one-fifth leftsidePlaylists" style="margin: 0; padding: 0">
                    <aside class="menu">
                        <p class="menu-label">
                            Bibliotecă
                        </p>
                        <ul class="menu-list playlistsBar">
                            <li @click="isComponentModalActive = true"><a class="first"><i class="fa fa-plus"></i>&nbsp; Creeaza un nou playlist</a></li>
                            <li v-for="item in playlists" @click="playlistId = item.id" ><router-link :to="{ name: 'playlist', params: { id: item.id } }">{{ item.title }}</router-link></li>
                        </ul>
                    </aside>
                </div>
                <div class="column rightsidePlaylists mb-5">
                    <div class="hasId" v-if="playlistId">
                        <div class="header">
                            <div class="playlistDetails">
                                <div class="columns">
                                    <div class="column">
                                        <div class="playlistTitle">
                                            {{ playlist.title }}
                                        </div>
                                        <div class="nrCoursesLessons">
                                            Cursuri: <strong>{{ playlist._courses.length }}</strong> &#149; Lectii: <strong>{{ nrLessons }}</strong>
                                        </div>
                                        <div class="playlistTime">
                                            Durata totala: <strong>48o 6m</strong>
                                        </div>
                                    </div>
                                    <div class="column is-one-quarter">
                                        <div class="box">
                                            <ul class="playlistActions">
                                                <li><a href=""><i class="fa fa-edit"></i>&nbsp; <span>Editeaza playlistul</span></a></li>
                                                <li><a href=""><i class="fa fa-eye"></i>&nbsp; <span>Vezi playlistul</span></a></li>
                                                <li><a href=""><i class="fa fa-trash"></i>&nbsp; <span>Sterge playlistul</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="playlistDescription">
                                   {{ playlist.description }}
                                </div>
                                <div class="playlistProgress mt-15">
                                    <progress class="progress is-primary" value="15" max="100">30%</progress>
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
                                <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }"><playlist-course :course="course"></playlist-course></router-link>
                            </div>
                        </div>
                    </div>
                    <div class="addPlaylistBoxContainer" v-else>
                        <b-tooltip
                                label="Adaugă un curs"
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
    import PlaylistCourse from './components/PlaylistCourses.vue';
    import AddPlaylist from './components/AddPlaylist.vue';
    import { mapState } from 'vuex';
    import store from '../../../../store/index';
    import config from '../../../../../config';
    export default {
        mounted() {
            axios.post(config.url.PLAYLISTS)
                .then(({ data }) => {
                    store.dispatch('getAllPlaylists', data);
                    this.getPlaylistById(this.playlistId);
                });
        },

        data() {
            return {
                isComponentModalActive: false,
                playlist: {},
                playlistId: null,
            };
        },
        computed: {
            ...mapState({
                playlists: state => state.playlist.playlists,
            }),
            // nrLessons() {
            //     let nrLessons = 0;
            //     this.playlist._courses.forEach(e => {
            //         nrLessons += e.lessons.length;
            //     });
            //     return nrLessons;
            // }
        },
        watch: {
            '$route.params.id'() {
                this.playlistId = parseInt(this.$route.params.id);
                this.getPlaylistById(this.playlistId);
            },
        },
        methods: {
            getPlaylistById($id) { // poti sa il pui in getters daca vrei
                this.playlist = this.playlists.find(e => e.id === $id);
            },
        },
        components: {
            PlaylistCourse,
            AddPlaylist,
        },
    };
</script>
