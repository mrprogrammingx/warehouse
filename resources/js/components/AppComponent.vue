<template>
    <router-view></router-view>

</template>

<script>
import store from "./storeLogin";
export default {
    name: "AppComponent",

    // methods: {
    //     logoutUser() {
    //         localStorage.removeItem('access_token')
    //         localStorage.removeItem('permissions')
    //         localStorage.removeItem('token_expire')
    //         store.commit('logoutUser')
    //         window.location.href = '/login';
    //     },
    //     checkToken() {
    //         if (localStorage.access_token) {
    //             let expire = localStorage.token_expire;
    //             let now = new Date().getTime();
    //             if ((expire) < (new Date().getTime() / 1000)) {
    //                 store.commit('logoutUser')
    //                 window.location.href = '/#login';
    //             }
    //
    //         }
    //         else
    //         {
    //             console.log(store.state.isLoggedIn)
    //             window.location.href = '/#login';
    //         }
    //     }
    //
    // },
    created () {
        // this.checkToken()
    },
}
</script>

<style scoped>

</style>
