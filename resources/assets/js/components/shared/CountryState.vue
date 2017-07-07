<template>
    <div class="field">
        <div class="field">
            <label for="country" class="label">{{ countryName }}</label>

            <div v-if="countries">
                <select id="country" :name="countryNameInput"
                        class="input" v-model="country" @change="getStates($event)">
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
                    class="input" v-model="state">
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
                default: () => []
            },

            state: {
                default: () => ""
            },

            country: {
                default: () => ""
            },

            countryName: {
                default: () => "Land"
            },

            stateName: {
                default: () => "Provincie"
            },

            countryNameInput: {
                default: () => "country"
            },

            stateNameInput: {
                default: () => "state"
            }
        } ,

        data() {
            return {
                states: []
            }
        },

        methods: {
            getStates($event) {
                StateService.index($event.target.value)
                    .then(({data}) => {
                        this.states = data;
                    })
            }
        }
    }
</script>