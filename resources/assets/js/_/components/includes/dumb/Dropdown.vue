<template>
    <div class="dropdown-component">
        <div class="dropdown-label">
            {{label}}
        </div>
        <div class="dropdown-container">
            <b-dropdown v-model="sorting">
                <button class="button is-primary" type="button" slot="trigger">
                    <template>
                        <b-icon pack="fa" :icon="selectedItem.icon"></b-icon>
                        <span>{{selectedItem.title}}</span>
                    </template>
                    <b-icon icon="menu-down"></b-icon>
                </button>

                <b-dropdown-item v-for="(item, index) in values" :key="index" :value="item.value">
                    <div class="media">
                        <b-icon class="media-left" pack="fa" :icon="item.icon"></b-icon>
                        <div class="media-content">
                            <h3>{{item.title}}</h3>
                            <small v-if="item.subtitle">{{item.subtitle}}</small>
                        </div>
                    </div>
                </b-dropdown-item>
            </b-dropdown>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            value: {},
            values: {
                required: true,
                type: Array,
                /*
                    no deep object validation :(
                    {
                        title: '',
                        subtitle: '', (optional)
                        value: '',
                        icon: '',
                    }
                 */
            },
            changed: {
                type: Function,
            },
            label: {
                type: String,
            },
        },
        computed: {
            sorting: {
                get() {
                    return this.value;
                },
                set(value) {
                    this.$emit('input', value);
                    if (this.changed) this.changed(value);
                },
            },
            selectedItem() {
                return this.values.find(e => this.sorting === e.value) || {};
            },
        },
    };
</script>

<style>
    .dropdown-component{
        display: flex;
        justify-content: flex-end;
        flex-direction: row;
    }
    .dropdown-component .dropdown-label{
        display: flex;
        align-items: center;
        margin-right: 10px;
    }
</style>