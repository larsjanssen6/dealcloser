<template>
    <div>
        <div v-if="show">
            <div class="modal is-active">
                <div class="modal-background" @click="show = false"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">
                            <slot name="title"></slot>
                        </p>
                        <button class="delete" @click="show = false"></button>
                    </header>

                    <section class="modal-card-body">
                        <slot></slot>
                    </section>

                    <footer class="modal-card-foot">
                        <slot name="footer"></slot>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                show: false
            }
        },

        created() {
            Event.$on('show-user-modal', (id) => {
                if (this.user === id) {
                    this.show = true;
                }
            });
        },

        methods: {
            update() {
                alert('jow');
            }
        }
    }
</script>

