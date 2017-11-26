<template>
    <div>
        <section class="hero is-dark is-bold">
            <div class="hero-body">
                <div class="container">
                    <router-link :to="{ name: 'dashboard-add-course' }" class="button is-light is-outlined is-pulled-right">Adaugă curs</router-link>
                    <h1 class="title">
                        Salut sunt un mentor

                    </h1>
                </div>
            </div>
        </section>
        <div class="container content-lower">
            content
        </div>
    </div>

</template>

<script>
    export default {};
</script>