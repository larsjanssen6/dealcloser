<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>Bewerk {{ organisation.name }}</p>
            </div>

            <slot>
                <form>
                    <div class="field">
                        <label for="name" class="label">Organisatie</label>

                        <div class="control">
                            <input id="name"
                                   name="name"
                                   type="text"
                                   v-model="organisation.name"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('name') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('name')">{{ error('name') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="account_manager" class="label">Account manager</label>

                        <div class="control">
                            <input id="account_manager"
                                   name="account_manager"
                                   type="text"
                                   v-model="organisation.account_manager"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('account_manager') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('account_manager')">{{ error('account_manager') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="category_id" class="label">Bedrijfscategorie</label>

                        <select id="category_id" name="category_id"
                                class="input" :class="{ 'is-danger': errorsHas('category_id') }" v-model="organisation.category_id">
                            <option disabled value="">Selecteer een categorie</option>

                            <option v-for="category in prpCategories" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <country-state :countries="prpCountries"
                                   :prpState="organisation.state_code"
                                   :prpCountry="organisation.country_code"
                                   @stateChanged="updateState"
                                   @countryChanged="updateCountry">
                    </country-state>

                    <div class="field">
                        <label for="street" class="label">Straat</label>

                        <div class="control">
                            <input id="street"
                                   name="street"
                                   type="text"
                                   v-model="organisation.street"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('street') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('street')">{{ error('street') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="town" class="label">Woonplaats</label>

                        <div class="control">
                            <input id="town"
                                   name="town"
                                   type="text"
                                   v-model="organisation.town"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('town') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('town')">{{ error('town') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="sales_area" class="label">Verkoopgebied</label>

                        <div class="control">
                            <input id="sales_area"
                                   name="sales_area"
                                   type="text"
                                   v-model="organisation.sales_area"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('sales_area') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('sales_area')">{{ error('sales_area') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="email" class="label">Email</label>

                        <div class="control">
                            <input id="email"
                                   name="email"
                                   type="email"
                                   v-model="organisation.email"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('email') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('email')">{{ error('email') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="phone" class="label">Telefoon</label>

                        <div class="control">
                            <input id="phone"
                                   name="phone"
                                   type="phone"
                                   v-model="organisation.phone"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('phone') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('phone')">{{ error('phone') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="website" class="label">Website</label>

                        <div class="control">
                            <input id="website"
                                   name="website"
                                   type="website"
                                   v-model="organisation.website"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('website') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('website')">{{ error('website') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="linkedin" class="label">Linkedin</label>

                        <div class="control">
                            <input id="linkedin"
                                   name="linkedin"
                                   type="linkedin"
                                   v-model="organisation.linkedin"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('linkedin') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('linkedin')">{{ error('linkedin') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="organisation" class="label">Producten van organisatie</label>

                        <div class="control">
                            <div v-if="options.length != 0">
                                <multi-select
                                        :prpSelected="organisation.products"
                                        :prpOptions="options"
                                        :prpCustomLabel="customLabel"
                                        prpPlaceholder="Kies product(en)"
                                        @optionAdded="addOption"
                                        @optionRemoved="removeOption">
                                </multi-select>
                            </div>

                            <p v-else>
                                Er zijn nog geen producten. Maak deze
                                <a href="/producten/registreer">hier</a> aan.
                            </p>
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

                <destroy :service="OrganisationService" :id="organisation.id"></destroy>

                <a class="button is-primary is-outlined"
                   @click="show = false">
                    Annuleer
                </a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import Validation from '../../mixins/validation.js';
    import OrganisationService from "../../services/OrganisationService.js";

    export default {
        props: ['prp-organisation', 'prp-categories', 'prp-countries', 'prp-products'],

        mixins: [Validation],

        data() {
            return {
                loading: false,
                show: false,
                organisation: {},
                OrganisationService: OrganisationService,
                selected: null,
                options: []
            }
        },

        created() {
            this.organisation = this.prpOrganisation;
            this.options = this.prpProducts;

            Event.$on('show-organisation-modal', (id) => {
                if (this.organisation.id === id) {
                    this.show = true;
                }
            });
        },

        methods: {
            updateState(state) {
                this.organisation.state_code = state;
            },

            updateCountry(country) {
                this.organisation.country_code = country;
            },

            customLabel(option) {
                return `${option.name} - € ${option.price}`
            },

            addOption(option) {
                this.organisation.products.push(option)
            },

            removeOption(option) {
                this.organisation.products = this.organisation.products.filter((item) => item.id !== option);
            },

            update() {
                this.loading = true;

                OrganisationService.update(this.organisation)
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