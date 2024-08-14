import axios from "axios";

export default {
    state: {
        tokenUser: localStorage.getItem('tokenUser') || 0,
        userId: localStorage.getItem('userId') ||0,
        user: {}
    },
    mutations: {
        updateTokenUser(state, token) {
            state.tokenUser = token
        },
        updateAuthUser(state, userId) {
            state.userId = userId
        },
        updateInfoUser(state, user) {
            state.user = user
        },

    },
    actions: {
        async userInfo(context, form){
            const res = await axios.post('/api/userInfo',form)
            context.commit('updateInfoUser', res.data)

        },
        async registerUser(context, form) {
            const res = await axios.post('/api/register', form)
            if (res.data.success) {
                let token = res.data.data.token
                let userId = res.data.data.user
                localStorage.setItem('tokenUser', token)
                localStorage.setItem('userId', userId)
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                context.commit('updateTokenUser', token)
                context.commit('updateAuthUser', userId)
            }
        },
        async loginUser(context, form) {
            const res = await axios.post('/api/login', form)
            if (res.data.success) {
                let token = res.data.data.token
                localStorage.setItem('tokenUser', token)
                let userId = res.data.data.user
                localStorage.setItem('userId', userId)
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                context.commit('updateTokenUser', token)
                context.commit('updateAuthUser', userId)
            }
        },
        removeTokenUser(context) {
            localStorage.removeItem('tokenUser')
            localStorage.removeItem('userId')
            context.commit('updateTokenUser', 0)
            context.commit('updateAuthUser', 0)
            delete axios.defaults.headers.common['Authorization']
        },
    },
    getters: {
        getTokenUser: function (state) {
            return state.tokenUser
        },
        getAuthUser: function (state) {
            return state.userId
        },
        getInfoUser: function (state) {
            return state.user
        },
    },
}
