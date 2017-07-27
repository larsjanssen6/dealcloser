<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>{{ prpRelation.full_name }}</p>
            </div>

            <slot>
                <div class="column">
                    <strong>Voornaam</strong>
                    <p>{{ prpRelation.name }}</p>
                </div>

                <div class="column" v-if="prpRelation.preposition">
                    <strong>Tussenvoegsel</strong>
                    <p>{{ prpRelation.preposition }}</p>
                </div>

                <div class="column">
                    <strong>Achternaam</strong>
                    <p>{{ prpRelation.last_name }}</p>
                </div>

                <div class="column" v-if="prpRelation.initial">
                    <strong>Initiale</strong>
                    <p>{{ prpRelation.initial }}</p>
                </div>

                <div class="column">
                    <strong>Email</strong>
                    <p><a :href="'mailto:' + prpRelation.email">{{ prpRelation.email }}</a></p>
                </div>

                <div class="column" v-if="prpRelation.linkedin">
                    <strong>Linkedin</strong>
                    <p>
                        <a :href="prpRelation.linkedin">{{ prpRelation.linkedin }}</a>
                    </p>
                </div>

                <div class="column" v-if="prpRelation.phone">
                    <strong>Telefoon</strong>
                    <p>{{ prpRelation.phone }}</p>
                </div>

                <div class="column">
                    <strong>Man/vrouw</strong>
                    <p>{{ prpRelation.has_gender }}</p>
                </div>

                <div class="column">
                    <strong>Getrouwd</strong>
                    <p>{{ prpRelation.is_married }}</p>
                </div>

                <div class="column" v-if="prpRelation.country_code">
                    <strong>Landcode</strong>
                    <p>{{ prpRelation.country_code }}</p>
                </div>

                <div class="column" v-if="prpRelation.state_code">
                    <strong>Provincie</strong>
                    <p>{{ prpRelation.state_code }}</p>
                </div>

                <div class="column">
                    <strong>Functie</strong>
                    <p>{{ prpRelation.function }}</p>
                </div>

                <div class="column" v-if="prpRelation.employee_since">
                    <strong>Werknemer sinds</strong>
                    <p>{{ prpRelation.employee_since }}</p>
                </div>

                <div class="column" v-if="prpRelation.date_of_birth">
                    <strong>Geboortedatum</strong>
                    <p>{{ prpRelation.date_of_birth }}</p>
                </div>

                <div class="column">
                    <strong>Rol</strong>
                    <p>{{ prpRelation.role.name }}</p>
                </div>

                <div class="column">
                    <strong>Karakter</strong>
                    <p>{{ prpRelation.character.name }}</p>
                </div>

                <div class="column">
                    <strong>Onderhandelings profiel</strong>
                    <p>{{ prpRelation.negotiation_profile.name }}</p>
                </div>

                <div class="column">
                    <strong>DMU</strong>
                    <p>{{ prpRelation.dmu.name }}</p>
                </div>

                <div class="column" v-if="prpRelation.relations_internal != 0">
                    <strong>Relaties intern</strong>

                    <p>
                        <span class="tag is-success" v-for="relation in prpRelation.relations_internal">
                            {{ relation.full_name }}
                        </span>
                    </p>
                </div>

                <div class="column" v-if="prpRelation.relations_external.length != 0">
                    <strong>Relaties extern</strong>

                    <p>
                        <span class="tag is-success" v-for="relation in prpRelation.relations_external">
                            {{ relation.full_name }}
                        </span>
                    </p>
                </div>

                <div class="column">
                    <strong>Probleem eigenaar</strong>
                    <p>{{ prpRelation.is_problem_owner }}</p>
                </div>

                <div class="column" v-if="prpRelation.organisations_working_at != 0">
                    <strong>Werkzaam bij</strong>

                    <p>
                        <span class="tag is-success" v-for="organisation in prpRelation.organisations_working_at">
                            {{ organisation.name }}
                        </span>
                    </p>
                </div>

                <div class="column" v-if="prpRelation.organisations_worked_at != 0">
                    <strong>Voorheen gewerkt bij</strong>

                    <p>
                        <span class="tag is-success" v-for="organisation in prpRelation.organisations_worked_at">
                            {{ organisation.name }}
                        </span>
                    </p>
                </div>

                <div class="column" v-if="prpRelation.worked_at">
                    <strong>Voorheen gewerkt bij (anders)</strong>
                    <p>{{ prpRelation.worked_at }}</p>
                </div>

                <div class="column" v-if="prpRelation.is_married">
                    <strong>Hobbies</strong>
                    <p>{{ prpRelation.is_married }}</p>
                </div>

                <div class="column">
                    <strong>Kinderen</strong>
                    <p>{{ prpRelation.has_children }}</p>
                </div>

                <div class="column">
                    <strong>Nieuwsbrief</strong>
                    <p>{{ prpRelation.wants_newsletter }}</p>
                </div>

                <div class="column">
                    <strong>O3</strong>
                    <p>{{ prpRelation.is_o3 }}</p>
                </div>

                <div class="column">
                    <strong>Events</strong>
                    <p>{{ prpRelation.wants_events }}</p>
                </div>

                <div class="column">
                    <strong>Verstuur email</strong>
                    <p>{{ prpRelation.wants_email }}</p>
                </div>

                <div class="column">
                    <strong>Kerstkaart</strong>
                    <p>{{ prpRelation.wants_christmas_card }}</p>
                </div>

                <div class="column" v-if="prpRelation.experience_with_us">
                    <strong>Ervaringen relatie met onze organisatie</strong>
                    <p>{{ prpRelation.experience_with_us }}</p>
                </div>

                <div class="column" v-if="prpRelation.track_record">
                    <strong>Track record onderhandelen</strong>
                    <p>{{ prpRelation.track_record }}</p>
                </div>

                <div class="column">
                    <strong>Aangemaakt op</strong>
                    <p>{{ prpRelation.created_at }}</p>
                </div>
            </slot>

            <div slot="footer">
                <button id="submit"
                        class="button is-primary"
                        @click="edit">
                    Bewerk
                </button>

                <destroy :service="RelationService" :id="prpRelation.id"></destroy>

                <a class="button is-primary is-outlined"
                   @click="show = false">
                    Annuleer
                </a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import RelationService from "../../services/RelationService.js";

    export default {
        props: ['prp-relation'],

        data() {
            return {
                show: false,
                RelationService: RelationService,
            }
        },

        created() {
            Event.$on('show-relation-modal', (id) => {
                if (this.prpRelation.id === id) {
                    this.show = true;
                }
            });
        },

        methods: {
            edit() {
                window.location.href = '/bewerk/' + this.prpRelation.id;
            }
        }
    }
</script>

