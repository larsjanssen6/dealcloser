<script>
    export default {
        methods: {
            show(id) {
                Event.$emit('show-product-modal', id);
            }
        }
    }
</script>
