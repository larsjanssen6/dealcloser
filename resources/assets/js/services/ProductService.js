export default {
    update(product) {
        return axios.patch('/producten/' + product.id, product);
    },

    destroy(id) {
        return axios.delete('/producten/' + id);
    }
}