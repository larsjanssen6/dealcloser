export default {
    send(data) {
        return axios.post('/password/reset', data);
    }
}