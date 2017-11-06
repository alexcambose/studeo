<template>
    <div>
        <ul class="school-classes">
            <li v-for="(_class, index) in classes">
                <router-link :to="createLink(index)">{{_class.name}}</router-link>
                <ul class="class-years">
                    <li v-for="n in 8" :key="n" class="class-year">
                        <router-link :to="createLink(index, 12-n+1)">Clasa a {{12-n+1}}-a</router-link>
                    </li>
                </ul>
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
        methods: {
            createLink(classIndex, classYear = null){
                const url = '/materie/' + this.classes[classIndex].slug;
                if(classYear) return url + '/clasa_a_' + classYear;
                else return url;
            }
        }
    };
</script>