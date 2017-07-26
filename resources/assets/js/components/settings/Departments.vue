<template>
    <div>
        <div class="column is-1">
            <a class="button is-primary" v-for="department in departments" style="margin-bottom: 5px;">
                <span class="icon is-small" @click="edit(department)">
                    <i class="fa fa-pencil-square-o"></i>
                </span>

                <span class="icon is-small" @click="destroy(department)">
                    <i class="fa fa-trash-o"></i>
                </span> &nbsp;

                <p v-text="department.name"></p>
            </a>
        </div>
    </div>
</template>

<script>
    import DepartmentService from '../../services/DepartmentService';

    export default {
        props: ['prp-departments'],

        created() {
            this.departments = this.prpDepartments;
        },

        data() {
            return {
                departments: []
            }
        },

        methods: {
            destroy(department) {
                swal({
                    title: 'Weet u het zeker?',
                    text: 'Koppel gebruikers eerst aan een andere afdeling',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ja verwijder afdeling',
                    cancelButtonText: 'Annuleer'
                }).then(() => {
                    DepartmentService.destroy(department.id)
                        .then(({data}) => {
                            swal(({
                                title: 'Verwijderd',
                                text: data.status,
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            }));

                            this.departments = this.departments.filter((item) => item.id != department.id);
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
                            'Afdeling niet verwijderd.',
                            'error'
                        )
                    }
                })
            },

            edit(department) {
                swal({
                    title: 'Update afdeling',
                    input: 'text',
                    inputValue: department.name,
                    confirmButtonText: 'Update',
                    showLoaderOnConfirm: true,
                    preConfirm: (value) => {
                        department.name = value;
                        return new Promise((resolve, reject) => {
                            DepartmentService.update(department)
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