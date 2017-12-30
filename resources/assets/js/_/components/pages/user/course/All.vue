<template>
    <div>
        <div v-if="this.$route.query.categorie">
            <section class="hero is-primary is-bold">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">
                            <b-icon :icon="category.icon" pack="fa"></b-icon>&nbsp; {{ category.name }}
                        </h1>
                    </div>
                </div>
            </section>
        </div>
        <div class="container content-lower">
            <courses></courses>
        </div>
    </div>
</template>

<script>
    import Courses from '../../../includes/course/Courses.vue';
    import { MATERII } from '../../../../../utils';

    export default {
        data() {
            return {
                categories: MATERII,
            };
        },
        computed: {
            category() {
                let slug = this.$route.query.categorie;
                return this.categories.find(e => e.slug == slug);
            },
        },
        components: {
            Courses,
        },
    };
</script>