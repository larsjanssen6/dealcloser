<template>
    <div>
        <div class="column is-1">
            <a class="button is-primary" v-for="role in roles" style="margin-bottom: 5px;">
                <span class="icon is-small" @click="edit(role)">
                    <i class="fa fa-pencil-square-o"></i>
                </span>

                <span class="icon is-small" @click="destroy(role)">
                    <i class="fa fa-trash-o"></i>
                </span> &nbsp;

                <p v-text="role.name"></p>
            </a>
        </div>
    </div>
</template>

<script>
    import RoleService from '../../services/RoleService';

    export default {
        props: ['prp-roles'],

        created() {
            this.roles = this.prpRoles;
        },

        data() {
            return {
                roles: []
            }
        },

        methods: {
            destroy(role) {
                swal({
                    title: 'Weet u het zeker?',
                    text: 'Gebruikers raken deze rol kwijt.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ja verwijder rol',
                    cancelButtonText: 'Annuleer'
                }).then(() => {
                    RoleService.destroy(role.id)
                        .then(({data}) => {
                            swal(({
                                title: 'Verwijderd',
                                text: data.status,
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            }));

                            this.roles = this.roles.filter((item) => item.id != role.id);
                        })
                        .catch(error => {
                            let message = Object.keys(error.response.data)[0];

                            swal(
                                'Geannuleerd',
                                error.response.data[message],
                                'error'
                            )
                        });

                }, (dismiss) => {
                    if (dismiss === 'cancel') {
                        swal(
                            'Geannuleerd',
                            'Rol niet verwijderd.',
                            'error'
                        )
                    }
                })
            },

            edit(role) {
                swal({
                    title: 'Update rol',
                    input: 'text',
                    inputValue: role.name,
                    confirmButtonText: 'Update',
                    showLoaderOnConfirm: true,
                    preConfirm: (value) => {
                        role.name = value;
                        return new Promise((resolve, reject) => {
                            RoleService.update(role)
                                .then(({data}) => {
                                    swal(({
                                        title: 'Geupdatet',
                                        text: data.status,
                                        type: 'success',
                                        showConfirmButton: false,
                                        timer: 1000
                                    }));
                                })
                                .catch(error => {
                                    let message = Object.keys(error.response.data)[0];
                                    reject(error.response.data[message][0]);
                                });
                        })
                    },
                    allowOutsideClick: true
                });
            }
        }
    }
</script>