import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('access_token')
    },
    getters :{
        getToken : (state) => state.token
    },
    mutations: {
        loginUser (state) {
            state.isLoggedIn = true

        },
        logoutUser (state) {
            state.isLoggedIn = false
        },
        setToken(state,token) {
            state.token = token
        }
    }
})
