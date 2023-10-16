<template>
    <div v-if="this.isAuth == true">
        <div class="header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="#" class="sidebarCollapse" data-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-menu">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </a>
                <div class="nav-logo align-self-center">
                    <a class="navbar-brand"><img alt="logo" src="images/ardakan.png"> <span
                        class="navbar-brand-name">Warehouse Software</span></a>
                </div>

                <ul class="navbar-item flex-row mr-auto">

                </ul>

                <ul class="navbar-item flex-row nav-dropdowns">


                    <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                        <a href="#" class="nav-link dropdown-toggle user" id="user-profile-dropdown"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media">
                                <img src="images/avatar.png" class="img-fluid" alt="admin-profile">
                                <div class="media-body align-self-center">
                                    <h6>{{ user.first_name }} {{ user.last_name }}</h6>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>
                        <div class="dropdown-menu position-absolute animated fadeInUp"
                             aria-labelledby="user-profile-dropdown">
                            <div class="">
                                <div class="dropdown-item">
                                    <a @click="logout" class="fas fa-sign-out-alt">
                                        Exit</a>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </header>
            <div class="main-container" id="container">
                <div class="topbar-nav header navbar" role="banner">
                    <nav id="topbar" class="">
                        <ul class="list-unstyled menu-categories" id="topAccordion">

                            <li class="menu single-menu">
                                <a href="#/chart">
                                    <div class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                        <span>Main page</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu single-menu">
                                <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                        </svg>
                                        <span>Requests</span>
                                    </div>

                                </a>
                                <ul class="collapse submenu list-unstyled" id="menu" data-parent="#topAccordion">
                                    <li class="mb-2">
                                        <router-link to="/request" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Request goods</span>
                                        </router-link>
                                    </li>

                                    <li class="mb-2">
                                        <router-link to="/myrequest" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>My requests</span>
                                        </router-link>
                                    </li>
                                    <li class="mb-2">
                                        <router-link to="/status" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>My awaiting confirmation requests</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu single-menu">
                                <a href="#components" data-toggle="collapse" aria-expanded="false"
                                   class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-box">
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg>
                                        <span>Warehouse</span>
                                    </div>

                                </a>
                                <ul class="collapse submenu list-unstyled" id="components" data-parent="#topAccordion">
                                    <li class="mb-2" v-if="hasAccessTo('warehouse-cartable')">
                                        <router-link to="/wherehouse" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Cartable warehouse</span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/cancel_requests" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Canceled requests</span>
                                        </router-link>

                                    </li>
                                    <li>
                                        <router-link to="/store_archive" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Archive</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu single-menu">
                                <a href="#uiKit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-zap">
                                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                        </svg>
                                        <span>Courier</span>
                                    </div>

                                </a>
                                <ul class="collapse submenu list-unstyled" id="uiKit" data-parent="#topAccordion">
                                    <li class="mb-2" v-if="hasAccessTo('delivery-store')">
                                        <router-link to="/peyk_management" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Introducing the courier</span>
                                        </router-link>
                                    </li>
                                    <li class="mb-2" v-if="hasAccessTo('vehicle-store')">
                                        <router-link to="/vehicle" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Introducing the vehicle</span>
                                        </router-link>
                                    </li>
                                    <li class="mb-2">
                                        <router-link to="/receive_request_peyk" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Requests pending delivery</span>
                                        </router-link>
                                    </li>
                                    <li class="mb-2" v-if="hasAccessTo('delivery-cartable')">
                                        <router-link to="/delivery_kartable" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Cartable Courier</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu single-menu">
                                <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-layout">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="3" y1="9" x2="21" y2="9"></line>
                                            <line x1="9" y1="21" x2="9" y2="9"></line>
                                        </svg>
                                        <span>Confirmations</span>
                                    </div>

                                </a>
                                <ul class="collapse submenu list-unstyled" id="tables" data-parent="#topAccordion">
                                    <li class="mb-2">
                                        <router-link to="/new_confirm" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>New confirmations</span>
                                        </router-link>
                                    </li>
                                    <li class="mb-2">
                                        <router-link to="/confirm_user" class="mb-1 pr-2 py-1 d-block">
                                            <i class="fa fa-circle"></i>
                                            <span>Assign confirmation to users</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu single-menu" v-if="hasAccessTo('setting')">
                                <a href="#more" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-plus-circle">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg>
                                        <span>Settings</span>
                                    </div>

                                </a>
                                <ul class="collapse submenu list-unstyled" id="more" data-parent="#topAccordion">
                                    <li class="mb-2" v-if="hasAccessTo('role-assignPermissionToRole')">
                                        <router-link to="/permission" class="mb-1 pr-2 py-1 d-block">
                                            <span>Permissions</span>
                                        </router-link>
                                    </li>
                                    <li v-if="hasAccessTo('manage-users')" class="mb-2">
                                        <router-link to="/user" class="mb-1 pr-2 py-1 d-block">
                                            <span>User management</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
        <div class="search-overlay"></div>
    </div>
</template>

<script>
import storeLogin from "./storeLogin";

export default {
    data() {
        return {
            permissions: [],
            user: '',
            isAuth: false
        }
    },
    methods: {
        hasAccessTo(permission) {

            // console.log(this.permissions.includes(permission))
            return this.permissions.includes(permission)

        },

        getUserPermissions() {

            axios.get('api/permissions/loginUser').then(({data}) => (this.permissions = data.data, localStorage.setItem('permissions', this.permissions)))
        },
        logout() {
            if (confirm("Do you want to exit the program?")) {
                localStorage.removeItem('access_token')
                localStorage.removeItem('token_expire')
                storeLogin.commit('logoutUser')
                window.location.href = '/';
            }

        },
        loadUser() {
            axios.get('api/user/getById').then(({data}) => (this.user = data.data));
        }
    },
    created() {
        this.isAuth = storeLogin.state.isLoggedIn
        if (this.isAuth == true) {
            this.loadUser()
            this.getUserPermissions()
        }
    },

    name: "MenuBar"
}

</script>

<style>

</style>
