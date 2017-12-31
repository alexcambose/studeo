<template>
    <div class="avatar-details">
        <div class="title">{{avatar.title}}</div>
        <image-container :src="avatar._image._filename" class="avatar-details-image"></image-container>
        <div>
            {{avatar.price}} &nbsp;<b-icon pack="fa" icon="graduation-cap" size="is-small"></b-icon>
        </div>
        <div>
            {{avatar.description}}
        </div>
        <hr>
        <button v-if="!avatar._owned"  @click="$emit('buy', avatar.type)" class="button is-success" :disabled="user.coins < avatar.price">Cumpără</button>
        <button v-else-if="user._avatar.type !== avatar.type" @click="$emit('activate', avatar.type)" class="button is-info">Activează</button>
        <div v-else class="avatar-details-active">Activat</div>
    </div>
</template>

<script>
    import ImageContainer from '../../../../includes/dumb/ImageContainer';
    export default {
        props: {
            avatar: Object,
            user: Object,
        },
        components: {
            ImageContainer,
        },
    };
</script>