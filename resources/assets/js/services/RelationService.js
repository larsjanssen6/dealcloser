export default {
    index() {
        return axios.get('/relaties');
    },

    show(id) {
        return axios.get('/relatie/' + id);
    },

    update(relation) {
        return axios.patch('/relaties/' + relation.id, relation);
    },

    destroy(id) {
        return axios.delete('/relaties/' + id);
    }
}