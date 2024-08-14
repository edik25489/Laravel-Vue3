import axios from "axios";

export default {
    state:{
        tokenManager: localStorage.getItem('tokenManager') || 0,
        managerId: localStorage.getItem('managerId') ||0,
        manager: {},
    },
    mutations:{
        updateTokenManager(state,token){
            state.tokenManager = token
        },
        updateManagerId(state,managerId){
            state.managerId = managerId
        },
        updateInfoManager(state, manager) {
            state.manager = manager
        },
    },
    actions:{
        async managerInfo(context, form){
            const res = await axios.post('/api/managerInfo',form)
            context.commit('updateInfoManager', res.data)

        },
        async registerManager(context, form){
            const res = await axios.post('/api/manager/register', form)
            if (res.data.success) {
                let token = res.data.data.token
                let managerId = res.data.data.user
                localStorage.setItem('tokenManager', token)
                localStorage.setItem('managerId', managerId)
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
                context.commit('updateTokenManager', token)
                context.commit('updateManagerId', managerId)
            }
        },
        async loginManager(context, form){
            const res = await axios.post('/api/manager/login', form)
            if (res.data.success) {
                let token = res.data.data.token
                localStorage.setItem('tokenManager', token)
                let userId = res.data.data.user
                localStorage.setItem('managerId', userId)
                axios.defaults.headers.common['authorization'] = `Bearer ${token}`
                context.commit('updateTokenManager', token)
                context.commit('updateManagerId', userId)
            }
        },
        removeTokenManager(context){
            localStorage.removeItem('tokenManager')
            localStorage.removeItem('managerId')
            context.commit('updateTokenManager', 0)
            context.commit('updateManagerId', 0)
            delete axios.defaults.headers.common['Authorization']
        }
    },
    getters:{
        getTokenManager: function (state){
            return state.tokenManager
        },
        getManagerId: function (state) {
            return state.managerId
        },
        getManager: function (state) {
            return state.manager
        },
    },
}
