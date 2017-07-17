<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>{{ prpRelation.organisation }}</p>
            </div>

            <slot>
                <div class="column">
                    <strong>Accountmanager</strong>
                    <p>{{ prpRelation.account_manager }}</p>
                </div>

                <div class="column">
                    <strong>Bedrijfscategorie</strong>
                    <p>{{ prpRelation.category.name }}</p>
                </div>

                <div class="column">
                    <strong>Land</strong>
                    <p>{{ prpRelation.country_code }}</p>
                </div>

                <div class="column">
                    <strong>Provincie</strong>
                    <p>{{ prpRelation.state_code }}</p>
                </div>

                <div class="column">
                    <strong>Verkoopgebied</strong>
                    <p>{{ prpRelation.sales_area }}</p>
                </div>

                <div class="column">
                    <strong>Straat</strong>
                    <p>{{ prpRelation.street }}</p>
                </div>

                <div class="column">
                    <strong>Nummer</strong>
                    <p>{{ prpRelation.house_number }}</p>
                </div>

                <div class="column">
                    <strong>Postcode</strong>
                    <p>{{ prpRelation.zip }}</p>
                </div>

                <div class="column">
                    <strong>Plaats</strong>
                    <p>{{ prpRelation.town }}</p>
                </div>

                <div class="column">
                    <strong>Telefoon</strong>
                    <p>{{ prpRelation.phone }}</p>
                </div>

                <div class="column">
                    <strong>Email</strong>
                    <p><a :href="'mailto:' + prpRelation.email">{{ prpRelation.email }}</a></p>
                </div>

                <div class="column" v-if="prpRelation.linkedin">
                    <strong>Linkedin</strong>
                    <p><a :href="prpRelation.linkedin">Profiel</a></p>
                </div>

                <div class="column" v-if="prpRelation.website">
                    <strong>Website</strong>
                    <p><a :href="prpRelation.website">{{ prpRelation.website }}</a></p>
                </div>

                <div class="column" v-if="prpRelation.products.length != 0">
                    <strong>Producten</strong>
                    <p>
                         <span class="tag is-warning is-medium" v-for="product in prpRelation.products">
                        {{ product.name }}
                    </span>
                    </p>
                </div>
            </slot>

            <div slot="footer">
                <a :href="'mailto:' + prpRelation.email" class="button is-primary">Contact</a>
                <a class="button is-primary is-outlined" @click="show = false">Terug</a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    export default {
        props: ['prpRelation'],

        data() {
            return {
                show: false,
            }
        },

        created() {
            Event.$on('show-relation-modal', (id) => {
                if (this.prpRelation.id === id) {
                    this.show = true;
                }
            });
        }
    }
</script>

