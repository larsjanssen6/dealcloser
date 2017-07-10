export default {
    update(user) {
        user._method = "PATCH";
        return axios.post('/gebruikers/' + user.id, user);
    },

    destroy(id) {
        return axios.delete('/gebruikers/' + id);
    }
}