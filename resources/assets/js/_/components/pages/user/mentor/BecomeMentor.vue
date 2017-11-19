<template>
    <div class="becomeMentor">
        <div class="section section1">
            <div class="container-section">
                <div class="section-left">
                    <div class="section-title">Ajută elevii sa treacă examenele grele</div>
                    <div class="section-subtitle">Și tu poți contribui la succesul altora! Devino mentor acum!</div>
                    <button class="button is-info is-large is-outlined" @click="registerMentor">Aplică ca mentor</button>
                </div>
                <div class="section-right">
                    <img src="http://www.hotelroomsearch.net/im/hotels/dk/delfin-1.jpg" alt="Mentor">
                </div>

            </div>
        </div>

        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="has-text-centered">
                        <i class="fa fa-wheelchair-alt fa-5x"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A beatae dignissimos ex facilis, laboriosam magni nisi odio quas qui quo sit soluta, tempora. Distinctio ducimus et excepturi provident repudiandae voluptates!</p>
                </div>
                <div class="column">
                    <div class="has-text-centered">
                        <i class="fa fa-wheelchair-alt fa-5x"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, animi asperiores atque consequatur cupiditate dolore excepturi illum in ipsa itaque libero, minus nihil placeat porro, provident quasi reiciendis sapiente velit.</p>
                </div>
                <div class="column">
                    <div class="has-text-centered">
                        <i class="fa fa-wheelchair-alt fa-5x"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, animi asperiores atque consequatur cupiditate dolore excepturi illum in ipsa itaque libero, minus nihil placeat porro, provident quasi reiciendis sapiente velit.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            registerMentor() {
                const loading = this.$loading.open();
                this.$store.dispatch('registerMentor')
                    .then(() => {
                        this.$router.push({ name: 'dashboard' });
                        loading.close();
                    })
                    .error(() => loading.close());
            },
        },
    };
</script>