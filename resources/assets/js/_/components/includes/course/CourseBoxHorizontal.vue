<template>
    <div>
        <div class="box courseBox">
            <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }" style="color: #4a4a4a">
                <div class="columns">
                    <div class="column is-one-fifth thumbnail" :style="{backgroundImage: 'url(' + course._image.filename + ')'}"></div>
                    <div class="column is-three-quarters">
                        <div class="titleMediaPlaylist">{{ course.title }}</div> <router-link :to="{name: 'profile', params: { username: course._user.username }}">@{{ course._user.username }}</router-link>
                        <p class="content contentMediaPlaylist">{{ course.short_description }}</p>
                        <progress class="progress is-primary progressBox" :value="progress" max="100" style="width: 30%; height: 5px; display: inline-block"></progress>
                    </div>
                    <div class="column actionsPlaylistCourse">
                        <div v-if="inPlaylist">
                            <b-tooltip label="Elimină cursul din playlist" animated>
                                <router-link :to="{ name: 'playlist', params: { id: course.pivot.playlist_id } }">
                                    <i class="fa fa-minus fa-2x deleteCourseFromPlaylistBtn" @click="removeCourseFromPlaylist"></i>
                                </router-link>
                            </b-tooltip>
                        </div>
                        <div v-else>
                            <router-link :to="{ name: 'courses' }">
                                <playlist-dropdown-button :course="course"></playlist-dropdown-button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
    import PlaylistDropdownButton from './PlaylistDropdownButton';
    import { mapState, mapActions, mapGetters } from 'vuex';
    export default {
        props: ['course', 'inPlaylist', 'playlistIndex'],
        computed: {
            progress () {
                let watchedLessons = this.course._lessons.filter(e => e._watched).length;
                let result = watchedLessons / this.course._lessons.length * 100;
                if (isNaN(result) || result == undefined) {
                    result = 0;
                }
                return result;
            },
        },
        methods: {
            ...mapActions(['deleteCoursePlaylist']),
            removeCourseFromPlaylist() {
                this.deleteCoursePlaylist({ playlistIndex: this.playlistIndex, courseId: this.course.id } )
                    .then(() => {
                        this.$toast.open('Cursul a fost șters din playlist');
                    });
            },
        },
        components: {
            PlaylistDropdownButton,
        },

    }
</script>


