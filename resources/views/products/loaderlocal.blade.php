<!doctype html>
<!--
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
    <title>Loading - Updating Fingerprint.</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container container-slim py-3">
            <div class="text-center">
                <div class="ph-item" style="display:none">
                    <div class="mb-3">
                        <a href="." class="navbar-brand navbar-brand-autodark">
                            <img src="{{ asset('hrd32.png') }}" alt="" srcset="">
                        </a>
                    </div>
                    <div class="text-muted mb-3 stt"></div>
                    <div class="progress progress-sm">
                        <div class="progress-bar progress-bar-indeterminate"></div>
                    </div>
                </div>
                <div class="fetched-data-absensi"></div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets/dist/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('assets/dist/js/demo.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('assets/extentions/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/extentions/jquery.validate.min.js') }}"></script>
    <script>
        (function() {
            var start = "{{ date('Y-m-01', strtotime(date('Y-m-d') . '-1 month')) }}";
            var end = "{{ date('Y-m-t') }}";
            $(".ph-item").fadeIn(200);
            $('.fetched-data-absensi').text('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('syncCheckinout') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'start': start,
                    'end': end,
                },
                beforeSend: function() {
                    $('.stt').text(
                        'Fetching Data Fingerprint & Updating Database...'
                    );
                    console.log('fetch data: ' + start + '-' + end);
                },
                success: function(data) {
                    console.log(
                        'Success Fetching, redirect into Dashboard...');
                    $('.stt').text('');
                    $('.stt').text('Success Updating Data');
                    $('.fetched-data-absensi').html(data);
                    window.location.href = '/lokal/localabsence';
                },
                error: function(data) {
                    console.log('Error:', data.responseText);
                    $('.stt').text(
                        'Driver ODBC Access tidak ditemukan atau waktu tunggu terlalu lama. Silahkan tarik absen ODBC secara manual per hari. Halaman akan beralih ke Dashboard tanpa syncronisasi...'
                    );
                    setTimeout(function() {
                        window.location.href = '/lokal/localabsence';
                    }, 10000);
                    // console.log(data);
                    // console.log('Error:', data.error);
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Gagal!',
                    //     text: 'Error: ' + data.responseText,
                    //     showConfirmButton: true,
                    // });
                    // tableAbsensi.ajax.reload();
                }
            });
        })();
    </script>
</body>

</html>
