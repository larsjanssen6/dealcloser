export default {
    update(role) {
        role._method = "PATCH";
        return axios.post('/instellingen/bedrijf/role/' + role.id, role);
    },

    destroy(role) {
        return axios.delete('/instellingen/bedrijf/role/' + role.id);
    }
}