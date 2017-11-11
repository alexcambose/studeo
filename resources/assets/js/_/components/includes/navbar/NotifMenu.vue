<template>
    <div>
        <div class="search-container">
            <b-switch v-model="onlyUnread">
                Doar notficările necitite
            </b-switch>
        </div>
        <div v-if="!notifications.length" class="notification-item">
            Nicio notificare
        </div>
        <ul v-else>
            <li v-for="(notification, index) in notifications" :key="index" class="notification-item">
                <div class="data">
                    <div class="title">
                        {{notification.data.title}}
                    </div>
                    <span class="description">
                        {{notification.data.message}}
                    </span>
                </div>
                <div class="actions">
                    <div class="buttons">
                        <span @click="toggleReadNotification(notification.id)"
                              :class="['button', 'is-small', (fetchingToggleRead ? 'is-loading' : ''), (notification.read_at ? ['is-info', 'is-outlined'] : 'is-success')]"
                              title="Marcheaza ca citit">
                            <i class="fa fa-times" v-if="notification.read_at"></i>
                            <i class="fa fa-check" v-else></i>
                        </span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex';
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
        data: function (){
            return {
                fetchingToggleRead: false,
            };
        },
        methods: {
            toggleReadNotification(id){
                this.fetchingToggleRead = true;
                this.$store.dispatch('toggleReadNotification', id)
                    .then(() => {
                        this.fetchingToggleRead = false;
                    })
                    .catch(() => {
                        this.fetchingToggleRead = false;
                    });
            }
        }
    }
</script>