export default {
    index() {
        return axios.get('/afdelingen');
    },

    update(department) {
        return axios.patch('/instellingen/bedrijf/afdeling/' + department.id, department);
    },

    destroy(id) {
        return axios.delete('/instellingen/bedrijf/afdeling/' + id);
    }
}