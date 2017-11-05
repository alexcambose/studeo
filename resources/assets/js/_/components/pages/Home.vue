<template>
    <div>
        <card :title="'SALUTARE DOMNULE, ' + this.$store.state.user.user.first_name">
            Tu:
           <pre>{{this.$store.state.user.user}}</pre>
        </card>
    </div>

</template>

<script>
    import Card from '../includes/dumb/Card';

    export default {
        components:{
            'card': Card,
        },
    }
</script>
