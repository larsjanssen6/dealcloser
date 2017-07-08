<template>
    <div class="field">
        <div class="field">
            <label for="country" class="label">{{ countryName }}</label>

            <div v-if="countries">
                <select id="country" :name="countryNameInput"
                        class="input" v-model="country" @change="getStates($event.target.value)" required>
                    <option disabled value="">Selecteer een land</option>

                    <option v-for="(country, key) in countries" :value="key">
                        {{ country }}
                    </option>
                </select>
            </div>

            <p v-else>Er zijn geen landen.</p>
        </div>

        <div class="field" v-if="country">
            <label for="state" class="label">{{ stateName }}</label>

            <select id="state" :name="stateNameInput"
                    class="input" v-model="state" required>
                <option disabled value="">Selecteer een provincie</option>

                <option v-for="(state, key) in states" :value="key">
                    {{ state }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
    import StateService from '../../services/StateService';

    export default {
        props: {
            countries: {
                type: Object,
                default: []
            },

            prpState: {
                type: String,
                default: "NH"
            },

            prpCountry: {
                type: String,
                default: "NL"
            },

            countryName: {
                type: String,
                default: "Land"
            },

            stateName: {
                type: String,
                default: "Provincie"
            },

            countryNameInput: {
                type: String,
                default: "country_code"
            },

            stateNameInput: {
                type: String,
                default: "state_code"
            }
        } ,

        data() {
            return {
                states: [],
                country: "",
                state: ""
            }
        },

        created() {
            this.country = this.prpCountry;
            this.state = this.prpState;
            this.getStates(this.country);
        },

        methods: {
            getStates(state) {
                StateService.index(state)
                    .then(({data}) => {
                        this.states = data;
                    })
            }
        }
    }
</script>