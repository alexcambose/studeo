<template>
    <div>
        <ul>
            <notification-item v-for="(notification, index) in _notifications" :key="index" :notification="notification"></notification-item>
        </ul>
        <infinite-loading @infinite="infiniteHandler" v-if="end < notifications.length"></infinite-loading>
    </div>

</template>


<script>
    import NotificationItem from './NotificationItem';
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        props: ['notifications'],
        computed: {
            _notifications(){
                return this.notifications.slice(0, this.end);
            },
        },
        data: function(){
            return {
                end: 10,
            };
        },
        methods: {
            infiniteHandler() {
                this.end += 10;
            }
        },
        components: {
            NotificationItem,
            InfiniteLoading
        }
    }
</script>