<template>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                Recompense
            </p>
            <a href="#" class="card-header-icon">
                      <span class="icon">
                        <!--<i class="fa fa-trophy" aria-hidden="true"></i>-->
                      </span>
            </a>
        </header>
        <div class="card-content">
            <item></item>
            <item></item>
            <item></item>
            <item></item>
        </div>
    </div>
</template>

<script>
    import Item from '../../../../../components/includes/dumb/Item.vue';
    export default {
        props: {
            user: Object, // userul pe care este pagina de profil, nu neaparat sandel
        },
        components: {
            Item,
        },
    };
</script>