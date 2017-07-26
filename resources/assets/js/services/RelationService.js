export default {
    destroy(id) {
        return axios.delete('/relaties/' + id);
    }
}