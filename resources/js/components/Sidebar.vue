<template>
    <div class="d-flex align-items-stretch h-100">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                </button>
            </div>
            <div>
                <div class="bg"></div>
                <div class="user-logo mx-auto">
                    <img src="http://localhost:8000/images/logo.jpg" class="img user-img">
                    <h5>{{user.first_name}} {{user.last_name}}</h5>
                </div>

            </div>
            <ul class="components mb-5">

                <li class="mb-0 pb-3">
                    <a data-toggle="collapse" href="#dashboard" aria-expanded="true">
                        <div>
                            <i class="fas fa-edit pl-2"></i>
                            <span>Requests actions</span>
                            <i class="fa fa-angle-left float-left mt-1 pr-4"></i>
                        </div>

                    </a>

                    <div class="collapse mt-2" id="dashboard">
                                <router-link to="/request" class="mb-1 pr-2 py-1 d-block">
                                    <i class="fa fa-circle"></i>
                                    <span>Request goods</span>
                                </router-link>
                                <router-link to="/status" class="mb-1 pr-2 py-1 d-block">
                                    <i class="fa fa-circle"></i>
                                    <span>Awaiting confirmation requests</span>
                                </router-link>
                        <router-link to="/myrequest" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>My requests</span>
                        </router-link>
                    </div>
                </li>
                <li class="my-0">
                    <a data-toggle="collapse" href="#business" aria-expanded="true">
                        <div>
                            <i class="fas fa-chart-bar pl-2"></i>
                            <span>Business operations</span>
                            <i class="fa fa-angle-left float-left mt-1 pr-4"></i>
                        </div>
                    </a>
                    <div class="collapse mt-2" id="business">
                        <router-link to="/business" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>View purchase request</span>
                        </router-link>
                        <router-link to="/status" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Archive of requests</span>
                        </router-link>
                    </div>
                </li>
                <li class="my-0 py-2">
                    <router-link to="/store" class="mb-1 pr-2 py-1 d-block">
                        <span>Cartable warehouse</span>
                    </router-link>
                </li>
                <li class="my-0">
                    <a data-toggle="collapse" href="#peyk" aria-expanded="true">
                        <div>
                            <i class="fas fa-chart-bar pl-2"></i>
                            <span>Courier actions</span>
                            <i class="fa fa-angle-left float-left mt-1 pr-4"></i>
                        </div>

                    </a>
                    <div class="collapse mt-2" id="peyk">
                        <router-link to="/peyk_management" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Introducing the courier</span>
                        </router-link>
                        <router-link to="/vehicle" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Introducing the vehicle</span>
                        </router-link>
                        <router-link to="/receive_request_peyk" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Requests pending delivery</span>
                        </router-link>
                        <router-link to="/Archive" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Archive</span>
                        </router-link>
                    </div>
                </li>

                <li class="my-0">
                    <a data-toggle="collapse" href="#confirm" aria-expanded="true">
                        <div>
                            <i class="fas fa-chart-bar pl-2"></i>
                            <span>Confirmations</span>
                            <i class="fa fa-angle-left float-left mt-1 pr-4"></i>
                        </div>

                    </a>
                    <div class="collapse mt-2" id="confirm">
                        <router-link to="/new_confirm" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>New confirmations</span>
                        </router-link>
                        <router-link to="/confirm_user" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Assign confirmation to users</span>
                        </router-link>
                        <router-link to="/dgdgrgr" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Products confirmation</span>
                        </router-link>
                        <router-link to="/sdf" class="mb-1 pr-2 py-1 d-block">
                            <i class="fa fa-circle"></i>
                            <span>Confirmation of categoryies</span>
                        </router-link>
                    </div>
                </li>

                <li class="my-0 py-2">
                        <router-link to="/user" class="mb-1 pr-2 py-1 d-block">
                            <span>User management</span>
                        </router-link>
                </li>
                <li class="my-0 py-2">
                    <router-link to="/permission" class="mb-1 pr-2 py-1 d-block">
                        <span>Permissions</span>
                    </router-link>
                </li>

               <a id="exit" tag="li" @click="logout" class="fas fa-door-open"><span>Exit</span></a>

            </ul>

        </nav>
    </div>
</template>

<script>
export default {
    name: "sidebar",
    data() {
        return {
            myActive: false,
            user:''
        }
    },
    methods : {
        logout() {

        },
        loadUser(){
                axios.get('api/user/getById').then(({data}) => (this.user = data.data));
        }
    },
    created() {
        // this.isAuth = store.state.isLoggedIn
        this.loadUser()
    }
}
</script>
<style>
.bg {
    width: 260px;
    height: 185px;
    background-image: linear-gradient(to top, #383c3e 0%, #264b60 100%);
}
#exit{
    text-decoration: none;
    display: block!important;
    padding: 18px;
    margin-left: 7%;
    margin-right: 7%;
    color: #b7b5b5;
    border-bottom: 1px solid #5a5858;
}
#exit:hover{
    cursor: pointer;
    color: white ;
    margin-right: 5%;
    transition: 0.5s;
}
#exit::before{
    margin-left: 10px!important;
    font-size: 14px;
}
</style>
