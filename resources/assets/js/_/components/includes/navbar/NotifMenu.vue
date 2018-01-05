<template>
    <div>
        <div class="search-container">
            <b-switch v-model="onlyUnread">
                Doar notficările necitite
            </b-switch>
            <refresh @click.native="refresh" size="is-small" :fetching="refreshing" class="is-rounded is-pulled-right"/>
        </div>
        <div v-if="!notifications.length" class="notification-item no-hover">
            Nici o notificare
        </div>
        <div class="notification-container" v-else>
            <notifications :infinite="false"/>
            <div class="notification-item no-hover">
                <router-link :to="{name: 'notifications'}" >Vezi toate notificările</router-link>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex';
    import Notifications from './notification/Notifications.vue';
    import Refresh from '../dumb/Refresh.vue';
    export default {
        computed: {
            ...mapGetters(['notifications']),
            onlyUnread: {
                get () {
                    return this.$store.state.notification.onlyUnread;
                },
                set (value) {
                    this.$store.dispatch('setOnlyUnreadNotification', value);
                },
            },
        },
        data() {
            return {
                refreshing: false,
            };
        },
        methods: {
            ...mapActions(['getNotification']),
            refresh() {
                this.refreshing = true;
                this.getNotification()
                    .then(() => this.refreshing = false)
                    .catch(() => this.refreshing = false);
            },
        },
        components: {
            Notifications,
            Refresh,
        },
    };
</script>