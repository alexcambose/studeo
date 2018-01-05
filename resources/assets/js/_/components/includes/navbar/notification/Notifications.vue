<template>
    <div>
        <notification-item v-for="notification in notifications" :key="notification.id" :notification="notification"/>
        <infinite-loading v-if="infinite" @infinite="infiniteHandler">
            <span slot="no-more">Nu mai sunt notificări</span>
        </infinite-loading>
    </div>

</template>


<script>
    import NotificationItem from './NotificationItem';
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        props: {
            infinite: {
                type: Boolean,
                default: true,
            },
        },
        computed: {
            notifications() {
                return this.$store.getters.notifications;
            },
        },
        methods: {
            infiniteHandler($state) {
                this.$store.dispatch('getNotification', true)
                    .then(() => {
                        if (this.notifications.length < this.$store.state.notification.notificationsCount) $state.loaded();
                        else $state.complete();
                    });
            },
        },
        components: {
            NotificationItem,
            InfiniteLoading,
        },
    };
</script>