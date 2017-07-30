<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>Bewerk {{ product.name }}</p>
            </div>

            <slot>
                <form>
                    <custom-input
                            :value.sync="product.name"
                            label="Naam"
                            name="name"
                            type="text">
                    </custom-input>

                    <custom-input
                            :value.sync="product.description"
                            label="Omschrijving"
                            name="description"
                            type="text">
                    </custom-input>

                    <custom-input
                            :value.sync="product.price"
                            label="Verkoopprijs"
                            name="price"
                            type="text">
                    </custom-input>

                    <custom-input
                            :value.sync="product.purchase"
                            label="Inkoopprijs"
                            name="purchase"
                            type="text">
                    </custom-input>

                    <custom-input
                            :value.sync="product.amount"
                            label="Totaal"
                            name="amount"
                            type="text">
                    </custom-input>
                </form>
            </slot>

            <div slot="footer">
                <button id="submit"
                        class="button is-primary"
                        :class="{ 'is-loading': loading }"
                        @click="update">
                    Update
                </button>

                <destroy :service="ProductService" :id="product.id"></destroy>

                <a class="button is-primary is-outlined"
                   @click="show = false">
                    Annuleer
                </a>
            </div>
        </modal-card>
    </div>

</template>

<script>
    import UserService      from '../../services/UserService';
    import Validation       from '../../mixins/validation.js';
    import ProductService   from '../../services/ProductService';

    export default {
        props: ['prp-product'],

        mixins: [Validation],

        data() {
            return {
                loading: false,
                show: false,
                product: {},
                ProductService: ProductService,
            }
        },

        created() {
            this.product = this.prpProduct;

            Event.$on('show-product-modal', (id) => {
                if (this.product.id === id) {
                    this.show = true;
                }
            });
        },

        methods: {

            /**
             * Update product.
             */

            update() {
                this.loading = true;

                ProductService.update(this.product)
                    .then(({data}) => {
                        this.loading = false;

                        swal(({
                            title: data.status,
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        }));

                        location.reload();
                    })
                    .catch(error => {
                        Event.$emit('thereAreErrors', error.response.data);
                        this.errors = error.response.data;
                        this.loading = false;
                    });
            }
        }
    }
</script>