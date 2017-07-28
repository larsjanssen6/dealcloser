<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p v-if="loadingForm">.....</p>
                <p v-else>{{ relation.full_name }}</p>
            </div>

            <slot>
                <div v-if="loadingForm">
                    <p>Laden...</p>
                </div>

                <div v-else>
                    <div class="column">
                        <strong>Voornaam</strong>
                        <p>{{ relation.name }}</p>
                    </div>

                    <div class="column" v-if="relation.preposition">
                        <strong>Tussenvoegsel</strong>
                        <p>{{ relation.preposition }}</p>
                    </div>

                    <div class="column">
                        <strong>Achternaam</strong>
                        <p>{{ relation.last_name }}</p>
                    </div>

                    <div class="column" v-if="relation.initial">
                        <strong>Initiale</strong>
                        <p>{{ relation.initial }}</p>
                    </div>

                    <div class="column">
                        <strong>Email</strong>
                        <p><a :href="'mailto:' + relation.email">{{ relation.email }}</a></p>
                    </div>

                    <div class="column" v-if="relation.linkedin">
                        <strong>Linkedin</strong>
                        <p>
                            <a :href="relation.linkedin">{{ relation.linkedin }}</a>
                        </p>
                    </div>

                    <div class="column" v-if="relation.phone">
                        <strong>Telefoon</strong>
                        <p>{{ relation.phone }}</p>
                    </div>

                    <div class="column">
                        <strong>Man/vrouw</strong>
                        <p>{{ relation.has_gender }}</p>
                    </div>

                    <div class="column">
                        <strong>Getrouwd</strong>
                        <p>{{ relation.is_married }}</p>
                    </div>

                    <div class="column" v-if="relation.country_code">
                        <strong>Landcode</strong>
                        <p>{{ relation.country_code }}</p>
                    </div>

                    <div class="column" v-if="relation.state_code">
                        <strong>Provincie</strong>
                        <p>{{ relation.state_code }}</p>
                    </div>

                    <div class="column">
                        <strong>Functie</strong>
                        <p>{{ relation.function }}</p>
                    </div>

                    <div class="column" v-if="relation.employee_since">
                        <strong>Werknemer sinds</strong>
                        <p>{{ relation.employee_since }}</p>
                    </div>

                    <div class="column" v-if="relation.date_of_birth">
                        <strong>Geboortedatum</strong>
                        <p>{{ relation.date_of_birth }}</p>
                    </div>

                    <div class="column">
                        <strong>Rol</strong>
                        <p>{{ relation.role.name }}</p>
                    </div>

                    <div class="column">
                        <strong>Karakter</strong>
                        <p>{{ relation.character.name }}</p>
                    </div>

                    <div class="column">
                        <strong>Onderhandelings profiel</strong>
                        <p>{{ relation.negotiation_profile.name }}</p>
                    </div>

                    <div class="column">
                        <strong>DMU</strong>
                        <p>{{ relation.dmu.name }}</p>
                    </div>

                    <div class="column" v-if="relation.relations_internal != 0">
                        <strong>Relaties intern</strong>

                        <p>
                        <span class="tag is-success" v-for="relation in relation.relations_internal">
                            {{ relation.full_name }}
                        </span>
                        </p>
                    </div>

                    <div class="column" v-if="relation.relations_external.length != 0">
                        <strong>Relaties extern</strong>

                        <p>
                        <span class="tag is-success" v-for="relation in relation.relations_external">
                            {{ relation.full_name }}
                        </span>
                        </p>
                    </div>

                    <div class="column">
                        <strong>Probleem eigenaar</strong>
                        <p>{{ relation.is_problem_owner }}</p>
                    </div>

                    <div class="column" v-if="relation.organisations_working_at != 0">
                        <strong>Werkzaam bij</strong>

                        <p>
                        <span class="tag is-success" v-for="organisation in relation.organisations_working_at">
                            {{ organisation.name }}
                        </span>
                        </p>
                    </div>

                    <div class="column" v-if="relation.organisations_worked_at != 0">
                        <strong>Voorheen gewerkt bij</strong>

                        <p>
                        <span class="tag is-success" v-for="organisation in relation.organisations_worked_at">
                            {{ organisation.name }}
                        </span>
                        </p>
                    </div>

                    <div class="column" v-if="relation.worked_at">
                        <strong>Voorheen gewerkt bij (anders)</strong>
                        <p>{{ relation.worked_at }}</p>
                    </div>

                    <div class="column" v-if="relation.is_married">
                        <strong>Hobbies</strong>
                        <p>{{ relation.is_married }}</p>
                    </div>

                    <div class="column">
                        <strong>Kinderen</strong>
                        <p>{{ relation.has_children }}</p>
                    </div>

                    <div class="column">
                        <strong>Nieuwsbrief</strong>
                        <p>{{ relation.wants_newsletter }}</p>
                    </div>

                    <div class="column">
                        <strong>O3</strong>
                        <p>{{ relation.is_o3 }}</p>
                    </div>

                    <div class="column">
                        <strong>Events</strong>
                        <p>{{ relation.wants_events }}</p>
                    </div>

                    <div class="column">
                        <strong>Verstuur email</strong>
                        <p>{{ relation.wants_email }}</p>
                    </div>

                    <div class="column">
                        <strong>Kerstkaart</strong>
                        <p>{{ relation.wants_christmas_card }}</p>
                    </div>

                    <div class="column" v-if="relation.experience_with_us">
                        <strong>Ervaringen relatie met onze organisatie</strong>
                        <p>{{ relation.experience_with_us }}</p>
                    </div>

                    <div class="column" v-if="relation.track_record">
                        <strong>Track record onderhandelen</strong>
                        <p>{{ relation.track_record }}</p>
                    </div>

                    <div class="column">
                        <strong>Aangemaakt op</strong>
                        <p>{{ relation.created_at }}</p>
                    </div>
                </div>
            </slot>

            <div slot="footer">
                <a :href="'mailto:' + relation.email" class="button is-primary">Contact</a>
                <a class="button is-primary is-outlined" @click="show = false">Terug</a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import RelationService from "../../services/RelationService.js";

    export default {
        props: ['relation-id'],

        data() {
            return {
                loadingForm: false,
                relation: {},
                show: false,
                RelationService: RelationService,
            }
        },

        created() {
            Event.$on('show-relation-modal', (id) => {
                if (this.relationId === id) {
                    this.getRelation(id);
                    this.show = true;
                }
            });
        },

        methods: {

            /**
             * Get relation.
             */

            getRelation(id) {
                this.loadingForm = true;
                RelationService.show(id).then(({data}) => {
                    this.relation = data;
                    this.loadingForm = false;
                });
            },
        }
    }
</script>

