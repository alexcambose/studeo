<template>
    <div @click="$emit('select', avatar.type)" class="avatar-card">
        <image-container :src="avatar._image._filename" class="avatar-card-image"></image-container>
        <span :class="['avatar-card-title', user._avatar.type === avatar.type ? 'has-text-weight-bold' : '']">{{avatar.title}}</span>
        <span class="avatar-card-price">
            {{avatar.price}} &nbsp;<b-icon pack="fa" icon="graduation-cap" size="is-small"></b-icon>
        </span>
        <div class="avatar-card-footer">
            <button v-if="!avatar._owned" @click="handleBuy" class="button is-success is-fullwidth is-small" :disabled="user.coins < avatar.price">Cumpără</button>
            <button v-else-if="user._avatar.type !== avatar.type" @click="handleActivate" class="button is-info is-fullwidth is-small">Activează</button>
            <div v-else class="avatar-card-active">Activat</div>
        </div>
    </div>
</template>

<script>
    import ImageContainer from '../../../../includes/dumb/ImageContainer';
    export default {
        props: {
            avatar: Object,
            user: Object,
        },
        data() {
            return {};
        },
        methods: {
            handleBuy(e) {
                e.stopPropagation();
                this.$emit('buy', this.avatar.type);
            },
            handleActivate(e) {
                e.stopPropagation();
                this.$emit('activate', this.avatar.type);
            },
        },
        components: {
            ImageContainer,
        },
    };
</script>