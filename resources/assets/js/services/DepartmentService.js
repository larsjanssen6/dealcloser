export default {
    update(department) {
        department._method = "PATCH";
        return axios.post('/instellingen/bedrijf/afdeling/' + department.id, department);
    },

    destroy(department) {
        return axios.delete('/instellingen/bedrijf/afdeling/' + department.id);
    }
}