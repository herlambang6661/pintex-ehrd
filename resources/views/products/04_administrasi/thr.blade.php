@extends('layouts.app')
@section('content')
    <style>
        td.cuspad0 {
            padding-top: 3px;
            padding-bottom: 3px;
            padding-right: 13px;
            padding-left: 13px;
        }

        td.cuspad1 {
            text-transform: uppercase;
        }

        td.cuspad2 {
            padding-top: 0.5px;
            margin-left: 5px;
        }

        .unselectable {
            -webkit-user-select: none;
            -webkit-touch-callout: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #cc0000;
            font-weight: bolder;
        }

        .overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .loader {
            position: fixed;
            z-index: 301;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 200px;
            width: 200px;
            overflow: hidden;
            text-align: center;
        }

        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 303;
            border-radius: 100%;
            border-left-color: transparent !important;
            border-right-color: transparent !important;
        }

        .spinner1 {
            width: 100px;
            height: 100px;
            border: 10px solid #fff;
            animation: spin 1s linear infinite;
        }

        .spinner2 {
            width: 70px;
            height: 70px;
            border: 10px solid #fff;
            animation: negative-spin 2s linear infinite;
        }

        .spinner3 {
            width: 40px;
            height: 40px;
            border: 10px solid #fff;
            animation: spin 4s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @keyframes negative-spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(-360deg);
            }
        }

        .loader-text {
            position: relative;
            top: 75%;
            color: #fff;
            font-weight: bold;
        }

        .disabled {
            opacity: 0.5 !important;
            pointer-events: none;
        }
    </style>
    <div class="page">
        <!-- Sidebar -->
        @include('shared.sidebar')
        <!-- Navbar -->
        @include('shared.navbar')

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-coins">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                    <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                    <path
                                        d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                    <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                    <path d="M3 11c0 .888 .772 1.45 2 2" />
                                </svg>
                                Tunjangan Hari Raya
                                <div id="entitasText" style="margin-left: 5px;">Loading...
                                    <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                                </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-calendar-days"></i>
                                            Administrasi</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">
                                            <i class="fa-solid fa-coins"></i>
                                            Tunjangan Hari Raya
                                            <i class="text-danger"> (Restricted Area).</i>
                                        </a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-md-12">
                            <div class="card card-xl shadow rounded">
                                <div class="card card-xl shadow rounded">
                                    <div class="card-body">
                                        <div class="card-stamp card-stamp-lg">
                                            <div class="card-stamp-icon bg-primary">
                                                <i class="fa-solid fa-sack-dollar"></i>
                                            </div>
                                        </div>
                                        <div class="row row-cards">
                                            <div class="col-sm-12 col-md-12 col-lg-3">
                                                <label class="form-label">Periode </label>
                                                <div class="input-group">
                                                    <select name="tahun" id="tahun"
                                                        class="form-select border border-primary">
                                                        @for ($i = date('Y'); $i >= 2020; $i--)
                                                            <option value="{{ $i }}"
                                                                {{ date('Y') == $i ? 'selected="selected"' : '' }}>
                                                                {{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <button class="btn btn-primary " onclick="syn();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            style="margin-right: 5px" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-restore">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M3.06 13a9 9 0 1 0 .49 -4.087" />
                                                            <path d="M3 4.001v5h5" />
                                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                        </svg>
                                                        Perbarui
                                                    </button>
                                                    <button data-bs-toggle="dropdown" type="button"
                                                        class="btn btn-primary  dropdown-toggle dropdown-toggle-split"
                                                        aria-expanded="false"></button>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <a class="dropdown-item cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#genTHR">
                                                            <i class="fa-brands fa-bitcoin fa-flip text-yellow"
                                                                style="margin-right: 5px"></i>
                                                            Generate Data THR
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                .spinnerLoading svg {
                                                    -webkit-animation: loading-rotate 2s linear infinite;
                                                    -moz-animation: loading-rotate 2s linear infinite;
                                                    -o-animation: loading-rotate 2s linear infinite;
                                                    animation: loading-rotate 2s linear infinite;
                                                    height: 50px;
                                                    width: 50px;
                                                }

                                                .spinnerLoading .path {
                                                    stroke-dasharray: 90, 150;
                                                    stroke-dashoffset: 0;
                                                    stroke-width: 2;
                                                    stroke: #409eff;
                                                    stroke-linecap: round;
                                                    -webkit-animation: loading-dash 1.5s ease-in-out infinite;
                                                    -moz-animation: loading-dash 1.5s ease-in-out infinite;
                                                    -o-animation: loading-dash 1.5s ease-in-out infinite;
                                                    animation: loading-dash 1.5s ease-in-out infinite;
                                                }

                                                @-webkit-keyframes loading-rotate {
                                                    to {
                                                        -webkit-transform: rotate(1turn);
                                                        transform: rotate(1turn);
                                                    }
                                                }

                                                @-moz-keyframes loading-rotate {
                                                    to {
                                                        -moz-transform: rotate(1turn);
                                                        transform: rotate(1turn);
                                                    }
                                                }

                                                @-o-keyframes loading-rotate {
                                                    to {
                                                        -o-transform: rotate(1turn);
                                                        transform: rotate(1turn);
                                                    }
                                                }

                                                @keyframes loading-rotate {
                                                    to {
                                                        -webkit-transform: rotate(1turn);
                                                        -moz-transform: rotate(1turn);
                                                        -o-transform: rotate(1turn);
                                                        transform: rotate(1turn);
                                                    }
                                                }

                                                @-webkit-keyframes loading-dash {
                                                    0% {
                                                        stroke-dasharray: 1, 200;
                                                        stroke-dashoffset: 0;
                                                    }

                                                    50% {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -40px;
                                                    }

                                                    to {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -120px;
                                                    }
                                                }

                                                @-moz-keyframes loading-dash {
                                                    0% {
                                                        stroke-dasharray: 1, 200;
                                                        stroke-dashoffset: 0;
                                                    }

                                                    50% {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -40px;
                                                    }

                                                    to {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -120px;
                                                    }
                                                }

                                                @-o-keyframes loading-dash {
                                                    0% {
                                                        stroke-dasharray: 1, 200;
                                                        stroke-dashoffset: 0;
                                                    }

                                                    50% {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -40px;
                                                    }

                                                    to {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -120px;
                                                    }
                                                }

                                                @keyframes loading-dash {
                                                    0% {
                                                        stroke-dasharray: 1, 200;
                                                        stroke-dashoffset: 0;
                                                    }

                                                    50% {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -40px;
                                                    }

                                                    to {
                                                        stroke-dasharray: 90, 150;
                                                        stroke-dashoffset: -120px;
                                                    }
                                                }
                                            </style>
                                            <div class="col-sm-12 col-md-12 text-center">
                                                <div class="spinnerLoading" style="display:none">
                                                    <svg viewBox="25 25 50 50">
                                                        <circle cx="50" cy="50" r="20" fill="none"
                                                            class="path"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setStatus"></div>
                                        <div class="table-responsive">
                                            <table style="width:100%; font-size:13px"
                                                class="display table table-sm  table-bordered table-hover text-nowrap datatable-tunjangan"
                                                id="tbabsensi">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.footer')
            </div>
        </div>
        {{-- Modal Filter --}}
        <div class="offcanvas offcanvas-blur offcanvas-end" tabindex="-1" id="offcanvasEnd-lamaran"
            aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Payroll</h2>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-blue">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <form action="#" id="form-filter-items" method="get" autocomplete="off" novalidate=""
                        class="sticky-top">
                        <br>
                        <div class="form-label">Level</div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input filter-checkbox-rayon"
                                            name="pendidikan[]" value="IBR" checked="" id="sSmp">
                                        <span class="form-check-label">Pria</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input filter-checkbox-rayon"
                                            name="pendidikan[]" value="SPV" checked="" id="sSma">
                                        <span class="form-check-label">Wanita</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-label">Posisi Dituju</div>
                        <div class="mb-4">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="OPERATOR"
                                    checked="" id="pOperator">
                                <span class="form-check-label">Operator</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="PENGEMUDI"
                                    checked="" id="pPengemudi">
                                <span class="form-check-label">Pengemudi</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="IT"
                                    checked="" id="pIT">
                                <span class="form-check-label">IT</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="HRD"
                                    checked="" id="pHRD">
                                <span class="form-check-label">HRD</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="KEAMANAN"
                                    checked="" id="pKeamanan">
                                <span class="form-check-label">Keamanan</span>
                            </label>
                        </div>
                        <div class="form-label">Tinggi Minimal</div>
                        <div class="mb-4">
                            <input type="number" min="0" max="300" class="form-control" id="tinggi">
                        </div>
                        <div class="form-label">Proses Wawancara</div>
                        <div class="mb-4">
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <span class="form-check-label form-check-label-on">Sudah</span>
                                <span class="form-check-label form-check-label-off">Belum</span>
                            </label>
                        </div>
                        <div class="mt-5">
                            <button type="button" class="btn btn-primary w-100" id="btn-filter">Filter
                                Data</button> <br>
                            <button type="button" class="btn btn-link w-100" id="btn-reset-items">Reset to
                                defaults</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="genTHR" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" name="formGenerate" id="formGenerate" class="form"
                        enctype="multipart/form-data" accept-charset="utf-8" onkeydown="return event.key != 'Enter';">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tentukan Periode THR</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun THR</label>
                                        <select name="tahun" id="tahun" class="form-select border border-primary">
                                            @for ($i = date('Y'); $i >= 2020; $i--)
                                                <option value="{{ $i }}"
                                                    {{ date('Y') == $i ? 'selected="selected"' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Hari Raya</label>
                                        <input type="date" class="form-control border border-primary" name="tglThr"
                                            id="tglThr" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto border border-primary" data-bs-dismiss="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M9 12h12l-3 -3" />
                                    <path d="M18 15l3 -3" />
                                </svg>
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary" id="submitTHR">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var tableTunjangan;
            $(function() {
                if ($("#formGenerate").length > 0) {
                    $("#formGenerate").validate({
                        rules: {
                            tahun: {
                                required: true,
                            },
                            tglThr: {
                                required: true,
                            },
                        },
                        messages: {
                            tahun: {
                                required: "Masukkan Tahun THR",
                            },
                            tglThr: {
                                required: "Masukkan Tanggal Hari Raya",
                            },
                        },

                        submitHandler: function(form) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $('#submitTHR').html(
                                '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Mohon Menunggu...');
                            $("#submitTHR").attr("disabled", true);

                            $.ajax({
                                url: "{{ url('generateTunjangan') }}",
                                type: "POST",
                                data: $('#formGenerate').serialize(),
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Menyimpan Data',
                                        html: '<center><lottie-player src="https://assets9.lottiefiles.com/private_files/lf30_al2qt2jz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    })
                                },
                                success: function(response) {
                                    console.log('Result:', response);
                                    $('#submitTHR').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                    );
                                    $("#submitTHR").attr("disabled", false);
                                    tableTunjangan.ajax.reload();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 4000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal.resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: response.msg,
                                    });
                                    $('#genTHR').modal('hide');
                                    document.getElementById("formGenerate").reset();
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    // const obj = JSON.parse(data.responseJSON);
                                    tableTunjangan.ajax.reload();
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#submitTHR').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                    );
                                    $("#submitTHR").attr("disabled", false);
                                }
                            });
                        }
                    })
                }

                var token = $("meta[name='csrf-token']").attr("content");

                tableTunjangan = $('.datatable-tunjangan').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
                    "scrollX": true,
                    "scrollCollapse": true,
                    "pagingType": 'full_numbers',
                    "dom": "<'card-header h3' B>" +
                        "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                        "<'table-responsive' <'col-sm-12'tr> >" +
                        "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                    "lengthMenu": [
                        [10, 25, 35, 40, 50, -1],
                        ['10', '25', '35', '40', '50', 'Tampilkan Semua']
                    ],
                    buttons: [{
                            text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-filter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg> Filter',
                            className: 'btn btn-blue',
                            attr: {
                                'href': '#offcanvasEnd-lamaran',
                                'data-bs-toggle': 'offcanvas',
                                'role': 'button',
                                'aria-controls': 'offcanvasEnd',
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            autoFilter: true,
                            className: 'btn btn-success',
                            text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-table"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /><path d="M3 10h18" /><path d="M10 3v18" /></svg> Download Excel',
                            action: newexportaction,
                        },
                        {
                            text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ticket"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 5l0 2" /><path d="M15 11l0 2" /><path d="M15 17l0 2" /><path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" /></svg> Slip Gaji',
                            className: 'btn btn-indigo',
                            action: function(e, node, config) {
                                $('#modalSlipGaji').modal('show')
                            }
                        },
                    ],
                    "language": {
                        "lengthMenu": "Menampilkan _MENU_",
                        "zeroRecords": "Data Tidak Ditemukan",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
                        "infoEmpty": "Data Tidak Ditemukan",
                        "infoFiltered": "(Difilter dari _MAX_ total records)",
                        "processing": '<div class="container container-slim py-4"><div class="text-center"><div class="mb-3"></div><div class="text-secondary mb-3">Loading Data...</div><div class="progress progress-sm"><div class="progress-bar progress-bar-indeterminate"></div></div></div></div>',
                        "search": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>',
                        "paginate": {
                            "first": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6v12"></path><path d="M18 6l-6 6l6 6"></path></svg>',
                            "last": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 6l6 6l-6 6"></path><path d="M17 5v13"></path></svg>',
                            "next": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>',
                            "previous": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>',
                        },
                        "decimal": ",",
                        "thousands": ".",
                        "select": {
                            rows: {
                                _: "%d karyawan dipilih",
                                0: "Pilih beberapa item",
                            }
                        },
                    },
                    "ajax": {
                        "url": "{{ route('getTunjanganHariRaya.index') }}",
                        "data": function(data) {
                            data._token = "{{ csrf_token() }}";
                            data.tahun = $('#tahun').val();
                        }
                    },
                    columnDefs: [{
                            'targets': 0,
                            "orderable": false,
                            'className': 'select-checkbox',
                            'checkboxes': {
                                'selectRow': true
                            },
                        }

                    ],
                    select: {
                        'style': 'multi',
                        "selector": 'td:not(:nth-child(4))',
                    },
                    columns: [{
                            title: '',
                            data: 'select_orders',
                            name: 'select_orders',
                            className: 'cuspad2',
                            orderable: false,
                            searchable: false
                        }, {
                            title: 'STB',
                            data: 'stb',
                            name: 'stb',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Nama',
                            data: 'nama',
                            name: 'nama',
                            className: 'cuspad0'
                        },
                        {
                            title: 'Level',
                            data: 'level',
                            name: 'level',
                            className: 'cuspad0'
                        },
                        {
                            title: 'Gaji',
                            data: 'gapok',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            name: 'gapok',
                            className: 'cuspad0 text-center text-green'
                        },
                        {
                            title: 'T.Jabatan',
                            data: 'tjabat',
                            name: 'tjabat',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            className: 'cuspad0 text-center text-green'
                        },
                        {
                            title: 'Prestasi',
                            data: 'prestasi',
                            name: 'prestasi',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            className: 'cuspad0 text-center text-green'
                        },
                        {
                            title: 'Bank',
                            data: 'bank',
                            name: 'bank',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'No. Rekening',
                            data: 'rekening',
                            name: 'rekening',
                            className: 'cuspad0 text-center'
                        },
                    ],
                });

                var selected = new Array();
                $('#modalSlipGaji').on('show.bs.modal', function(e) {
                    $(".ovly").fadeIn(300);
                    itemTables = [];
                    $.each(tablePayroll.rows('.selected').nodes(), function(index, rowId) {
                        var rows_selected = tablePayroll.rows('.selected').data();
                        itemTables.push(rows_selected[index]['id']);
                    });
                    console.log(itemTables);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //menggunakan fungsi ajax untuk pengambilan data
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('getSlipgaji') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: itemTables,
                            jml: itemTables.length,
                        },
                        success: function(data) {
                            $('.fetched-data-slipgaji').html(data);
                            //menampilkan data ke dalam modal
                            // alert(itemTables);
                        }
                    }).done(function() {
                        setTimeout(function() {
                            $(".ovly").fadeOut(300);
                        }, 500);
                    });
                });
            });
            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/

            function newexportaction(e, dt, button, config) {
                var self = this;
                var oldStart = dt.settings()[0]._iDisplayStart;
                dt.one('preXhr', function(e, s, data) {
                    // Just this once, load all data from the server...
                    data.start = 0;
                    data.length = 2147483647;
                    dt.one('preDraw', function(e, settings) {
                        // Call the original action function
                        if (button[0].className.indexOf('buttons-copy') >= 0) {
                            $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                            $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                            $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                                $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                            $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                                $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-print') >= 0) {
                            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                        }
                        dt.one('preXhr', function(e, s, data) {
                            // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                            // Set the property to what it was before exporting.
                            settings._iDisplayStart = oldStart;
                            data.start = oldStart;
                        });
                        // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                        setTimeout(dt.ajax.reload, 0);
                        // Prevent rendering of the full data to the DOM
                        return false;
                    });
                });
                // Requery the server with the new one-time export settings
                dt.ajax.reload();
            }

            var d = new Date();
            var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();

            function syn() {
                tablePayroll.ajax.reload();
            }

            function generatePayroll() {
                var bln = $('#bulan').val();
                var thn = $('#tahun').val();
                Swal.fire({
                    icon: 'question',
                    title: 'Generate Payroll',
                    text: 'Apakah anda yakin ingin Perbarui data Payroll Bulan ' + bln + ' ' + thn + '?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: ' Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Generate Payroll: ' + bln + '/' + thn);
                        $(".spinnerLoading").fadeIn(200);
                        $(".card-body").addClass("disabled");
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('generatePayroll') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'bulan': bln,
                                'tahun': thn,
                            },
                        }).done(function() {
                            tablePayroll.ajax.reload();
                            setTimeout(function() {
                                $(".spinnerLoading").fadeOut(200);
                                $('.setStatus').html(
                                        '<div class="alert alert-important alert-success alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg></div><div>Berhasil Generate</div></div><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>'
                                    )
                                    .delay(6000)
                                    .fadeOut(function() {
                                        $(this).remove();
                                    });
                            }, 300);
                            $(".card-body").removeClass("disabled");
                        });
                    }
                });
            }

            function generateKaryawan() {
                var bln = $('#bulan').val();
                var thn = $('#tahun').val();
                Swal.fire({
                    icon: 'question',
                    title: 'Generate Karyawan',
                    text: 'Apakah anda yakin ingin Perbarui data Detail Karyawan untuk payroll Bulan ' + bln + ' ' +
                        thn + '?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: ' Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Generate karyawan: ' + bln + '/' + thn);
                        $(".spinnerLoading").fadeIn(200);
                        $(".card-body").addClass("disabled");
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('generateKaryawan') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'bulan': bln,
                                'tahun': thn,
                            },
                        }).done(function() {
                            tablePayroll.ajax.reload();
                            setTimeout(function() {
                                $(".spinnerLoading").fadeOut(200);
                                $('.setStatus').html(
                                        '<div class="alert alert-important alert-success alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg></div><div>Berhasil Generate</div></div><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>'
                                    )
                                    .delay(6000)
                                    .fadeOut(function() {
                                        $(this).remove();
                                    });
                            }, 300);
                            $(".card-body").removeClass("disabled");
                        });
                    }
                });
            }

            function generateBPJS() {
                var bln = $('#bulan').val();
                var thn = $('#tahun').val();
                Swal.fire({
                    icon: 'question',
                    title: 'Generate BPJS',
                    text: 'Apakah anda yakin ingin Perbarui data BPJS Karyawan untuk payroll Bulan ' + bln + ' ' +
                        thn + '?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: ' Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Generate BPJS: ' + bln + '/' + thn);
                        $(".spinnerLoading").fadeIn(200);
                        $(".card-body").addClass("disabled");
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('generateBPJS') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'bulan': bln,
                                'tahun': thn,
                            },
                        }).done(function() {
                            tablePayroll.ajax.reload();
                            setTimeout(function() {
                                $(".spinnerLoading").fadeOut(200);
                                $('.setStatus').html(
                                        '<div class="alert alert-important alert-success alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg></div><div>Berhasil Generate</div></div><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>'
                                    )
                                    .delay(6000)
                                    .fadeOut(function() {
                                        $(this).remove();
                                    });
                            }, 300);
                            $(".card-body").removeClass("disabled");
                        });
                    }
                });
            }

            function setPeriodeToUpload() {
                var bln = $('#bulan').val();
                var thn = $('#tahun').val();

                $('#periodeUpload').val(thn.substring(2, 4) + bln)
            }
            // Disable Error Notification
            // $.fn.dataTable.ext.errMode = 'none';
        </script>
        <script>
            $.fn.editable.defaults.mode = 'inline';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('.editable').editable({
                url: '/umr/update',
                type: 'text',
                pk: 1,
                name: 'nominal',
                title: 'Enter nominal',
            });

            $('.editableLevel').editable({
                url: '/karyawan/update',
                type: 'text',
                pk: 1,
                name: 'level',
                title: 'Enter Level',
            });
        </script>
    @endsection
