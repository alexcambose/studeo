<template>
    <div class="notification-item">
        <div class="data">
            <div class="title">
                {{notification.title}}
            </div>
            <span class="description">
                {{notification.message}}
            </span>
            <div v-if="notification._read_at" class="meta">
                Vazut cu {{notification._read_at}}
            </div>
        </div>
        <div class="actions">
            <div class="buttons">
                <span @click="toggleReadNotification(notification.id)"
                      :class="['button', 'is-small', (fetchingToggleRead ? 'is-loading' : ''), (notification._read_at ? 'is-success' : ['is-info', 'is-outlined'])]"
                      title="Marcheaza ca citit">
                    <!--<i class="fa fa-times" v-if="notification.read_at"></i>-->
                    <i class="fa fa-check"></i>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            notification: Object,
        },
        data: function () {
            return {
                fetchingToggleRead: false,
            };
        },
        methods: {
            toggleReadNotification(id) {
                this.fetchingToggleRead = true;
                this.$store.dispatch('toggleReadNotification', id)
                    .then(() => {
                        this.fetchingToggleRead = false;
                    })
                    .catch(() => {
                        this.fetchingToggleRead = false;
                    });
            },
        },
    };
</script>