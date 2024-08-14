import axios from "axios";

export default {
    state: {
        products: [],
        product: [],
    },
    mutations: {
        updateProduct(state, product) {
            state.product = product
        },
        updateProducts(state, products) {
            state.products = products
        },
    },
    actions: {
        async getProducts(context) {
            const res = await axios.get('/api/product')
            context.commit('updateProducts', res.data)
        },
        async getProduct(context, id) {
            const res = await axios.get('/api/product' + id)
            context.commit('updateProduct', res.data)
        },
        async storeProduct(context, post) {
            await axios.post('/api/product', post, { headers: {'Content-Type':'multipart/form-data'}})
            this.dispatch('getProducts')
        },
        async updateProduct(context, post) {
            await axios.patch('/api/product' + post.id, post)
            this.dispatch('getProducts')
        },
    },
    getters: {
        fullProducts: function (state) {
            return state.products
        },
        fullProduct: function (state) {
            return state.product
        },
    },
}
