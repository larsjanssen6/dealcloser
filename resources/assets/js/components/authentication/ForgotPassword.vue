<template>
    <div class="message is-primary message__top">
        <div class="message-header">
            <div>
                <p>
                    Wachtwoord vergeten?
                </p>
            </div>
        </div>

        <div class="message-body">
            <form @submit.prevent="send()"
                  class="form-horizontal"
                  role="form">

                <div class="field">
                    <label for="email" class="label">
                        Email
                    </label>

                    <p class="control has-icons-left"
                       :class="{ 'has-icons-right': error }">

                        <input type="email"
                               v-model="data.email"
                               :class="{ 'is-danger': error }"
                               class="input"
                               placeholder="Typ hier uw email"
                               id="email"
                               name="email"
                               required
                               autofocus
                               v-focus>

                        <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>

                        <span v-if="error" class="icon is-small is-right">
                            <i class="fa fa-warning"></i>
                        </span>
                    </p>

                    <p v-if="error" class="help is-danger">
                        {{ error }}
                    </p>
                </div>

                <div class="field is-grouped is-centered">
                    <div class="control">
                        <button type="submit"
                                :class="{ 'is-loading': loading }"
                                class="button is-primary slideUp">
                            Verstuur reset link
                        </button>

                        <button @click="$emit('close')"
                                class="button is-outlined">
                            Annuleer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { default as swal } from 'sweetalert2'
    import AuthenticationService from '../../services/AuthenticationService';

    export default {
        data() {
            return {
                data: {
                    email: ''
                },

                error: false,
                loading: false
            }
        },

        methods: {
            send() {
                this.error = false;
                this.loading = true;

                AuthenticationService.send(this.data)
                    .then((response) => {
                        this.loading = false;

                        swal({
                            title: 'Verzonden',
                            type: 'success',
                            text: response.data.success,
                            showConfirmButton: false,
                            timer: 4000
                        });

                        this.$emit('close');
                    })
                    .catch((error) => {
                        this.loading = false;
                        this.error = error.response.data.error;
                    })
            }
        }
    }
</script>
