<template>
    <div>
        <section class="hero is-primary is-bold">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        {{ category.name }} <i :class="[ 'fa', category.icon ]"></i>
                    </h1>
                </div>
            </div>
        </section>
        <div class="container mt-15">
            <courses></courses>
        </div>
    </div>
</template>

<script>
    import { MATERII } from '../../../../utils';
    import Courses from '../../../components/includes/course/Courses';

    export default {
        data() {
            return {
                categories: MATERII,
            };
        },
        computed: {
            category() {
                let slug = this.$route.params.category;
                return this.categories.find(e => e.slug == slug);
            },
        },
        components: {
            Courses,
        },
    }
</script>