<template>
    <form @submit.prevent="onSubmitContact" autocomplete="off">
        <input type="text" class="is-hidden" v-model="form.trapit">

        <field label="Name" :error="errors.first('name')">
            <input type="text" class="input"
                id="name" name="name" v-model="form.name"
                :class="{ 'is-danger': errors.has('name') }"
                v-validate="'required|max:80'"
            >
        </field>

        <field label="Email" :error="errors.first('email')">
            <input type="text" class="input"
                id="email" name="email" v-model="form.email"
                :class="{ 'is-danger': errors.has('email') }"
                v-validate="'required|max:70|email'"
            >
        </field>

        <field label="Subject (optional)" label-for="subject" :error="errors.first('subject')">
            <input type="text" class="input"
                id="subject" name="subject" v-model="form.subject"
                :class="{ 'is-danger': errors.has('subject') }"
                v-validate="'max:60'"
            >
        </field>

        <field label="Message" :error="errors.first('message')">
            <textarea class="textarea"
                id="message" name="message" v-model="form.message"
                :class="{ 'is-danger': errors.has('message') }"
                v-validate="'required|min:20'"
            />
        </field>

        <div class="field has-text-centered">
            <button class="button is-primary" :disabled="errors.any()" :class="{ 'is-loading': sending }">
                <icon>fa-envelope</icon>
                <span>Send me a message</span>
            </button>
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import qs from 'qs';

export default {
    props: {
        jumprockAlias: {
            type: String,
            required: true
        }
    },
    data () {
        return {
            sending: false,
            form: {
                trapit: '',
                name: '',
                email: '',
                subject: '',
                message: '',
                replyto: '%email'
            }
        };
    },
    methods: {
        onSubmitContact () {
            this.$validator.validateAll().then((isValid) => {
                if (isValid) this.send();
            });
        },
        send () {
            this.sending = true;
            const form = { ...this.form };
            form.subject = '[Blog Contact Page] ' + form.subject;

            axios.post(`https://jumprock.co/mail/${this.jumprockAlias}`, qs.stringify({ ...form }))
                .then(({ data }) => {
                    this.sending = false;
                    this[(data.status === 'success' ? 'onSuccess' : 'onError')]();
                })
                .catch((error) => {
                    this.sending = false;
                    this.onError();
                    console.log(error.response);
                });
        },
        onSuccess () {
            this.form.name = '';
            this.form.email = '';
            this.form.subject = '';
            this.form.message = '';
            this.$validator.reset();
            window.eventBus.$emit('notify', 'Your message has been sent.', 'is-success', 'fa-check-circle');
        },
        onError () {
            window.eventBus.$emit('notify', 'Sending failed, please try again.', 'is-danger', 'fa-times-circle');
        }
    }
};
</script>
