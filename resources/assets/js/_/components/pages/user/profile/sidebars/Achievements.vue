<template>
    <div>
        <b-modal :active.sync="isAchievementsModalActive" has-modal-card>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Toate realizările disponibile</p>
                </header>
                <section class="modal-card-body">
                    <div class="achievements-modal-container">
                        <achievement-box
                                v-for="(achievement, index) in allAchievements"
                                :key="index"
                                :achievement="achievement"
                                :highlighted="!!achievements.filter(e => achievement.type === e.type).length"
                        ></achievement-box>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="isAchievementsModalActive = false">Închide</button>
                </footer>
            </div>
        </b-modal>
        <div class="card achievements-card">
            <div @click="isAchievementsModalActive = true" class="card-header">
                <p class="card-header-title">
                    Realizări <span class="achievement-count has-text-gray">{{achievements.length}} / {{allAchievements.length}}</span>
                </p>
                <span class="card-header-icon"><b-icon pack="fa" icon="trophy"></b-icon></span>
            </div>
            <div class="card-content">
                <div class="achievements-container">
                    <achievement-box v-for="(achievement, index) in achievements" :key="index" :achievement="achievement"></achievement-box>
                </div>
            </div>
            <!--<pre>{{achievements}}</pre>-->
        </div>
    </div>
</template>

<script>
    import config from '../../../../../../config';
    import AchievementBox from '../../../../includes/dumb/AchievementBox';

    export default {
        props: {
            user: Object,
        },
        mounted() {
            axios.get(config.url.ACHIEVEMENTS)
                .then(({ data }) => {
                    this.allAchievements = data.achievements;
                });
            axios.get(config.url.ACHIEVEMENTS_USER + this.user.id)
                .then(({ data }) => {
                    this.achievements = data.achievements;
                });
        },
        data() {
            return {
                achievements: [],
                allAchievements: [],
                isAchievementsModalActive: false,
            };
        },
        components: {
            AchievementBox,
        },
    };
</script>