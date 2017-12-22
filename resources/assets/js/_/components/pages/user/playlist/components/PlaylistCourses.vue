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
                    <b-tooltip label="Elimină cursul din playlist" animated>
                        <i class="fa fa-minus"></i>
                    </b-tooltip>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['course'],
    }
</script>

