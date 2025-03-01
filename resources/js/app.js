import storeLogin from "./components/storeLogin";

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import AppComponent from './components/AppComponent';
import VueTree from '@ssthouse/vue-tree-chart';
import Business from "./components/Business";
import Request from "./components/Request";
import Status from "./components/Status";
import Mylogin from "./components/Mylogin";
import Print from 'vue-print-nb';
import User from "./components/User";
import Permission from "./components/Permission";
import PeykManagement from "./components/PeykManagement";
import Vehicle from "./components/Vehicle";
import MyRequest from "./components/MyRequest";
import Wherehouse from "./components/Wherehouse";
import NewConfirm from "./components/NewConfirm";
import ReceiveRequestPeyk from "./components/ReceiveRequestPeyk";
import ConfirmUser from "./components/ConfirmUser";
import DeliveryKartable from "./components/DeliveryKartable";
import MenuBar from "./components/MenuBar";
import StoreArchive from "./components/StoreArchive";
import Chart from "./components/Chart";
import VueApexCharts from 'vue-apexcharts';
import CancelRequests from "./components/CancelRequests";
import EditRequest from "./components/EditRequest";
Vue.use(VueApexCharts)
Vue.use(VueRouter);
Vue.use(Print);
const axios = require('axios').default;
window.axios = axios;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('vue-tree', VueTree);
Vue.component('apexchart', VueApexCharts);
// const files = require.context('./', true, /\.vue$/i)
Vue.component('appcomponent', require('./components/AppComponent.vue').default);
Vue.component('sidebar', require('./components/Sidebar.vue').default);
Vue.component('menubar', require('./components/MenuBar.vue').default);

const routes = [
    {path: '/', component:Mylogin, name: 'mylogin'},
    {path: '/request', component:Request, name: 'request',meta: { requiresAuth: true }},
    {path: '/edit_request/:id', component:EditRequest, name: 'edit_request',meta: { requiresAuth: true }},
    {path: '/status', component:Status, name: 'status',meta: { requiresAuth: true }},
    {path: '/business', component:Business, name: 'business',meta: { requiresAuth: true }},
    // {path: '/mylogin', component:Login, name: 'login'},
    {path: '/user', component:User, name: 'user',meta: { requiresAuth: true }},
    {path: '/permission', component:Permission, name: 'permission',meta: { requiresAuth: true }},
    {path: '/peyk_management', component:PeykManagement, name: 'peyk_management',meta: { requiresAuth: true }},
    {path: '/vehicle', component:Vehicle, name: 'vehicle',meta: { requiresAuth: true }},
    {path: '/myrequest', component:MyRequest, name: 'myrequest',meta: { requiresAuth: true }},
    {path: '/wherehouse', component:Wherehouse, name: 'wherehouse',meta: { requiresAuth: true }},
    {path: '/new_confirm', component:NewConfirm, name: 'new_confirm',meta: { requiresAuth: true }},
    {path: '/receive_request_peyk', component:ReceiveRequestPeyk, name: 'receive_request_peyk',meta: { requiresAuth: true }},
    {path: '/confirm_user', component:ConfirmUser, name: 'confirm_user',meta: { requiresAuth: true }},
    {path: '/delivery_kartable', component:DeliveryKartable, name: 'delivery_kartable',meta: { requiresAuth: true }},
    {path: '/store_archive', component:StoreArchive, name: 'store_archive',meta: { requiresAuth: true }},
    {path: '/chart', component:Chart, name: 'chart',meta: { requiresAuth: true }},
    {path: '/cancel_requests', component:CancelRequests, name: 'cancel',meta: { requiresAuth: true }},
]
window.axios.defaults.headers.common['Authorization'] = 'Bearer ' +  localStorage.getItem('access_token');
const router = new VueRouter({
    routes,
    linkActiveClass: 'myActiveLink'

})


window.axios.interceptors.response.use(function (response) {

    return response;

}, function (error) {


    if (401 === error.response.status) {
        localStorage.removeItem('access_token')
        localStorage.removeItem('token_expire')
        storeLogin.commit('logoutUser')



         window.location.href = '/';
    }
 else {
        console.log(error)
        return Promise.reject(error);
    }

});


router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !storeLogin.state.isLoggedIn) {
        // redirect to login page
        storeLogin.commit('logoutUser')

        window.location.href = '/';
        return
    }

    // if logged in redirect to dashboard
    if(to.path === '/' && storeLogin.state.isLoggedIn) {
        next({ name: 'chart' })
        return
    }


    if (localStorage.access_token) {
        let expire = localStorage.token_expire;
        let now = new Date().getTime();
        if ((expire) < (new Date().getTime() / 1000)) {
            localStorage.removeItem('access_token')
            localStorage.removeItem('permissions')
            localStorage.removeItem('token_expire')
            storeLogin.commit('logoutUser')
            window.location.href = '/';

        }
    }

    next()
})

const app = new Vue({

    components: { AppComponent },
    router
}).$mount('#app')



