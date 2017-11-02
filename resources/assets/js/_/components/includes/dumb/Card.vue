<template>
    <div class="columns">
        <div class="column is-one-third is-offset-one-third">
            <div class="card mt-75">
                <div class="card-header-title">
                    <div class="title">
                        {{ title }}
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
        props: ['title']
    };
</script>
<style>

</style>