<template>
    <div>
        <card :title="'SALUTARE DOMNULE, ' + $store.state.user.user.first_name">
            Tu:
           <pre>{{$store.state.user.user}}</pre>
        </card>
        <!--De fapt, mai bine hotaram la scoala cum o sa arate pagina asta-->
        <div class="container mt-20">
            <div class="columns">
                <div class="column">
                    <home-card title="Continua vizionarea">
                        <div class="courseContinueWatching">
                            <div class="columns">
                                <div class="column">
                                    <div>
                                        <div class="courses">
                                            <a href="" class="course">
                                                <span></span>
                                                <img src="https://i1.ytimg.com/vi/F5FEj9U-CJM/maxresdefault.jpg" alt="True Facts About The Mantis Shrimp" />
                                            </a>
                                         </div>
                                    </div>
                                </div>
                                <div class="column is-three-fifths">
                                    <div class="continueWatching" style="">adasdasd</div>
                                    <div style="font-size: 15px">6% complet</div>
                                </div>
                            </div>
                        </div>
                    </home-card>
                </div>
                <div class="column is-two-thirds">
                    <card></card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import HomeCard from '../includes/dumb/HomeCard.vue';
    import Card from '../includes/dumb/Card.vue';
    import UploadImage from '../includes/dumb/UploadImage.vue';

    export default {
        components: {
            Card,
            HomeCard,
            UploadImage,
        },
    };
</script>
