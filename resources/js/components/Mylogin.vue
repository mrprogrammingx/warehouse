<template>
<div>
    <div class="my-bg">
    </div>
        <div class="fore-ground">

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-form-title">
                        <span><img src="/images/logo.png"></span>
                        <span class="login100-form-title-1">
                            Warehouse System
    					</span>
                    </div>

                    <form v-on:submit.prevent="submitLogin" class="login100-form validate-form">
                        <div class="wrap-input100 validate-input m-b-26 mb-3" data-validate="Username is required">
                            <label class="label-input100 text-right mb-0">User name:</label>
                            <input v-model="code" class="input100" type="text" name="username"
                                   placeholder="Enter your user name:">
                        </div>

                        <div class="wrap-input100 validate-input m-b-18 mb-3" data-validate="Password is required">
                            <label class="label-input100 text-right mb-0">Password:</label>
                            <input v-model="password" class="input100" type="password" name="pass"
                                   placeholder="Enter your password:">
                        </div>

                        <div class="container-login100-form-btn mt-4">
                            <button class="login100-form-btn">
                                Enter
                            </button>
                        </div>
                        <a href="#" class="text-primary pt-3">
                            Forget password</a>

                    </form>
                </div>
            </div>
        </div>
        </div>
</div>
</template>

<script>
import store from "./storeLogin";

export default {
    data() {
        return {
            allerrors: [],
            code: '',
            password: '',
            loginError: false,
        }
    },
    methods: {
        submitLogin() {
            this.loginError = false;
            this.allerrors = null;
            axios.post('/api/login', {
                personnel_code: this.code,
                password: this.password
            }).then(response => {

                // login user, store the token and redirect to dashboard
                store.commit('loginUser')
                localStorage.setItem('access_token', response.data.data.access_token)
                localStorage.setItem('token_expire', response.data.data.token_expire)
                store.commit('setToken', response.data.data.access_token)

                //  this.$cookie.set("keyName", '789789')
                  window.location.href = '/';
                // this.$router.push({ name: '/' })
            }).catch(error => {
                this.loginError = true
                console.log(error)
                if (error.response.status == '422') {
                    this.allerrors = error.response.data;
                    navigator.vibrate(500)
                    alert("The user name or password is incorrect!")
                }
                if (error.response.data.error == 'Unauthorized') {
                    navigator.vibrate(500)
                    alert("The user name or password is incorrect!")
                }
               else if (!error.response.success) {
                    navigator.vibrate(500)
                    alert("The user name or password is incorrect!")
                }

            });
        }
    },
    name: "mylogin",

}
</script>

