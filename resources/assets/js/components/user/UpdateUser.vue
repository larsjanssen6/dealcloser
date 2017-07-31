<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p v-if="loadingForm">.....</p>
                <p v-else>Bewerk {{ fullName }}</p>
            </div>

            <slot>
                <form>
                    <div v-if="loadingForm">
                        <p>Gebruiker aan het inladen...</p>
                    </div>

                    <div v-else>
                        <custom-input
                                :value.sync="user.name"
                                label="Naam"
                                name="name"
                                type="text">
                        </custom-input>

                        <custom-input
                                :value.sync="user.preposition"
                                label="Tussenvoegsel"
                                name="preposition"
                                type="text">
                        </custom-input>

                        <custom-input
                                :value.sync="user.last_name"
                                label="Achternaam"
                                name="last_name"
                                type="text">
                        </custom-input>

                        <custom-input
                                :value.sync="user.email"
                                label="Email"
                                name="email"
                                type="text">
                        </custom-input>

                        <div class="field">
                            <label for="password" class="label">Wachtwoord</label>

                            <div class="control">
                                <input id="password"
                                       name="password"
                                       type="password"
                                       placeholder="**********"
                                       v-model="user.password"
                                       class="input"
                                       :class="{ 'is-danger': errorsHas('password') }">

                                <p class="help is-danger" v-if="errorsHas('password')">{{ error('password') }}</p>
                            </div>
                        </div>

                        <div class="field">
                            <label for="password_confirmation" class="label">Bevestig wachtwoord</label>

                            <div class="control">
                                <input id="password_confirmation"
                                       name="password_confirmation"
                                       type="password"
                                       placeholder="**********"
                                       v-model="user.password_confirmation"
                                       class="input"
                                       :class="{ 'is-danger': errorsHas('password_confirmation') }">

                                <p class="help is-danger" v-if="errorsHas('password_confirmation')">{{
                                    error('password_confirmation') }}</p>
                            </div>
                        </div>

                        <custom-input
                                :value.sync="user.function"
                                label="Functie"
                                name="function"
                                type="text">
                        </custom-input>

                        <div class="field">
                            <label for="department_id" class="label">Afdeling</label>

                            <select id="department_id" name="department_id"
                                    class="input" :class="{ 'is-danger': errorsHas('department_id') }"
                                    v-model="user.department_id">
                                <option disabled value="">Selecteer een afdeling</option>

                                <option v-for="department in departments" :value="department.id">
                                    {{ department.name }}
                                </option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="role" class="label">Rol</label>

                            <select id="role" name="role"
                                    class="input" :class="{ 'is-danger': errorsHas('role') }" v-model="user.role">
                                <option disabled value="">Selecteer een rol</option>

                                <option v-for="role in roles" :value="role.name">
                                    {{ role.name }}
                                </option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="active" class="label">Actief</label>

                            <select id="active"
                                    name="active"
                                    class="input"
                                    :class="{ 'is-danger': errorsHas('active') }"
                                    v-model="user.active">

                                <option selected disabled>Selecteer Ja of Nee</option>

                                <option value="1">Ja</option>
                                <option value="0">Nee</option>
                            </select>
                        </div>
                    </div>
                </form>
            </slot>

            <div slot="footer">
                <div v-if="loadingForm">
                    <a class="button is-primary is-outlined"
                       @click="show = false">
                        Annuleer
                    </a>
                </div>

                <div v-else>
                    <button id="submit"
                            class="button is-primary"
                            :class="{ 'is-loading': loading }"
                            @click="update">
                        Update
                    </button>

                    <destroy :service="UserService" :id="user.id"></destroy>

                    <a class="button is-primary is-outlined"
                       @click="show = false">
                        Annuleer
                    </a>
                </div>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import Validation from '../../mixins/validation.js';
    import RoleService from "../../services/RoleService";
    import UserService from '../../services/UserService';
    import ProductService from '../../services/ProductService';
    import DepartmentService from '../../services/DepartmentService';

    export default {
        props: ['user-id'],

        mixins: [Validation],

        data() {
            return {
                loadingForm: false,
                loading: false,
                show: false,
                departments: [],
                roles: [],
                products: [],
                user: { role: "" },
                UserService: UserService
            }
        },

        created() {

            /**
             * Listen for show user modal event.
             */

            Event.$on('show-user-modal', (id) => {
                if (this.userId === id) {
                    this.getUser(id);
                    this.show = true;
                }
            });
        },

        computed: {

            /**
             * Get full name.
             */

            fullName: {
                get() { return this.user.name + ' ' + (this.user.preposition === null ? '' : this.user.preposition)  + ' ' + this.user.last_name }
            }
        },

        methods: {

            /**
             * Update the user.
             */

            update() {
                this.loading = true;

                UserService.update(this.user)
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
                        this.loading = false;
                        this.errors = error.response.data;
                    });
            },

            /**
             * Get user.
             */

            getUser(id) {
                this.loadingForm = true;

                UserService.show(id).then(({data}) => {
                    this.user = data;

                    this.getDepartments();
                    this.getRoles();

                    /**
                     * Take first role of roles. Maybe in the future
                     * a user can have multiple roles.
                     */

                    this.user.role = this.user.roles[0].name;

                    this.loadingForm = false;
                });
            },

            /**
             * Get all departments.
             */

            getDepartments() {
                DepartmentService.index().then(({data}) => this.departments = data);
            },

            /**
             * Get all roles.
             */

            getRoles() {
                RoleService.index().then(({data}) => this.roles = data);
            }
        }
    }
</script>