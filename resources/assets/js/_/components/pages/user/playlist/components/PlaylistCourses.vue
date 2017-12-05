<template>
    <div>
        <div class="box courseBox">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-96x96">
                        <img :src="course._image.filename" :alt="course._image.comment">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>{{ course._user.first_name }} {{ course._user.last_name }}</strong> <router-link :to="{name: 'profile', params: { username: course._user.username }}">@{{ course._user.username }}</router-link><small></small> <small>5o 30m</small>
                            <br>
                            {{ course.short_description }}
                        </p>
                    </div>
                    <nav class="level is-mobile">
                        <div class="level-left">
                           <progress class="progress is-primary is-small" value="15" max="100"></progress>
                        </div>
                    </nav>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    import { fullname } from '../../../../../../utils';

    export default {
        props:['course'],
    }
</script>