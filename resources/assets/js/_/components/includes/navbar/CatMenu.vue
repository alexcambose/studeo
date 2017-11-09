<template>
    <div class="school-classes">
        <ul>
            <li v-for="mat in classes">
                <router-link :to="`/materie/${mat.slug}`">{{mat.name}}</router-link>
            </li>
        </ul>
    </div>
</template>
<script>
    import { MATERII } from '../../../../utils';
    export default {
        data: function(){
            return {
                classes: MATERII,
            };
        },
    };
</script>