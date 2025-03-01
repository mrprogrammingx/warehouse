<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{asset('fonts/font-awesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{asset('fonts/font-awesome/css/solid.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css') }}">
    <link rel="stylesheet" href="{{asset('css/main2.css') }}">


    <!-- Scripts -->
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.bundle.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>


</head>
<body class="alt-menu sidebar-noneoverflow">
<div class="wrapper" id="app">
    <div class="main-panel h-100">
        <div class="content h-100">
            <div>
                <div class="my-bg">
                </div>
                <div class="fore-ground">

                    <div class="limiter">
                        <div class="container-login100">
                            <div class="wrap-login100">
                                <div class="login100-form-title">
                                    <span><img src="/images/ardakan.png"></span>
                                    <span class="login100-form-title-1">
    						Warehouse Software
    					</span>
                                </div>

                                <form class="login100-form validate-form">
                                    @csrf
                                    <div class="wrap-input100 validate-input m-b-26 mb-3"
                                         data-validate="Username is required">
                                        <label class="label-input100 text-right mb-0">Username:</label>
                                        <input id="username" class="input100" type="text" name="username"
                                               placeholder="Enter your username">
                                    </div>

                                    <div class="wrap-input100 validate-input m-b-18 mb-3"
                                         data-validate="Password is required">
                                        <label class="label-input100 text-right mb-0">Password:</label>
                                        <input id="password" class="input100" type="password" name="pass"
                                               placeholder="Enter your password">
                                    </div>

                                    <div class="container-login100-form-btn mt-4">
                                        <button id="submit" class="login100-form-btn">
                                            Enter
                                        </button>
                                    </div>
                                    <a href="https://salary.afgc.ir:2061/forget" class="text-primary pt-3">
                                        Forget the password</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
    $(document).ready(function (event) {

        $('#submit').click(function (event) {
            var username = $('#username').val();
            var password = $('#password').val();
            event.preventDefault();
            axios.post('api/login', {personnel_code: username, password: password}).then(({data}) => {
                localStorage.setItem('access_token', data.data.access_token)
                localStorage.setItem('token_expire', data.data.token_expire)
                store.commit('setToken', data.data.access_token)
                window.location.href = base_url + '/';
                console.log(data)
            }).catch(error => {
                console.log("efefeffef")
            })
        });
    });
</script>


</body>
</html>
