export default {
    index() {
        return axios.get('/relaties');
    },

    update(relation) {
        return axios.patch('/relaties/' + relation.id, relation);
    },

    destroy(id) {
        return axios.delete('/relaties/' + id);
    }
}