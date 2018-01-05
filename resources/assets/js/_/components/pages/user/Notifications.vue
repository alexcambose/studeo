<template>
    <div class="container content-lower">
        <div class="notification-action-header">
            <div class="data">
                <b-switch v-model="onlyUnread" size="is-medium">
                    Doar notificările necitite
                </b-switch>
            </div>
            <div class="actions">
                <refresh @click.native="refresh" :fetching="refreshing" class="is-rounded mr-10"/>
                <span @click="readAll"
                      v-if="notifications.length"
                      :class="['button', (fetchingToggleReadAll ? 'is-loading' : ''), (!unreadNotificationsCount ? 'is-success' : ['is-info', 'is-outlined'])]" >
                    Marchează toate ca {{!unreadNotificationsCount ? 'ne' : ''}}citite &nbsp; <b-icon pack="fa" icon="check" size="is-small"></b-icon>
                </span>
            </div>
        </div>

        <hr>
        <notifications :notifications="notifications"></notifications>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import Notifications from '../../includes/navbar/notification/Notifications';
    import Refresh from '../../includes/dumb/Refresh';

    export default {
        data() {
            return {
                fetchingToggleReadAll: false,
                refreshing: false,
            };
        },
        computed: {
            ...mapGetters(['notifications']),
            unreadNotificationsCount () {
                return this.$store.state.notification.unreadNotificationsCount;
            },
            onlyUnread: {
                get () {
                    return this.$store.state.notification.onlyUnread;
                },
                set (value) {
                    this.$store.dispatch('setOnlyUnreadNotification', value);
                },
            },
        },
        methods: {
            ...mapActions(['toggleReadAllNotifications', 'getNotification']),
            readAll() {
                this.fetchingToggleReadAll = true;
                this.toggleReadAllNotifications()
                    .then(() => this.fetchingToggleReadAll = false);
            },
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