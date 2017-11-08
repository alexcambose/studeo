<template>
    <b-collapse :open="false" class="collapse-trigger">
        <div class="collapse" slot="trigger">Click me!</div>
        <div class="box">
            <div class="content">
                <h3>
                    {{title}}
                </h3>
                <slot></slot>
            </div>
        </div>
    </b-collapse>
</template>

<script>
    export default {
        props: ['title'],
    }
</script>