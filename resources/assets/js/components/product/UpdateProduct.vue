<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>Bewerk {{ product.name }}</p>
            </div>

            <slot>
                <form>
                    <div class="field">
                        <label for="name" class="label">Naam</label>

                        <div class="control">
                            <input id="name"
                                   name="name"
                                   type="text"
                                   v-model="product.name"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('name') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('name')">{{ error('name') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="description" class="label">Omschrijving</label>

                        <div class="control">
                            <input id="description"
                                   name="description"
                                   type="text"
                                   v-model="product.description"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('description') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('description')">{{ error('description') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="price" class="label">Verkoopprijs</label>

                        <div class="control">
                            <input id="price"
                                   name="price"
                                   type="number"
                                   v-model="product.price"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('price') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('price')">{{ error('price') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="purchase" class="label">Inkoopprijs</label>

                        <div class="control">
                            <input id="purchase"
                                   name="purchase"
                                   type="number"
                                   v-model="product.purchase"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('purchase') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('purchase')">{{ error('purchase') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="amount" class="label">Totaal</label>

                        <div class="control">
                            <input id="amount"
                                   name="amount"
                                   type="number"
                                   v-model="product.amount"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('amount') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('amount')">{{ error('amount') }}</p>
                        </div>
                    </div>
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
                        this.loading = false;
                        this.errors = error.response.data;
                    });
            }
        }
    }
</script>