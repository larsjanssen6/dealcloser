<script>
    export default {
        methods: {
            show(id) {
                Event.$emit('show-organisation-modal', id);
            }
        }
    }
</script>
