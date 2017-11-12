<template>
    <div class="container container-lower">
        <div class="columns">
            <div class="column is-4">
                <nav class="panel panel-settings">
                    <p class="panel-heading">
                        <i class="fa fa-cog"></i> Setari
                    </p>
                    <router-link :to="{name: 'settings-profile'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-address-card"></i>
                        </span>
                        Profil
                    </router-link>
                    <router-link :to="{name:'settings-account'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-user"></i>
                        </span>
                        Cont
                    </router-link>
                    <router-link :to="{name:'settings-security'}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-shield"></i>
                        </span>
                        Securitate
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
    export default {

    };
</script>