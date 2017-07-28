<template>
    <div>
        <input type="hidden" v-for="select in selected" :name="prpName + '[]'" :value="select.id">

        <multiselect
                v-model="selected"
                :multiple="true"
                :options="prpOptions"
                :custom-label="prpCustomLabel"
                :placeholder="prpPlaceholder"
                track-by="id"
                selectLabel="Druk op enter en voeg toe"
                deselectLabel="Druk op enter en verwijder"
                open-direction="top"
                @select="select"
                @remove="remove">
        </multiselect>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        components: { Multiselect },

        props: {
            prpSelected: {
                type: Array,
                default: () => [],
            },

            prpOptions: {
                type: Array,
                default: () => [],
            },

            prpCustomLabel: {
                type: Function,
                default: (label) => label.name,
            },

            prpPlaceholder: {
                type: String,
                default: "Kies items"
            },

            prpName: {
                type: String,
                default: "items"
            }
        },

        created() {
            this.selected = this.prpSelected;
        },

        data() {
            return {
                selected: [],
                options: []
            }
        },

        methods: {
            select(value) {
                this.$emit('optionAdded', value);
            },

            remove(value) {
                this.$emit('optionRemoved', value);
            }
        }
    }
</script>