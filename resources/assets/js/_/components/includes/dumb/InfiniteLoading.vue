<template>
    <div class="infinite-scroll-container" :id="containerId">
        <div v-if="fetching">
            <div class="infinite-scroll-loading"></div>
            <div v-if="$slots.fetching"></div>
            <slot v-if="$slots.fetching" name="fetching"></slot> <span v-else>Fetching from server</span>
        </div>

        <div v-if="completed">
            <slot v-if="$slots.completed" name="completed"></slot>
            <span v-else>
                The end
            </span>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            offset: {
                required: false,
                type: Number,
                default: 0,
            },
        },
        mounted() {
            this.check();
            window.addEventListener('scroll', () => {
                this.check();
            });
        },
        data() {
            return {
                containerId: 'infinite-scroll-container-' + Math.floor(Math.random() * 10000),
                triggered: false,
                completed: false,
                fetching: false,
            };
        },
        methods: {
            check() {
                const container = document.getElementById(this.containerId);
                if (!container || this.completed) return false;
                if (container.getBoundingClientRect().top - this.offset < window.innerHeight && !this.triggered) {
                    this.trigger();
                }
                if (container.getBoundingClientRect().top - this.offset > window.innerHeight) {
                    this.triggered = false;
                }
            },
            loader() {
                return {
                    completed() {
                        this.completed = true;
                        this.fetching = false;
                    },
                    fetched() {
                        this.fetching = false;
                    },
                };
            },
            trigger() {
                const completed = this.loader().completed.bind(this);
                const fetched = this.loader().fetched.bind(this);
                this.$emit('triggered', { completed, fetched });
                this.triggered = true;
                this.fetching = true;
                this.completed = false;
            },
        },
    };
</script>

<style scoped>
    .infinite-scroll-container div {
        display: flex;
        flex-direction: column;
        padding: 10px;
        justify-content: center;
        align-items: center;
    }
    @keyframes loader {
        0% { transform: scale(.9) }
        50% { transform: scale(1.5) }
        100% { transform: scale(.9) }
    }
    .infinite-scroll-loading {
        animation: loader 1s infinite;
        padding: 6px;
        border: 2px solid gray;
        border-radius: 100%;
    }
</style>