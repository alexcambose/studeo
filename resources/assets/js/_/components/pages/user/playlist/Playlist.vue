<template>
    <div>
        <add-course v-if="showModal" :active="showModal"></add-course>
        <div class="container mt-30 mb-30">
            <div class="columns playlists">
                <div class="column is-one-fifth leftsidePlaylists" style="margin: 0; padding: 0">
                    <aside class="menu">
                        <p class="menu-label">
                            Bibliotecă
                        </p>
                        <ul class="menu-list playlistsBar">
                            <li @click="showModal = true "><a class="first"><i class="fa fa-plus"></i>&nbsp; Creeaza un nou playlist</a></li>
                            <li><a>Customers</a></li>
                            <li><a>Customers</a></li>
                            <li><a>Customers</a></li>
                            <li><a>Customers</a></li>
                            <li><a>Customers</a></li>
                            <li><a>Customers</a></li>
                            <li><a>Customers</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column rightsidePlaylists mb-5">
                    <div class="header">
                        <div class="playlistDetails">
                            <div class="columns">
                                <div class="column">
                                    <div class="playlistTitle">
                                        Pregatire mate
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
                                &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci aspernatur aut commodi corporis dicta distinctio impedit, inventore laudantium nam nemo non officiis provident quae, quas rem repellat rerum sunt tempora, temporibus totam veritatis voluptate? Aperiam deserunt facere, ipsum molestiae nihil pariatur quidem sint vitae. Aut corporis nostrum sint tempore.
                            </div>
                            <div class="playlistProgress mt-15">
                                <progress class="progress is-primary" value="15" max="100">30%</progress>
                            </div>
                        </div>
                    </div>
                    <div class="content mt-20">
                        <hr>
                        <div class="playlistsCourses">
                            <playlist_course></playlist_course>
                            <playlist_course></playlist_course>
                            <playlist_course></playlist_course>
                            <playlist_course></playlist_course>
                            <playlist_course></playlist_course>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PlaylistCourse from './components/PlaylistCourses.vue';
    import AddCourse from './components/AddCourse.vue';

    export default {
        components: {
            'playlist_course': PlaylistCourse,
            'add-course': AddCourse,
        },
        data() {
            return {
                showModal: false,
            }
        }
    };
</script>