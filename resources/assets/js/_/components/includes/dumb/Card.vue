<template>
    <div class="columns mt-75">
        <div class="column is-one-third is-offset-one-third">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">
                        {{ title }}
                    </div>
                    <div class="card-header-icon ca">
                        <i :class="'fa fa-' + icon"></i>
                    </div>
                </div>
                <div class="card-content">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['title', 'icon'],
    };
</script>
<style>

</style>