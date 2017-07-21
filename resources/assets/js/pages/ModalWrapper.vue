<script>
    export default {
        props: ['name'],

        methods: {
            show(id) {
                Event.$emit('show-' + this.name + '-modal', id);
            }
        }
    }
</script>
