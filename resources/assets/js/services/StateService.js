export default {
    index(country) {
        return axios.get('/states/' + country);
    },
}