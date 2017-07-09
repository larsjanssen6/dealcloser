<script>
    export default {
        methods: {
            show(id) {
                Event.$emit('show-relation-modal', id);
            }
        }
    }
</script>
