export default {
    update(relation) {
        console.log('updateeee');
        return axios.patch('/relaties/' + relation.id, relation);
    },

    destroy(id) {
        return axios.delete('/relaties/' + id);
    }
}