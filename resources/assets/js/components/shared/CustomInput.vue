<template>
    <div class="field">
        <label :for="name" class="label">{{ label }}</label>

        <div class="control">
            <input :id="name"
                   :name="name"
                   type="text"
                   v-model="proxyValue"
                   class="input"
                   :class="{ 'is-danger': errorsHas(name) }">

            <p class="help is-danger" v-if="errorsHas(name)">{{ error(name) }}</p>
        </div>
    </div>
</template>

<script>
    import Validation from '../../mixins/validation.js';

    export default {
        mixins: [Validation],

        props: ['value', 'label', 'name'],

        created() {
            Event.$on('thereAreErrors', (errors) => {
                this.errors = errors;
            });
        },

        computed: {
            proxyValue: {
                get() { return this.value; },
                set(newValue) { this.$emit('update:value', newValue); }
            }
        }
    }
</script>