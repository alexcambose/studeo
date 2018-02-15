<template>
    <div>
        <h3 class="fullname">{{ fullname }}</h3>
        <router-link :to="{ name: 'profile', params: {username: user.username}}" class="username-link">
            @{{ user.username }}
        </router-link>
        <div class="description" v-if="description" v-html="description"></div>
        <div class="user-info-container">
            <div v-for="item in userInfo" class="user-info-item">
                <b-icon :pack="item.iconPack" :icon="item.icon"></b-icon>
                {{ item.content }}
            </div>
        </div>
        <hr v-if="this.user.id === $store.state.user.user.id">
    </div>
</template>

<script>
    import { cities, displayDate } from '../../../../../../utils';
    import { markdown } from 'markdown';
    import moment from 'moment';
    export default {
        props: {
            user: Object,
        },
        computed: {
            fullname() {
                return this.user.first_name + ' ' + this.user.last_name;
            },
            description() {
                if (this.user.description) return markdown.toHTML(this.user.description);
            },
            userInfo() {
                const { city, birthday, school, created_at } = this.user;
                const data = {
                    city: { iconPack: 'mdi', icon: 'city', content: cities[city] },
                    birthday: { iconPack: 'fa', icon: 'birthday-cake', content: `Născut la ${displayDate(birthday)}` },
                    school: { iconPack: 'fa', icon: 'building', content: school },
                    role: { iconPack: 'fa', icon: 'star', content: 'Mentor' },
                    is_teacher: { iconPack: 'fa', icon: 'graduation-cap', content: 'Profesor' },
                    created_at: { iconPack: 'fa', icon: 'calendar-check-o', content: ` S-a alăturat cu ${moment(created_at).fromNow() }` },
                };
                return Object.keys(data).map(key => this.user[key] ? data[key] : null).filter(e => e);
            },
        },
    };
</script>