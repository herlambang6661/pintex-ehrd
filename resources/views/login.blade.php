<!doctype html>
<!--
* Developer : Herlambang Yudha Pahlawan (Fullstack + Mobile Native Android)
* This Website using Template :
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="{{ asset('hrd16.png') }}">
    <title>Login - EHRD</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link href="{{ asset('assets/extentions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/extentions/sweetalert2/sweetalert2.min.js') }}" defer></script>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .error {
            color: #FF0000;
            font-style: italic;
        }
    </style>
</head>

<body class=" d-flex flex-column bg-azure-lt">
    <style>
        body {
            margin: auto;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            overflow: auto;
            background: linear-gradient(315deg, rgba(101, 0, 94, 1) 3%, rgb(4, 0, 255) 38%, rgb(101, 0, 94, 1) 68%, rgba(255, 25, 25, 1) 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .wave {
            background: rgb(255 255 255 / 25%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }

            25% {
                transform: translateX(-25%);
            }

            50% {
                transform: translateX(-50%);
            }

            75% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(1);
            }
        }
    </style>
    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <script src="{{ url('assets/dist/js/demo-theme.min.js?1684106062') }}"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4 h2">
                            E-HRD <br>
                            PT PINTEX
                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h3 class="h3 text-center mb-4">Selamat Datang, Silahkan Login untuk menggunakan
                                    aplikasi</h3>
                                <form action="{{ route('login.post') }}" method="post" name="handleAjax"
                                    id="handleAjax">
                                    @csrf
                                    {{-- Error Alert --}}
                                    <div id="errors-list"></div>

                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            placeholder="Masukkan Username" autofocus="true">
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Masukkan password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" name="remember">
                                            <span class="form-check-label">Ingat Saya diperangkat ini</span>
                                        </label>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" id="submitLogin"
                                            class="btn btn-blue w-100">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block text-center">
                    <iframe src="https://lottie.host/embed/2f60ceca-c799-4293-960b-d10674d84d12/nb2I5XOTeV.json"
                        width="550px" height="550px"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ url('assets/dist/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ url('assets/dist/js/demo.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('assets/extentions/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/extentions/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Ajax Login
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/

            if ($("#handleAjax").length > 0) {
                $("#handleAjax").validate({
                    rules: {
                        username: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                    },
                    messages: {
                        username: {
                            required: "Username tidak boleh kosong",
                        },
                        password: {
                            required: "Password tidak boleh kosong",
                        },
                    },

                    submitHandler: function(form) {

                        $('#submitLogin').html(
                            '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Please Wait<span class="animated-dots"></span>'
                        );
                        $("#submitLogin").attr("disabled", true);


                        $.ajax({
                            url: $(form).attr('action'),
                            data: $(form).serialize(),
                            type: "POST",
                            dataType: 'json',

                            success: function(data) {

                                if (data.status) {
                                    $('#submitLogin').html(
                                        '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Redirect to Dashboard'
                                    );
                                    window.location = data.redirect;
                                } else {

                                    $('#submitLogin').html('Login');
                                    $("#submitLogin").attr("disabled", false);
                                    $('#username').focus();

                                    $(".alert").remove();
                                    $.each(data.errors, function(key, val) {
                                        $("#errors-list").append(
                                            "<div class='alert  alert-danger alert-dismissible' role='alert'><div class='d-flex'><div><svg xmlns='http://www.w3.org/2000/svg' class='icon alert-icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0'></path><path d='M12 8v4'></path><path d='M12 16h.01'></path></svg></div><div><h4 class='alert-title'>" +
                                            data.header +
                                            "</h4><div class='text-secondary'>" +
                                            val +
                                            "</div></div></div><a class='btn-close' data-bs-dismiss='alert' aria-label='close'></a></div>"
                                        );
                                    });
                                }

                            },
                        });
                    }
                })
            }

            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            End Ajax
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitLoginButton = document.getElementById('submitLogin');

            submitLoginButton.setAttribute('disabled', true);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        updateLocation(latitude, longitude);

                        submitLoginButton.removeAttribute('disabled');
                    },
                    function(error) {
                        alert("Harap izinkan akses lokasi untuk melanjutkan.");
                        console.error(error);

                        submitLoginButton.setAttribute('disabled', true);
                    }
                );
            } else {
                alert("Perangkat Anda tidak mendukung Geolocation.");
            }
        });

        function updateLocation(latitude, longitude) {
            $.ajax({
                url: "{{ route('update.location') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    latitude: latitude,
                    longitude: longitude
                },
                success: function(response) {
                    console.log("Lokasi berhasil diperbarui:", response);
                },
                error: function(xhr) {
                    console.error("Gagal memperbarui lokasi:", xhr.responseText);
                }
            });
        }
    </script>
</body>

</html>
