export default {
    update(user) {
        user._method = "PATCH";
        return axios.post('/gebruikers/' + user.id, user);
    },
}