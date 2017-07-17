<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>{{ prpProduct.name }}</p>
            </div>

            <slot>
                <div class="column">
                    <strong>Omschrijving</strong>
                    <p>{{ prpProduct.description | capitalize }}</p>
                </div>

                <div class="column">
                    <strong>Verkoopprijs</strong>
                    <p>{{ prpProduct.price | currency }}</p>
                </div>

                <div class="column">
                    <strong>Aantal</strong>
                    <p>{{ prpProduct.amount }}</p>
                </div>

                <div class="column">
                    <strong>Omzet</strong>
                    <p>{{ prpProduct.revenue | currency }}</p>
                </div>

                <div class="column">
                    <strong>Inkoopprijs</strong>
                    <p>{{ prpProduct.purchase | currency }}</p>
                </div>

                <div class="column">
                    <strong>Totale inkoop</strong>
                    <p>{{ prpProduct.totalPurchase | currency}}</p>
                </div>

                <div class="column">
                    <strong>Bruto marge</strong>
                    <p>{{ prpProduct.grossMargin | currency }}</p>
                </div>
            </slot>

            <div slot="footer">
                <a class="button is-primary is-outlined" @click="show = false">Terug</a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    export default {
        props: ['prpProduct'],

        data() {
            return {
                show: false,
            }
        },

        created() {
            Event.$on('show-product-modal', (id) => {
                if (this.prpProduct.id === id) {
                    this.show = true;
                }
            });
        }
    }
</script>

