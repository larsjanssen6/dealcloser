<template>
    <div v-if="show">
        <modal-card @close="show = false">
            <div slot="title">
                <p>Bewerk {{ user.name }} {{ user.last_name }}</p>
            </div>

            <slot>
                <form>
                    <div class="control">
                        <label for="name" class="label">Naam:</label>

                        <input id="name"
                               name="name"
                               type="text"
                               v-model="user.name"
                               class="input"
                               :class="{ 'is-danger': errorsHas('name') }"
                               autofocus>

                        <p class="help is-danger" v-if="errorsHas('name')">{{ error('name') }}</p>
                    </div>

                    <div class="control">
                        <label for="last_name" class="label">Achternaam:</label>

                        <input id="last_name"
                               name="last_name"
                               type="text"
                               v-model="user.last_name"
                               class="input"
                               :class="{ 'is-danger': errorsHas('last_name') }">

                        <p class="help is-danger" v-if="errorsHas('last_name')">{{ error('last_name') }}</p>
                    </div>

                    <div class="control">
                        <label for="email" class="label">Email:</label>

                        <input id="email"
                               name="email"
                               type="text"
                               v-model="user.email"
                               class="input"
                               :class="{ 'is-danger': errorsHas('email') }">

                        <p class="help is-danger" v-if="errorsHas('email')">{{ error('email') }}</p>
                    </div>

                    <div class="field">
                        <label for="password" class="label">Wachtwoord</label>

                        <p class="control has-icons-left">
                            <input id="password"
                                   name="password"
                                   type="password"
                                   placeholder="**********"
                                   v-model="user.password"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('password') }">

                            <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>

                        <p class="help is-danger" v-if="errorsHas('password')">{{ error('password') }}</p>
                    </div>

                    <div class="field">
                        <label for="password_confirmation" class="label">Bevestig wachtwoord</label>

                        <p class="control has-icons-left">
                            <input id="password_confirmation"
                                   name="password_confirmation"
                                   type="password"
                                   placeholder="**********"
                                   v-model="user.password_confirmation"
                                   class="input"
                                   :class="{ 'is-danger': errorsHas('password_confirmation') }">

                            <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>

                        <p class="help is-danger" v-if="errorsHas('password_confirmation')">{{
                            error('password_confirmation') }}</p>
                    </div>

                    <div class="control">
                        <label for="function" class="label">Functie:</label>

                        <input id="function"
                               name="function"
                               type="text"
                               v-model="user.function"
                               class="input"
                               :class="{ 'is-danger': errorsHas('function') }">

                        <p class="help is-danger" v-if="errorsHas('function')">{{ error('function') }}</p>
                    </div>

                    <div class="field">
                        <label for="department_id" class="label">Afdeling</label>

                        <select id="department_id" name="department_id"
                                class="input" :class="{ 'is-danger': errorsHas('department_id') }"
                                v-model="user.department_id">
                            <option disabled value="">Selecteer een afdeling</option>

                            <option v-for="department in prpDepartments" :value="department.id">
                                {{ department.name }}
                            </option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="role" class="label">Rol</label>

                        <select id="role" name="role"
                                class="input" :class="{ 'is-danger': errorsHas('role') }" v-model="user.role">
                            <option disabled value="">Selecteer een rol</option>

                            <option v-for="role in prpRoles" :value="role.name">
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
                </form>
            </slot>

            <div slot="footer">
                <button id="submit"
                        class="button is-primary"
                        :class="{ 'is-loading': loading }"
                        @click="update">
                    Update
                </button>

                <a class="button is-primary is-outlined"
                   @click="show = false">
                    Annuleer
                </a>
            </div>
        </modal-card>
    </div>
</template>

<script>
    import ModalCard from '../shared/ModalCard.vue';
    import UserService from '../../services/UserService';
    import DepartmentService from '../../services/DepartmentService';
    import Validation from '../../mixins/validation.js';

    export default {
        component: {ModalCard},

        props: ['prp-user', 'prp-departments', 'prp-roles'],

        mixins: [Validation],

        data() {
            return {
                loading: false,
                show: false,
                user: {role: ""}
            }
        },

        created() {
            this.user = this.prpUser;

            /*
             | Set the first role on the user object. Maybe in the future
             | a user can have multiple roles.
             */

            this.user.role = this.prpUser.roles[0].name;

            Event.$on('show-user-modal', (id) => {
                if (this.user.id === id) {
                    this.show = true;
                }
            });
        },

        methods: {
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
            }
        }
    }
</script>