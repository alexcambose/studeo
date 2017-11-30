<template>
    <div>
        {{ getCurrentPlaylist }}
        <add-playlist v-if="showModal" :active="showModal" @close="showModal = false"></add-playlist>
        <div class="container mt-30 mb-30">
            <div class="columns playlists">
                <div class="column is-one-fifth leftsidePlaylists" style="margin: 0; padding: 0">
                    <aside class="menu">
                        <p class="menu-label">
                            Bibliotecă
                        </p>
                        <ul class="menu-list playlistsBar">
                            <li @click="showModal = true "><a class="first"><i class="fa fa-plus"></i>&nbsp; Creeaza un nou playlist</a></li>
                            <li v-for="item in playlists"><router-link :to="{ name: 'playlist', params: { id: item.id } }">{{ item.title }}</router-link></li>
                        </ul>
                    </aside>
                </div>
                <div class="column rightsidePlaylists mb-5">
                    <div class="header">
                        <div class="playlistDetails">
                            <div class="columns">
                                <div class="column">
                                    <div class="playlistTitle">
                                        {{ this.playlist.title }}
                                    </div>
                                    <div class="nrCoursesLessons">
                                        Cursuri: <strong>50</strong> &#149; Lectii: <strong>134</strong>
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
                               {{ this.playlist.description }}
                            </div>
                            <div class="playlistProgress mt-15">
                                <progress class="progress is-primary" value="15" max="100">30%</progress>
                            </div>
                        </div>
                    </div>
                    <div class="content mt-20">
                        <hr>
                        <div class="playlistsCourses">
                            <playlist-course></playlist-course>
                            <playlist-course></playlist-course>
                            <playlist-course></playlist-course>
                            <playlist-course></playlist-course>
                            <playlist-course></playlist-course>
                        </div>
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

    export default {
        data() {
            return {
                showModal: false,
                playlist: '',
            };
        },
        computed: {
            ...mapState({
                playlists: state => state.playlist.playlists,
            }),
            getCurrentPlaylist() {
                let arr = this.playlists;
                let id = this.$route.params.id;
                let playlist = '';
                Object.keys(arr).forEach(function(x) {
                    if (arr[x].id == id) {
                        playlist = arr[x];
                    }
                });
                this.playlist = playlist;
            },
        },
        components: {
            PlaylistCourse,
            AddPlaylist,
        },
    };
</script>