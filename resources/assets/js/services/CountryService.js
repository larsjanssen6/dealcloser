export default {
    index() {
        return axios.get('/countries');
    },
}