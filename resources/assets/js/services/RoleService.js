export default {
    update(role) {
        return axios.patch('/instellingen/bedrijf/role/' + role.id, role);
    },

    destroy(role) {
        return axios.delete('/instellingen/bedrijf/role/' + role.id);
    }
}