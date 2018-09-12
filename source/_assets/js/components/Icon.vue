<template>
    <span class="icon" :class="{ 'is-large': stack }">
        <span v-if="stack" class="fa-stack fa-lg">
            <i :class="[`fa fa-stack-2x ${stack}`, stackClass]"/>
            <i :class="[`fa fa-stack-1x ${icon}`, iconClass]"/>
        </span>
        <i v-else :class="[`fa ${icon}`, iconClass]"/>
    </span>
</template>

<script>
export default {
    props: {
        iconClass: {
            type: String,
            default: ''
        },
        stack: {
            type: String,
            default: ''
        },
        stackClass: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            icon: this.$slots.default[0].text
        };
    }
};
</script>
