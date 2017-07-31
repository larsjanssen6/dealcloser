<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p v-if="loadingForm">.....</p>
                <p v-else>{{ user.fullName }}</p>
            </div>

            <slot>
                <div v-if="loadingForm">
                    <p>Laden...</p>
                </div>

                <div v-else>
                    <div class="column">
                        <strong>Voornaam</strong>
                        <p>{{ user.name }}</p>
                    </div>

                    <div class="column" v-if="user.preposition">
                        <strong>Tussenvoegsel</strong>
                        <p>{{ user.preposition }}</p>
                    </div>

                    <div class="column">
                        <strong>Achternaam</strong>
                        <p>{{ user.last_name }}</p>
                    </div>

                    <div class="column">
                        <strong>Functie</strong>
                        <p>{{ user.function }}</p>
                    </div>

                    <div class="column">
                        <strong>Email</strong>
                        <p><a :href="'mailto:' + user.email">{{ user.email }}</a></p>
                    </div>

                    <div class="column">
                        <strong>Afdeling</strong>
                        <p>
                        <span class="tag is-success">
                            {{ user.department.name }}
                        </span>
                        </p>
                    </div>

                    <div class="column">
                        <strong>Role</strong>

                        <p>
                        <span class="tag is-success" v-for="role in user.roles">
                            {{ role.name }}
                        </span>
                        </p>
                    </div>
                </div>
            </slot>

            <div slot="footer">
                <a :href="'mailto:' + user.email" class="button is-primary">Contact</a>
                <a class="button is-primary is-outlined" @click="show = false">Terug</a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import UserService from "../../services/UserService";

    export default {
        props: ['user-id'],

        data() {
            return {
                show: false,
                user: {}
            }
        },

        created() {
            Event.$on('show-user-modal', (id) => {
                if (this.userId === id) {
                    this.getUser(id);
                    this.show = true;
                }
            });
        },

        methods: {

            /**
             * Get user.
             */

            getUser(id) {
                this.loadingForm = true;

                UserService.show(id).then(({data}) => {
                    this.user = data;
                    this.loadingForm = false;
                });
            },
        }
    }
</script>

