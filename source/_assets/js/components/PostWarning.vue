<template>
    <article v-if="isOld" class="message is-warning">
        <div class="message-body">
            <icon>fa-warning</icon>
            <span class="has-text-weight-bold">Warning:</span>
            This post is over a year old. Some of the information this contains may be outdated.
        </div>
    </article>
</template>

<script>
export default {
    props: {
        date: {
            type: String,
            required: true
        }
    },
    computed: {
        isOld () {
            return ((Date.now() / 1000 - this.date) / 86400) > 365;
        }
    }
};
</script>
