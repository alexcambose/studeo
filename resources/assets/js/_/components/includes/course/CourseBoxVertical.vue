<template>
    <div :class="['card', 'course-box', course._joined ? 'course-joined' : '', small ? 'course-small' : '']">
        <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }" >
            <!--todo refactor-->
            <div class="card-image">
                <image-container class="course-image" :src="course._image.filename"></image-container>
                <div class="image-footer">
                    <b-tag type="is-dark" class="difficulty-tag">{{difficultyLabel}}</b-tag>
                    <div class="progress-container">
                        <progress v-if="course._joined && finishedPercent !== 100" class="progress is-small" :value="finishedPercent" max="100"></progress>
                        <b-tag v-if="finishedPercent === 100" type="is-success">Terminat</b-tag>
                    </div>
                    <b-tag type="is-dark" class="length-tag">{{length}}</b-tag>
                </div>
            </div>
        </router-link>

        <div class="course-box-header-buttons">
            <playlist-dropdown-button :course="course"></playlist-dropdown-button>
            <share-button v-if="!asShared" :course="course"></share-button>
            <!--<delete-button v-else :course="course"></delete-button>-->
        </div>

        <div class="card-content cp">
            <router-link :to="{ name: 'courseWelcome', params: { slug: course.slug } }" >
                <span class="course-title">{{course.id}} | {{course.title}}</span>

                <div class="course-content">
                    {{course.short_description}}
                </div>
                <user-box :user="course._user" size="is-small"></user-box>
            </router-link>
        </div>
    </div>
</template>
<script>
    import { percent, timeConvert } from '../../../../utils';
    import ImageContainer from '../../includes/dumb/ImageContainer.vue';
    import UserBox from '../../includes/dumb/UserBox.vue';
    import PlaylistDropdownButton from './PlaylistDropdownButton.vue';
    import ShareButton from './ShareButton.vue';
    import DeleteButton from './DeleteButton';
    export default {
        props: {
            course: {
                type: Object,
                required: true,
            },
            small: {
                type: Boolean,
                required: false,
            },
            asShared: {
                type: Boolean,
                default: false,
            },
        },
        computed: {
            difficultyLabel() {
                if (this.course.difficulty === 3) return 'Greu';
                if (this.course.difficulty === 2) return 'Mediu';
                return 'Ușor';
            },
            length() {
                const total = this.course._lessons.reduce((time, lesson) => time + lesson.length, 0);
                return timeConvert(total);
            },
            finishedPercent() {
                const finishedLessonsCount = this.course._lessons.filter(e => e._watched).length;
                return percent(finishedLessonsCount, this.course._lessons.length);
            },
        },
        components: {
            DeleteButton,
            ImageContainer,
            UserBox,
            ShareButton,
            PlaylistDropdownButton,
        },
    };
</script>