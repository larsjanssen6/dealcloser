export default {
    index() {
        return axios.get('/organisaties');
    },

    update(relation) {
        return axios.patch('/organisaties/' + relation.id, relation);
    },

    destroy(id) {
        return axios.delete('/organisaties/' + id);
    }
}