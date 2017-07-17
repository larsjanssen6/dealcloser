export default {
    update(relation) {
        return axios.patch('/relaties/' + relation.id, relation);
    },

    destroy(id) {
        return axios.delete('/relaties/' + id);
    }
}