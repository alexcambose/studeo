<template>
    <div>
        <div class="search-container">
            <b-switch v-model="onlyUnread">
                Doar notficările necitite
            </b-switch>
            <refresh @click.native="refresh" size="is-small" :loading="refreshing" class="is-rounded is-pulled-right"/>
        </div>
        <div v-if="!notifications.length" class="notification-item">
            Nicio notificare
        </div>
        <div class="notification-container" v-else>
            <notifications :notifications="notifications"></notifications>
        </div>
    </div>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex';
    import Notifications from './notification/Notifications';
    import Refresh from '../dumb/Refresh';
    export default {
        computed: {
            ...mapGetters(['notifications']),
            onlyUnread: {
                get () {
                    return this.$store.state.notification.onlyUnread;
                },
                set (value) {
                    this.$store.dispatch('setOnlyUnreadNotification', value)
                }
            }
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
            }
        },
        components: {
            Notifications,
            Refresh,
        },
    }
</script>