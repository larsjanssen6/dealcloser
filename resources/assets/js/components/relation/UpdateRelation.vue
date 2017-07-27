<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>Bewerk {{ fullName }}</p>
            </div>

            <slot>
                <form>
                    <custom-input
                            :value.sync="relation.name"
                            label="Naam"
                            name="name"
                            type="text">
                    </custom-input>

                    <custom-input
                            :value.sync="relation.preposition"
                            label="Tussenvoegsel"
                            name="preposition">
                    </custom-input>

                    <custom-input
                            :value.sync="relation.last_name"
                            label="Achternaam"
                            name="last_name">
                    </custom-input>

                    <custom-input
                            :value.sync="relation.initial"
                            label="Initialen"
                            name="initial">
                    </custom-input>

                    <country-state :prpState="relation.state_code"
                                   :prpCountry="relation.country_code"
                                   @stateChanged="updateState"
                                   @countryChanged="updateCountry">
                    </country-state>

                    <custom-input
                            :value.sync="relation.phone"
                            label="Telefoon"
                            name="phone">
                    </custom-input>

                    <custom-input
                            :value.sync="relation.linkedin"
                            label="Linkedin"
                            name="linkedin">
                    </custom-input>

                    <custom-input
                            :value.sync="relation.email"
                            label="Email"
                            name="email">
                    </custom-input>

                    <custom-input
                            :value.sync="relation.function"
                            label="Functie"
                            name="function">
                    </custom-input>

                    <div class="field">
                        <label for="date_of_birth" class="label">Geboortedatum</label>
                        <date-picker prp-name="date_of_birth"
                                     :prp-date="relation.date_of_birth"
                                     :prp-time="false"
                                     @timeChanged="changeBirthDateTime">
                        </date-picker>
                    </div>

                    <div class="field">
                        <label for="employee_since" class="label">Werknemer sinds</label>
                        <date-picker prp-name="employee_since"
                                     :prp-date="relation.employee_since"
                                     :prp-time="false"
                                     @timeChanged="changeEmployeeSinceTime">
                        </date-picker>
                    </div>

                    <div class="field">
                        <label for="gender" class="label">Man/vrouw</label>

                        <div class="select">
                            <select v-model="relation.gender" id="gender" name="gender" class="input" required>
                                <option value="0" >Vrouw</option>
                                <option value="1">Man</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="organisations_working_at" class="label">Werkzaam bij</label>

                        <multi-select prp-name="organisations_working_at"
                                      :prp-options="organisations"
                                      :prp-selected="relation.organisations_working_at"
                                      prp-placeholder="Kies organisatie(s)"
                                      @optionAdded="addOrganisationsWorkingAtOption"
                                      @optionRemoved="removeOrganisationsWorkingAtOption">
                        </multi-select>
                    </div>

                    <div class="field">
                        <label for="organisations_worked_at" class="label">Gewerkt bij</label>

                        <multi-select prp-name="organisations_worked_at"
                                      :prp-options="organisations"
                                      :prp-selected="relation.organisations_worked_at"
                                      prp-placeholder="Kies organisatie(s)"
                                      @optionAdded="addOrganisationsWorkedAtOption"
                                      @optionRemoved="removeOrganisationsWorkedAtOption">
                        </multi-select>
                    </div>

                    <custom-input
                            :value.sync="relation.working_at"
                            label="Werken bij (anders)"
                            name="working_at">
                    </custom-input>

                    <div class="field">
                        <label for="role_id" class="label">Rol</label>

                        <div class="select">
                            <select v-model="relation.role_id" id="role_id" name="role_id" class="input" required>
                                <option v-for="role in negotiations.roles" v-bind:value="role.id">
                                    {{ role.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="character_id" class="label">Karakter</label>

                        <div class="select">
                            <select v-model="relation.character_id" id="character_id" name="character_id" class="input" required>
                                <option v-for="character in negotiations.characters" v-bind:value="character.id">
                                    {{ character.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="negotiation_profile_id" class="label">Onderhandelingsprofiel</label>

                        <div class="select">
                            <select v-model="relation.negotiation_profile_id" id="negotiation_profile_id" name="negotiation_profile_id" class="input" required>
                                <option v-for="profile in negotiations.profiles" v-bind:value="profile.id">
                                    {{ profile.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="dmu_id" class="label">Dmu (Decision Making Unit)</label>

                        <div class="select">
                            <select v-model="relation.dmu_id" id="dmu_id" name="dmu_id" class="input" required>
                                <option v-for="dmu in negotiations.decision_making_units" v-bind:value="dmu.id">
                                    {{ dmu.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="problem_owner" class="label">Probleem eigenaar</label>

                        <div class="select">
                            <select v-model="relation.problem_owner" id="problem_owner" name="problem_owner" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="relations_internal" class="label">Wie kent deze relatie intern?</label>

                        <multi-select prp-name="relations_internal"
                                      :prp-options="relations"
                                      :prp-selected="relation.relations_internal"
                                      prp-placeholder="Kies relatie(s)"
                                      @optionAdded="addRelationsInternalAtOption"
                                      @optionRemoved="removeRelationsInternalAtOption">
                        </multi-select>
                    </div>

                    <div class="field">
                        <label for="relations_external" class="label">Wie kent deze relatie extern?</label>

                        <multi-select prp-name="relations_exxternal"
                                      :prp-options="relations"
                                      :prp-selected="relation.relations_external"
                                      prp-placeholder="Kies relatie(s)"
                                      @optionAdded="addRelationsExternalAtOption"
                                      @optionRemoved="removeRelationsExternalAtOption">
                        </multi-select>
                    </div>

                    <custom-text-area
                            :value.sync="relation.track_record"
                            label="Ervaringen relatie met onze organisatie"
                            name="track_record">
                    </custom-text-area>

                    <custom-text-area
                            :value.sync="relation.experience_with_us"
                            label="Track record onderhandelen"
                            name="experience_with_us">
                    </custom-text-area>

                    <custom-input
                            :value.sync="relation.hobbies"
                            label="Hobbies"
                            name="hobbies">
                    </custom-input>

                    <div class="field">
                        <label for="married" class="label">Getrouwd/relatie?</label>

                        <div class="select">
                            <select v-model="relation.married" id="married" name="married" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="children" class="label">Kinderen?</label>

                        <div class="select">
                            <select v-model="relation.children" id="children" name="children" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="o3" class="label">Tonen O3?</label>

                        <div class="select">
                            <select v-model="relation.o3" id="o3" name="o3" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="newsletter" class="label">Nieuwsbrief?</label>

                        <div class="select">
                            <select v-model="relation.newsletter" id="newsletter" name="newsletter" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="events" class="label">Events?</label>

                        <div class="select">
                            <select v-model="relation.events" id="events" name="events" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="christmas_card" class="label">Kerstkaart?</label>

                        <div class="select">
                            <select v-model="relation.christmas_card" id="christmas_card" name="events" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="send_email" class="label">Ontvangt email?</label>

                        <div class="select">
                            <select v-model="relation.send_email" id="send_email" name="events" class="input" required>
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
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
    import RelationService from "../../services/RelationService.js";
    import OrganisationService from "../../services/OrganisationService";

    export default {
        props: ['prp-relation', 'negotiations'],

        mixins: [Validation],

        data() {

            /**
             * Init all data.
             */

            return {
                loading: false,
                show: false,
                relation: {},
                relations: [],
                organisations: [],
                options: [],
                RelationService: RelationService
            }
        },

        created() {
            this.relation = this.prpRelation;

            /**
             * Listen for show relation modal event.
             */

            Event.$on('show-relation-modal', (id) => {
                if (this.relation.id === id) {
                    this.getRelations();
                    this.getOrganisations();
                    this.show = true;
                }
            });
        },

        computed: {

            /**
             * Get full name.
             */

            fullName: {
                get() { return this.relation.name + ' ' + (this.relation.preposition === null ? '' : this.relation.preposition)  + ' ' + this.relation.last_name }
            }
        },

        methods: {

            /**
             * Update the relation.
             */

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
                        Event.$emit('thereAreErrors', error.response.data);
                        this.errors = error.response.data;
                        this.loading = false;
                    });
            },

            /**
             * Get all relations/organisations.
             */

            getRelations() {
                RelationService.index().then(({data}) => this.relations = data);
            },

            getOrganisations() {
                OrganisationService.index().then(({data}) => this.organisations = data);
            },

            /**
             * Listen for events.
             */

            updateState(state) {
                this.relation.state_code = state;
            },

            updateCountry(country) {
                this.relation.country_code = country;
            },

            changeBirthDateTime(time) {
                this.relation.date_of_birth = time;
            },

            changeEmployeeSinceTime(time) {
                this.relation.employee_since = time;
            },

            addOrganisationsWorkingAtOption(option) {
                this.relation.organisations_working_at.push(option)
            },

            removeOrganisationsWorkingAtOption(option) {
                this.relation.organisations_working_at = this.relation.organisations_working_at.filter((item) => item.id !== option);
            },

            addOrganisationsWorkedAtOption(option) {
                this.relation.organisations_worked_at.push(option)
            },

            removeOrganisationsWorkedAtOption(option) {
                this.relation.organisations_worked_at = this.relation.organisations_worked_at.filter((item) => item.id !== option);
            },

            addRelationsInternalAtOption(option) {
                this.relation.relations_internal.push(option)
            },

            removeRelationsInternalAtOption(option) {
                this.relation.relations_internal = this.relation.relations_internal.filter((item) => item.id !== option);
            },

            addRelationsExternalAtOption(option) {
                this.relation.relations_external.push(option)
            },

            removeRelationsExternalAtOption(option) {
                this.relation.relations_external = this.relation.relations_external.filter((item) => item.id !== option);
            }
        }
    }
</script>