<template>
    <span class="icon">
        <span :class="[`mdi ${icon}`, innerClass]"/>
    </span>
</template>

<script>
export default {
    props: {
        innerClass: {
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
