<template>
    <div v-if="message" :class="`notification ${type}`">
        <button class="delete" @click="message = ''"/>
        <icon v-if="icon">{{ icon }}</icon>
        {{ message }}
    </div>
</template>

<script>
export default {
    data () {
        return {
            message: '',
            type: '',
            icon: ''
        };
    },
    created () {
        window.eventBus.$on('notify', (message, type = 'is-info', icon = '') => {
            this.message = message;
            this.type = type;
            this.icon = icon;
        });
    }
};
</script>
