export default {
    index() {
        return axios.get('/producten');
    },

    update(product) {
        return axios.patch('/producten/' + product.id, product);
    },

    destroy(id) {
        return axios.delete('/producten/' + id);
    }
}