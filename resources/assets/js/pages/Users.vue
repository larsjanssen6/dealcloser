<script>
    export default {
        methods: {
            show(id) {
                Event.$emit('show-user-modal', id);
            }
        }
    }
</script>
