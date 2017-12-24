<template>
    <div class="level-box" :style="{backgroundColor: background}">
        <span>
            {{level}}
        </span>
    </div>
</template>

<script>
    import { levelColor } from '../../../../utils';
    export default {
        props: {
            level: {
                required: true,
                type: Number,
            },
        },
        computed: {
            background() {
                return levelColor(this.level);
            },
        },
    };
</script>

<style scoped>
    .level-box{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        margin: 0 4px;
        border-radius: 100%;
    }
    .level-box span {
        color: white;
    }
</style>