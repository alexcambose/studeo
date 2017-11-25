<template>
    <div>
        <div class="container mt-30 mb-30">
            <div class="columns playlists">
                <div class="column is-one-fifth leftside_playlists" style="margin: 0; padding: 0">
                    <aside class="menu">
                        <p class="menu-label">
                            Bibliotecă
                        </p>
                        <ul class="menu-list playlists-bar">
                            <li><a class="first">Dashboard</a></li>
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
                <div class="column rightside_playlists mb-5">
                    <div class="header">
                        <div class="playlist_title">
                            Pregatire mate
                        </div>
                        <div class="playlist_details">
                            <div class="nr_courses_lessons">
                                Cursuri: <strong>50</strong> &#149; Lectii: <strong>134</strong>
                            </div>
                            <div class="playlist_time">
                                Durata totala: <strong>48o 6m</strong>
                            </div>
                            <div class="playlist_description">
                                &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci aspernatur aut commodi corporis dicta distinctio impedit, inventore laudantium nam nemo non officiis provident quae, quas rem repellat rerum sunt tempora, temporibus totam veritatis voluptate? Aperiam deserunt facere, ipsum molestiae nihil pariatur quidem sint vitae. Aut corporis nostrum sint tempore.
                            </div>
                            <div class="playlist_progress mt-15">
                                <progress class="progress is-primary" value="15" max="100">30%</progress>
                            </div>
                        </div>
                    </div>
                    <div class="content mt-20">
                        <hr>
                        <div class="playlists_courses">
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
    import PlaylistCourse from './components/Playlist_courses.vue';
    export default {
        components: {
            'playlist_course': PlaylistCourse,
        },
    }
</script>