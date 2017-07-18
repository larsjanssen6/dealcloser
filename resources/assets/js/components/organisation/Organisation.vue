<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>{{ prpOrganisation.name }}</p>
            </div>

            <slot>
                <div class="column">
                    <strong>Accountmanager</strong>
                    <p>{{ prpOrganisation.account_manager }}</p>
                </div>

                <div class="column">
                    <strong>Bedrijfscategorie</strong>
                    <p>{{ prpOrganisation.category.name }}</p>
                </div>

                <div class="column">
                    <strong>Land</strong>
                    <p>{{ prpOrganisation.country_code }}</p>
                </div>

                <div class="column">
                    <strong>Provincie</strong>
                    <p>{{ prpOrganisation.state_code }}</p>
                </div>

                <div class="column">
                    <strong>Verkoopgebied</strong>
                    <p>{{ prpOrganisation.sales_area }}</p>
                </div>

                <div class="column">
                    <strong>Straat</strong>
                    <p>{{ prpOrganisation.street }}</p>
                </div>

                <div class="column">
                    <strong>Nummer</strong>
                    <p>{{ prpOrganisation.house_number }}</p>
                </div>

                <div class="column">
                    <strong>Postcode</strong>
                    <p>{{ prpOrganisation.zip }}</p>
                </div>

                <div class="column">
                    <strong>Plaats</strong>
                    <p>{{ prpOrganisation.town }}</p>
                </div>

                <div class="column">
                    <strong>Telefoon</strong>
                    <p>{{ prpOrganisation.phone }}</p>
                </div>

                <div class="column">
                    <strong>Email</strong>
                    <p><a :href="'mailto:' + prpOrganisation.email">{{ prpOrganisation.email }}</a></p>
                </div>

                <div class="column" v-if="prpOrganisation.linkedin">
                    <strong>Linkedin</strong>
                    <p><a :href="prpOrganisation.linkedin">Profiel</a></p>
                </div>

                <div class="column" v-if="prpOrganisation.website">
                    <strong>Website</strong>
                    <p><a :href="prpOrganisation.website">{{ prpOrganisation.website }}</a></p>
                </div>

                <div class="column" v-if="prpOrganisation.products.length != 0">
                    <strong>Producten</strong>
                    <p>
                         <span class="tag is-warning is-medium" v-for="product in prpOrganisation.products">
                        {{ product.name }}
                    </span>
                    </p>
                </div>
            </slot>

            <div slot="footer">
                <a :href="'mailto:' + prpOrganisation.email" class="button is-primary">Contact</a>
                <a class="button is-primary is-outlined" @click="show = false">Terug</a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    export default {
        props: ['prpOrganisation'],

        data() {
            return {
                show: false,
            }
        },

        created() {
            Event.$on('show-organisation-modal', (id) => {
                if (this.prpOrganisation.id === id) {
                    this.show = true;
                }
            });
        }
    }
</script>

