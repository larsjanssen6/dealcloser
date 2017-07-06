export default {
    data() {
        return {
            errors: []
        }
    },

    methods: {
        errorsHas(field) {
            return Object.keys(this.errors).includes(field);
        },

        error(field) {
            return this.errors[field][0];
        }
    }
}