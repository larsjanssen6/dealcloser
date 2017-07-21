<template>
    <div>
        <datepicker :alignment="'left'"
                    placeholder="Klik voor datum/tijd"
                    :config="{ enableTime: true, dateFormat: 'Y-m-d H:i', static: false, locale: nl }"
                    v-model="date">
        </datepicker>

        <input type="hidden" :name="name" :value="date">
    </div>
</template>

<script>
    import Datepicker from 'vue-bulma-datepicker'

    export default {
        components: {Datepicker},

        props: {
            prpDate: {
                type: String,
                default: "",
            },

            prpName: {
                type: String,
                default: "name",
            }
        },

        created() {
            this.date = this.prpDate;
            this.name = this.prpName;
        },

        data() {
            return {
                nl: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Ma', 'Di', 'Woe', 'Don', 'Vrij', 'Za', 'Zo'],
                        longhand: ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag']
                    },
                    months: {
                        shorthand: ['Jan', 'Feb', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec'],
                        longhand: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December']
                    }
                },

                date: "",
                name: ""
            }
        }
    }
</script>