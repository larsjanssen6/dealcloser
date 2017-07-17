export default {
    index() {
        return axios.get('/gebruikers/');
    },

    update(user) {
        return axios.patch('/gebruikers/' + user.id, user);
    },

    destroy(id) {
        return axios.delete('/gebruikers/' + id);
    }
}