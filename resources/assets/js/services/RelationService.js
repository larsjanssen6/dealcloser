export default {
    update(relation) {
        relation._method = "PATCH";
        return axios.post('/relaties/' + relation.id, relation);
    },
}