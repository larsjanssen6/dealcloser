export default {
    update(relation) {
        return axios.patch('/organisaties/' + relation.id, relation);
    },

    destroy(id) {
        return axios.delete('/organisaties/' + id);
    }
}