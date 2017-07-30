export default {
    index() {
        return axios.get('/organisaties');
    },

    show(id) {
        return axios.get('/organisatie/' + id);
    },

    update(relation) {
        return axios.patch('/organisaties/' + relation.id, relation);
    },

    destroy(id) {
        return axios.delete('/organisaties/' + id);
    }
}