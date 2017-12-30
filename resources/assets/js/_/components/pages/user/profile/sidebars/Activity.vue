<template>
    <div>
        <button @click="isActivityModalActive = true" class="button is-link is-outlined is-fullwidth is-white is-small">Activitatea mea</button>
        <b-modal :active.sync="isActivityModalActive">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Activitate</p>
                </header>
                <section class="modal-card-body">
                    <span>
                        <b-datepicker
                                inline
                                class="has-text-centered"
                                v-model="date"
                                :min-date="new Date(user.created_at)"
                                :max-date="new Date()"
                                :events="activity"
                                indicators="dots"
                        >
                        </b-datepicker>
                    </span>

                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="isActivityModalActive = false">Închide</button>
                </footer>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import config from '../../../../../../config';

    export default {
        props: {
            user: Object,
        },
        mounted() {
            axios.get(config.url.USER_ACTIVITY + this.user.id)
                .then(({ data }) => {
                    this.activity = data.activity.map(e => { // todo kill myself
                        const dateArray = e.split(' ')[0].split('-');
                        return {
                            date: new Date(dateArray[0], dateArray[1]-1, dateArray[2]),
                            type: 'is-info',
                        };
                    });
                });
        },
        data() {
            return {
                isActivityModalActive: false,
                activity: [],
                date: new Date(),
            };
        },
    };
</script>

<style scoped>

</style>