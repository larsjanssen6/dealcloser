<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p v-if="loadingForm">.....</p>
                <p v-else>{{ organisation.name }}</p>
            </div>

            <slot>
                <div v-if="loadingForm">
                    <p>Laden...</p>
                </div>

                <div v-else>
                    <div class="column">
                        <strong>Accountmanager</strong>
                        <p>{{ organisation.account_manager }}</p>
                    </div>

                    <div class="column">
                        <strong>Bedrijfscategorie</strong>
                        <p>{{ organisation.category.name }}</p>
                    </div>

                    <div class="column">
                        <strong>Land</strong>
                        <p>{{ organisation.country_code }}</p>
                    </div>

                    <div class="column">
                        <strong>Provincie</strong>
                        <p>{{ organisation.state_code }}</p>
                    </div>

                    <div class="column">
                        <strong>Verkoopgebied</strong>
                        <p>{{ organisation.sales_area }}</p>
                    </div>

                    <div class="column">
                        <strong>Straat</strong>
                        <p>{{ organisation.street }}</p>
                    </div>

                    <div class="column">
                        <strong>Nummer</strong>
                        <p>{{ organisation.house_number }}</p>
                    </div>

                    <div class="column">
                        <strong>Postcode</strong>
                        <p>{{ organisation.zip }}</p>
                    </div>

                    <div class="column">
                        <strong>Plaats</strong>
                        <p>{{ organisation.town }}</p>
                    </div>

                    <div class="column">
                        <strong>Telefoon</strong>
                        <p>{{ organisation.phone }}</p>
                    </div>

                    <div class="column">
                        <strong>Email</strong>
                        <p><a :href="'mailto:' + organisation.email">{{ organisation.email }}</a></p>
                    </div>

                    <div class="column" v-if="organisation.linkedin">
                        <strong>Linkedin</strong>
                        <p><a :href="organisation.linkedin">Profiel</a></p>
                    </div>

                    <div class="column" v-if="organisation.website">
                        <strong>Website</strong>
                        <p><a :href="organisation.website">{{ organisation.website }}</a></p>
                    </div>

                    <div class="column" v-if="organisation.products.length != 0">
                        <strong>Producten</strong>
                        <p>
                         <span class="tag is-warning is-medium" v-for="product in organisation.products">
                        {{ product.name }}
                    </span>
                        </p>
                    </div>
                </div>
            </slot>

            <div slot="footer">
                <a :href="'mailto:' + organisation.email" class="button is-primary">Contact</a>
                <a class="button is-primary is-outlined" @click="show = false">Terug</a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import OrganisationService from "../../services/OrganisationService.js";

    export default {
        props: ['organisation-id'],

        data() {
            return {
                organisation: {},
                loadingForm: false,
                show: false
            }
        },

        created() {
            Event.$on('show-organisation-modal', (id) => {
                if (this.organisationId === id) {
                    this.getOrganisation(id);
                    this.show = true;
                }
            });
        },
        
        methods: {
            /**
             * Get organisation.
             */

            getOrganisation(id) {
                this.loadingForm = true;

                OrganisationService.show(id).then(({data}) => {
                    this.organisation = data;
                    this.loadingForm = false;
                });
            }
        }
    }
</script>

