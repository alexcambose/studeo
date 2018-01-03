<template>
    <div class="container content-lower">
        <div class="columns">
            <div class="column is-4">
                <nav class="panel">
                    <p class="panel-heading">
                        <i class="fa fa-info-circle"></i> Ajutor
                    </p>
                    <router-link :to="{name: 'help-questions'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-question"></i>
                        </span>
                        Întrebări frecvente
                    </router-link>
                    <router-link :to="{name:'help-report'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-bug"></i>
                        </span>
                        Raportează o eroare sau trimite o sugestie
                    </router-link>
                </nav>
            </div>
            <div class="column is-8">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
    export default {};
</script>