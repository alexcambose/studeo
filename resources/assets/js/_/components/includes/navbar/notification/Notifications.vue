<template>
    <div>
        <ul>
            <notification-item v-for="notification in notifications" :key="notification.id" :notification="notification"/>
        </ul>
        <infinite-loading @infinite="infiniteHandler" v-if="end < notifications.length"/>
    </div>

</template>


<script>
    import NotificationItem from './NotificationItem';
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        computed: {
            notifications() {
                return this.$store.getters.notifications.slice(0, this.end);
            },
        },
        data: function() {
            return {
                end: 10,
            };
        },
        methods: {
            infiniteHandler() {
                this.end += 10;
            },
        },
        components: {
            NotificationItem,
            InfiniteLoading,
        },
    };
</script>