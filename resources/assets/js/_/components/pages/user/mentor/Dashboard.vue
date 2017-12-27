<template>
    <div>
        <section class="hero is-dark is-bold">
            <div class="hero-body">
                <div class="container">
                    <router-link :to="{ name: 'dashboard-add-course' }" class="button is-light is-outlined is-pulled-right">Adaugă curs</router-link>
                    <h1 class="title">
                        Administrare cursuri
                    </h1>
                </div>
            </div>
        </section>
        <div class="container content-lower">
            <courses :user="$store.state.user.user"></courses>
        </div>
    </div>

</template>

<script>
    import Courses from '../../../includes/course/Courses.vue';
    export default {
        components: {
            Courses,
        },
    };
</script>