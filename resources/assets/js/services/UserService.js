export default {
    index() {
        return axios.get('/gebruikers/');
    },

    show(id) {
        return axios.get('gebruikers/' + id);
    },

    update(user) {
        return axios.patch('/gebruikers/' + user.id, user);
    },

    destroy(id) {
        return axios.delete('/gebruikers/' + id);
    }
}