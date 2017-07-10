<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>Bewerk {{ relation.organisation }}</p>
            </div>

            <slot>
                <form>
                    <div class="field">
                        <label for="organisation" class="label">Organisatie</label>

                        <div class="control">
                            <input id="organisation"
                                   name="organisation"
                                   type="text"
                                   v-model="relation.organisation"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('organisation') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('organisation')">{{ error('organisation') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="account_manager" class="label">Account manager</label>

                        <div class="control">
                            <input id="account_manager"
                                   name="account_manager"
                                   type="text"
                                   v-model="relation.account_manager"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('account_manager') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('account_manager')">{{ error('account_manager') }}</p>
                        </div>
                    </div>

                    <div class="field">
                        <label for="category_id" class="label">Bedrijfscategorie</label>

                        <select id="category_id" name="category_id"
                                class="input" :class="{ 'is-danger': errorsHas('category_id') }" v-model="relation.category_id">
                            <option disabled value="">Selecteer een categorie</option>

                            <option v-for="category in prpCategories" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <country-state :countries="prpCountries"
                                   :prpState="relation.state_code"
                                   :prpCountry="relation.country_code"
                                   @stateChanged="updateState"
                                   @countryChanged="updateCountry">
                    </country-state>

                    <div class="field">
                        <label for="street" class="label">Straat</label>

                        <div class="control">
                            <input id="street"
                                   name="street"
                                   type="text"
                                   v-model="relation.street"
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
                                   v-model="relation.town"
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
                                   v-model="relation.sales_area"
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
                                   v-model="relation.email"
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
                                   v-model="relation.phone"
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
                                   v-model="relation.website"
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
                                   v-model="relation.linkedin"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('linkedin') }"
                                   autofocus>

                            <p class="help is-danger" v-if="errorsHas('linkedin')">{{ error('linkedin') }}</p>
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

                <destroy :service="RelationService" :id="relation.id"></destroy>

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
    import RelationService from "../../services/RelationService";

    export default {
        props: ['prp-relation', 'prp-categories', 'prp-countries'],

        mixins: [Validation],

        data() {
            return {
                loading: false,
                show: false,
                relation: {},
                RelationService: RelationService
            }
        },

        created() {
            this.relation = this.prpRelation;

            Event.$on('show-relation-modal', (id) => {
                if (this.relation.id === id) {
                    this.show = true;
                }
            });
        },

        methods: {
            updateState(state) {
                this.relation.state_code = state;
            },

            updateCountry(country) {
                this.relation.country_code = country;
            },

            update() {
                this.loading = true;

                RelationService.update(this.relation)
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