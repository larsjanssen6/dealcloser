export default {
    index() {
        return axios.get('/roles');
    },

    update(role) {
        return axios.patch('/instellingen/bedrijf/role/' + role.id, role);
    },

    destroy(id) {
        return axios.delete('/instellingen/bedrijf/role/' + id);
    }
}