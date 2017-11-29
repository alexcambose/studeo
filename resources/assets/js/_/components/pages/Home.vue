<template>
    <div>

        <card :title="'SALUTARE DOMNULE, ' + $store.state.user.user.first_name">
            Tu:
           <pre>{{$store.state.user.user}}</pre>
        </card>
    </div>

</template>

<script>
    import Card from '../includes/dumb/Card.vue';
    import UploadImage from '../includes/dumb/UploadImage.vue';

    export default {
        components: {
            Card,
            UploadImage,
        },
    };
</script>
