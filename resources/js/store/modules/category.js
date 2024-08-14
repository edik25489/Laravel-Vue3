import axios from "axios";

export default {
    state: {
        category: [],
        categories: [],
    },
    mutations: {
        updateCategory(state, category) {
            state.category = category
        },
        updateCategories(state, categories) {
            state.categories = categories
        },
    },
    actions: {
        async getCategories(context) {
            const res = await axios.get('/api/category')
            context.commit('updateCategories', res.data)
        },
        async getCategory(context, id) {
            const res = await axios.get('/api/category' + id)
            context.commit('updateCategory', res.data)
        },
        async storeCategory(context, post) {
            await axios.post('/api/category', post, { headers: {'Content-Type':'multipart/form-data'}})
            this.dispatch('getCategories')
        },
        async updateCategory(context, post) {
            await axios.patch('/api/category' + post.id, post)
            this.dispatch('getCategories')
        },

    },
    getters: {
        fullCategories: function (state) {
            return state.categories
        },
        fullCategory: function (state) {
            return state.category
        },
    },
}
