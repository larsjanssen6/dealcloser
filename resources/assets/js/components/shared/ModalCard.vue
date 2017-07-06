<template>
    <div>
        <div class="modal is-active">
            <div class="modal-background" @click="$emit('close')"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        <slot name="title"></slot>
                    </p>
                    <button class="delete" @click="$emit('close')"></button>
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
</template>

<script>
    export default {}
</script>

