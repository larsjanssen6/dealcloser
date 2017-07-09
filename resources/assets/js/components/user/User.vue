<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>{{ prpUser.name }} {{ prpUser.last_name }}</p>
            </div>

            <slot>
                <div class="column">
                    <strong>Voornaam</strong>
                    <p>{{ prpUser.name }}</p>
                </div>

                <div class="column">
                    <strong>Achternaam</strong>
                    <p>{{ prpUser.last_name }}</p>
                </div>

                <div class="column">
                    <strong>Functie</strong>
                    <p>{{ prpUser.function }}</p>
                </div>

                <div class="column">
                    <strong>Email</strong>
                    <p><a :href="'mailto:' + prpUser.email">{{ prpUser.email }}</a></p>
                </div>

                <div class="column">
                    <strong>Afdeling</strong>
                    <p>
                        <span class="tag is-success">
                            {{ prpUser.department.name }}
                        </span>
                    </p>
                </div>

                <div class="column">
                    <strong>Role</strong>

                    <p>
                        <span class="tag is-success" v-for="role in prpUser.roles">
                            {{ role.name }}
                        </span>
                    </p>
                </div>
            </slot>

            <div slot="footer">
                <a :href="'mailto:' + prpUser.email" class="button is-primary">Contact</a>
                <a class="button is-primary is-outlined" @click="show = false">Annuleer</a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    export default {
        props: ['prp-user'],

        data() {
            return {
                show: false,
            }
        },

        created() {
            Event.$on('show-user-modal', (id) => {
                if (this.prpUser.id === id) {
                    this.show = true;
                }
            });
        }
    }
</script>

