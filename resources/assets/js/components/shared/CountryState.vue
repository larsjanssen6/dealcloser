<template>
    <div class="field">
        <div class="field">
            <label for="country_code" class="label">{{ countryName }}</label>

            <div v-if="countries">
                <select id="country_code" name="country_code"
                        class="input" v-model="country" @change="$emit('countryChanged', $event.target.value) && getStates($event.target.value)" required>
                    <option disabled value="">Selecteer een land</option>

                    <option v-for="(country, key) in countries" :value="key">
                        {{ country }}
                    </option>
                </select>
            </div>

            <p v-else>Er zijn geen landen.</p>
        </div>

        <div class="field" v-if="country">
            <label for="state_code" class="label">{{ stateName }}</label>

            <select id="state_code" name="state_code"
                    class="input" v-model="state" @change="$emit('stateChanged', $event.target.value)" required>
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
    import CountryService from '../../services/CountryService';

    export default {
        props: {
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
            }
        } ,

        data() {
            return {
                states: [],
                countries: [],
                country: "",
                state: ""
            }
        },

        created() {
            this.country = this.prpCountry;
            this.state = this.prpState;
            this.getCountries();
            this.getStates(this.country);
        },

        methods: {
            getStates(state) {
                StateService.index(state)
                    .then(({data}) => {
                        this.states = data;
                    })
            },

            getCountries() {
                CountryService.index()
                    .then(({data}) => {
                        this.countries = data;
                    })
            }
        }
    }
</script>