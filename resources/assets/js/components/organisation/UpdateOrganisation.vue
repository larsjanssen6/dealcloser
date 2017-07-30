<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <div slot="title">
                    <p v-if="loadingForm">.....</p>
                    <p v-else>Bewerk {{ organisation.name }}</p>
                </div>
            </div>

            <slot>
                <form>
                    <div v-if="loadingForm">
                        <p>Organisatie aan het inladen...</p>
                    </div>

                    <div v-else>
                        <custom-input
                                :value.sync="organisation.name"
                                label="Organisatie"
                                name="organisation">
                        </custom-input>

                        <custom-input
                                :value.sync="organisation.account_manager"
                                label="Account manager"
                                name="account_manager">
                        </custom-input>

                        <div class="field">
                            <label for="category_id" class="label">Bedrijfscategorie</label>

                            <select v-model="organisation.category_id" id="category_id" name="category_id" class="input" required>
                                <option disabled value="">Selecteer een categorie</option>

                                <option v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <country-state :prpState="organisation.state_code"
                                       :prpCountry="organisation.country_code"
                                       @stateChanged="updateState"
                                       @countryChanged="updateCountry">
                        </country-state>

                        <custom-input
                                :value.sync="organisation.street"
                                label="Straat"
                                name="street">
                        </custom-input>

                        <custom-input
                                :value.sync="organisation.town"
                                label="Woonplaats"
                                name="town">
                        </custom-input>

                        <custom-input
                                :value.sync="organisation.sales_area"
                                label="Verkoopgebied"
                                name="sales_area">
                        </custom-input>

                        <custom-input
                                :value.sync="organisation.email"
                                label="Email"
                                name="email">
                        </custom-input>

                        <custom-input
                                :value.sync="organisation.phone"
                                label="Telefoon"
                                name="phone">
                        </custom-input>

                        <custom-input
                                :value.sync="organisation.website"
                                label="Website"
                                name="website">
                        </custom-input>

                        <custom-input
                                :value.sync="organisation.linkedin"
                                label="Linkedin"
                                name="linkedin">
                        </custom-input>

                        <div class="field">
                            <label for="organisation" class="label">Producten van organisatie</label>

                            <div class="control">
                                <div v-if="products.length != 0">
                                    <multi-select
                                            :prpSelected="organisation.products"
                                            :prpOptions="products"
                                            :prpCustomLabel="customLabel"
                                            prpPlaceholder="Kies product(en)"
                                            @optionAdded="addProductOption"
                                            @optionRemoved="removeProductOption">
                                    </multi-select>
                                </div>

                                <p v-else>
                                    Er zijn nog geen producten. Maak deze
                                    <a href="/producten/registreer">hier</a> aan.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </slot>

            <div slot="footer">
                <div v-if="loadingForm">
                    <a class="button is-primary is-outlined"
                       @click="show = false">
                        Annuleer
                    </a>
                </div>

                <div v-else>
                    <button id="submit"
                            class="button is-primary"
                            :class="{ 'is-loading': loading }"
                            @click="update">
                        Update
                    </button>

                    <destroy :service="OrganisationService" :id="organisation.id"></destroy>

                    <a class="button is-primary is-outlined"
                       @click="show = false">
                        Annuleer
                    </a>
                </div>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import collect from 'collect.js';
    import Validation from '../../mixins/validation.js';
    import ProductService from "../../services/ProductService.js";
    import CategoryService from "../../services/CategoryService.js";
    import OrganisationService from "../../services/OrganisationService.js";

    export default {
        props: ['organisation-id'],

        mixins: [Validation],

        data() {

            /**
             * Init all data.
             */

            return {
                loadingForm: false,
                loading: false,
                show: false,
                organisation: {},
                categories: [],
                products: [],
                OrganisationService: OrganisationService
            }
        },

        created() {

            /**
             * Listen for show relation modal event.
             */

            Event.$on('show-organisation-modal', (id) => {
                if (this.organisationId == id) {
                    this.getOrganisation(id);
                    this.show = true;
                }
            });
        },

        methods: {

            /**
             * Update the relation.
             */

            update() {
                this.loading = true;

                let organisation = this.organisation;

                /**
                 * pluck only the id's from all items.
                 */

                organisation.products = collect(organisation.products).pluck('id').toArray();

                /**
                 * Update the organisation.
                 */

                OrganisationService.update(organisation)
                    .then(({data}) => {
                        this.loading = false;

                        swal(({
                            title: data.status,
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        }));

//                        location.reload();
                    })
                    .catch(error => {
                        Event.$emit('thereAreErrors', error.response.data);
                        this.errors = error.response.data;
                        this.loading = false;
                    });
            },

            /**
             * Get organisation.
             */

            getOrganisation(id) {
                this.loadingForm = true;

                OrganisationService.show(id).then(({data}) => {
                    this.organisation = data;

                    this.getProducts();
                    this.getCategories();

                    this.loadingForm = false;
                });
            },

            /**
             * Get all products.
             */

            getProducts() {
                ProductService.index().then(({data}) => this.products = data);
            },

            /**
             * Get all categories.
             */

            getCategories() {
                CategoryService.index().then(({data}) => this.categories = data);
            },


            /**
             * Listen for events.
             */

            updateState(state) {
                this.organisation.state_code = state;
            },

            updateCountry(country) {
                this.organisation.country_code = country;
            },

            customLabel(option) {
                return `${option.name} - € ${option.price}`
            },

            addProductOption(option) {
                this.organisation.products.push(option)
            },

            removeProductOption(option) {
                this.organisation.products = this.organisation.products.filter((item) => item.id !== option.id);
            }
        }
    }
</script>