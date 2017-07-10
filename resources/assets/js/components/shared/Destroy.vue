<template>
    <button id="destroy"
            class="button is-danger"
            @click="destroy">
        Verwijder
    </button>
</template>

<script>
    export default {
        props:['service', 'id'],

        methods: {
            destroy() {
                swal({
                    title: 'Weet u het zeker?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ja verwijder',
                    cancelButtonText: 'Stop!',
                    confirmButtonColor: '#34495e',
                    cancelButtonColor: '#ff3860',
                }).then (() => {
                    this.service.destroy(this.id)
                        .then(() => {
                            swal({
                                title: 'Verwijderd',
                                text: 'Succesvol verwijderd',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            location.reload();
                        })

                        .catch(() => {
                            swal({
                                title: 'Fout',
                                text: 'Heeft u voldoende rechten?',
                                type: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        });
                })
            }
        }
    }
</script>