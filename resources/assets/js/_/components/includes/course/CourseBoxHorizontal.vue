<template>
    <div>
        <div class="box courseBox">
            <div class="columns">
                <div class="column is-one-fifth thumbnail" :style="{backgroundImage: 'url(' + course._image.filename + ')'}"></div>
                <div class="column is-three-quarters">
                    <strong>{{ course.title }}</strong> <router-link :to="{name: 'profile', params: { username: course._user.username }}">@{{ course._user.username }}</router-link>
                    <p class="content contentMediaPlaylist">{{ course.short_description }}</p>
                    <progress class="progress is-primary progressBox" value="15" max="90" style="width: 30%; height: 5px"></progress>
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
                        <playlist-dropdown-button :course="course"></playlist-dropdown-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PlaylistDropdownButton from './PlaylistDropdownButton';
    import { mapActions } from 'vuex';
    export default {
        props: ['course', 'inPlaylist', 'playlistIndex'],
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


