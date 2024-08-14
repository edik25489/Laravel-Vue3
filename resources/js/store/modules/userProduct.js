import axios from "axios";

export default {
    state: {
        basket: [],
        history: [],
        favorite: [],
    },
    mutations: {
        updateBasket(state, basket) {
            state.basket = basket
        },
        updateHistory(state, history) {
            state.history = history
        },
        updateFavorite(state, favorite) {
            state.favorite = favorite
        },
    },
    actions: {
        async fullHistory(context) {
            const pos = {'userId': localStorage.getItem('userId')}
            const res = await axios.post('/api/history', pos)
            context.commit('updateHistory', res.data)
        },
        async fullFavorite(context) {
            const pos = {'userId': localStorage.getItem('userId')}
            const res = await axios.post('/api/favorite', pos)
            context.commit('updateFavorite', res.data)
        },
        async addFavorite(context, post) {
            const res = await axios.post('/api/addFavorite/' + post.item, post)
            context.commit('updateFavorite', res.data)
            this.dispatch('fullFavorite')
        },
        async delFavorite(context, id) {
            const pos = {'userId': localStorage.getItem('userId')}
            await axios.post('/api/delFavorite/' + id, pos)
            this.dispatch('fullFavorite')
        },
        async fullBasket(context) {
            const pos = {'userId': localStorage.getItem('userId')}
            const res = await axios.post('/api/basket', pos)
            context.commit('updateBasket', res.data)
        },
        async addBasket(context, id) {
            const token = localStorage.getItem('tokenUser')
            const post = {'userId': localStorage.getItem('userId')}
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            console.log(id)
            console.log(post)
            await axios.post('/api/basket/' + id, post)
            this.dispatch('fullBasket')
        },
        async delBasket(context, id) {
            const pos = {'userId': localStorage.getItem('userId')}
            await axios.post('/api/delBasket/' + id, pos)
            this.dispatch('fullBasket')
        },
        async buyBasket(context, post) {
            const token = localStorage.getItem('tokenUser')
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            console.log(post)
            await axios.post('/api/buy/' + post.item, post)
            this.dispatch('fullBasket')
        },
    },
    getters: {
        getBasket: function (state) {
            return state.basket
        },
        getHistory: function (state) {
            return state.history
        },
        getFavorite: function (state) {
            return state.favorite
        },
    },
}
