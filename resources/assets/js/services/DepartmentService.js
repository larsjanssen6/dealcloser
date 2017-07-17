export default {
    update(department) {
        return axios.patch('/instellingen/bedrijf/afdeling/' + department.id, department);
    },

    destroy(department) {
        return axios.delete('/instellingen/bedrijf/afdeling/' + department.id);
    }
}