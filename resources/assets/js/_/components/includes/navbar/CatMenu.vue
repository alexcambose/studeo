<template>
    <div class="school-classes">
        <ul>
            <li v-for="category in classes">
                <router-link :to="{ name: 'courses', query: { categorie: category.slug }}">{{ category.name }}</router-link>
            </li>
        </ul>
    </div>
</template>
<script>
    import { MATERII } from '../../../../utils';
    export default {
        data: function() {
            return {
                classes: MATERII,
            };
        },
    };
</script>