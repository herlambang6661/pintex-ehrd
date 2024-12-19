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
            /* padding-top: 0.5px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  margin-left: 5px; */
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
    </style>
    <div class="page">
        <!-- Sidebar -->
        @include('shared.sidebar')
        <!-- Navbar -->
        @include('shared.navbar')
        <script>
            var tb1;
        </script>
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-id">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                    <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M15 8l2 0" />
                                    <path d="M15 12l2 0" />
                                    <path d="M7 16l10 0" />
                                </svg>
                                List Absensi
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-calendar-days"></i>
                                            Absensi</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-regular fa-calendar-check"></i> List Absensi</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <div class="input-group">
                                    <script type="text/javascript">
                                        $(function() {
                                            $('.tglstart').val($('.tglaw').val());
                                            $('.tglend').val($('.tglak').val());
                                            $('.tglaw').on('keydown keyup load change hover', function() {
                                                var sp = this.value;
                                                $('.tglstart').val(sp);
                                            });
                                            $('.tglak').on('keydown keyup load change hover', function() {
                                                var sp = this.value;
                                                $('.tglend').val(sp);
                                            });
                                        });
                                    </script>
                                    {{-- @if (Auth::user()->username == 'Yudha' || Auth::user()->role == 'super') --}}
                                    <button type="button" class="btn btn-info d-none d-sm-inline-block" id="btnSynKom">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                        Sinkronisasi Komunikasi
                                    </button>
                                    <button data-bs-toggle="dropdown" type="button"
                                        class="btn btn-info dropdown-toggle dropdown-toggle-split"
                                        aria-expanded="false"></button>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <form action="{{ url('exportAbsen') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="jns" id="jns" value="fingerprint">
                                            <input type="hidden" name="dari" class="tglstart">
                                            <input type="hidden" name="sampai" class="tglend">
                                            <button type="submit" class="dropdown-item text-blue">
                                                <i class="fa-solid fa-fingerprint" style="margin-right:5px"></i>
                                                Unduh Data Fingerprint
                                            </button>
                                        </form>
                                        <form action="{{ url('absenkosong') }}" method="get" target="_blank">
                                            {{-- @csrf --}}
                                            <input type="hidden" name="jns" id="jns" value="alpa">
                                            <input type="hidden" name="tglstart" class="tglstart">
                                            <input type="hidden" name="tglend" class="tglend">
                                            <button type="submit" class="dropdown-item text-red">
                                                <i class="fa-solid fa-person-running" style="margin-right:5px"></i>
                                                Data Alfa
                                            </button>
                                        </form>
                                        <form action="{{ url('absenkosong') }}" method="get" target="_blank">
                                            <input type="hidden" name="jns" id="jns" value="f1f2">
                                            <input type="hidden" name="tglstart" class="tglstart">
                                            <input type="hidden" name="tglend" class="tglend">
                                            <button type="submit" class="dropdown-item text-yellow">
                                                <i class="fa-solid fa-circle-exclamation" style="margin-right:5px"></i>
                                                Data F1F2
                                            </button>
                                        </form>
                                        {{-- <button type="button" class="dropdown-item" id="fixUmum">
                                            <i class="fa-solid fa-truck-front" style="margin-right:5px"></i>
                                            Perbaiki Absensi Umum
                                        </button> --}}
                                        <form action="{{ url('exportSKD') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="jns" id="jns" value="sakit">
                                            <input type="hidden" name="skdstart" class="tglstart">
                                            <input type="hidden" name="skdend" class="tglend">
                                            <button type="submit" class="dropdown-item text-green">
                                                <i class="fa-solid fa-user-doctor" style="margin-right:5px"></i>
                                                Unduh Surat Keterangan Dokter
                                            </button>
                                        </form>
                                    </div>
                                    {{-- @endif --}}
                                </div>
                            </div>
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
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="row row-cards">
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
                                            <div class="table-responsive">
                                                <table class=" mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Tanggal Awal</th>
                                                            <th>Tanggal Akhir</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="date" class="form-control tglaw"
                                                                    value="{{ date('Y-m-16', strtotime('first day of -1 month')) }}"
                                                                    id="datepicker0">
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control tglak"
                                                                    value="{{ date('Y-m-15') }}" id="datepicker1">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary" onclick="tb();"><i
                                                                        class="fa-solid fa-magnifying-glass"
                                                                        style="margin-right:5px"></i>
                                                                    Perbarui</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <li class="list-group-item placeholder-glow placehold-absensi"
                                                    style="display:none">
                                                    <div class="row align-items-center">
                                                        <div class="col-2">
                                                            <div class="placeholder placeholder-xs col-4"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-4"></div>
                                                        </div>
                                                        <div class="col-10 ms-auto text-end">
                                                            <div class="placeholder placeholder-xs col-2"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-12"></div>
                                                            <div class="placeholder placeholder-xs col-4"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </div>
                                        </div>
                                        <div class="fetched-data-absensi"></div>
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
                <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Absensi</h2>
                <button type="button" class="btn-close text-reset text-dark" data-bs-dismiss="offcanvas"
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
                        <div class="form-label">Status Karyawan</div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <select name="fstatus" id="fstatus" class="form-select border-primary">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Resign">Resign</option>
                                        <option value="Habis">Habis Kontrak</option>
                                        <option value="PHK">PHK</option>
                                        <option value="*">Semua</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-label">Bagian</div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <select name="fbagian" id="fbagian" class="form-select border-primary">
                                        <option value="*">Semua</option>
                                        <option value="AKUNTING & KEUANGAN">AKUNTING & KEUANGAN</option>
                                        <option value="GUDANG">GUDANG</option>
                                        <option value="KEAMANAN">KEAMANAN</option>
                                        <option value="KEBERSIHAN">KEBERSIHAN</option>
                                        <option value="PERSONALIA">PERSONALIA</option>
                                        <option value="TFI">TFI</option>
                                        <option value="TFO">TFO</option>
                                        <option value="UMUM">UMUM</option>
                                        <option value="UNIT 1">UNIT 1</option>
                                        <option value="UNIT 2">UNIT 2</option>
                                        <option value="WCR & WORKSHOP">WCR & WORKSHOP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-label">Jenis Shift</div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <select name="fshift" id="fshift" class="form-select border-primary">
                                        <option value="*">Semua</option>
                                        <option value="SHIFT">Shift</option>
                                        <option value="NON SHIFT">Non Shift</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-label">Grup</div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="A"
                                            checked="" id="gA">
                                        <span class="form-check-label">A</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="B"
                                            checked="" id="gB">
                                        <span class="form-check-label">B</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="C"
                                            checked="" id="gC">
                                        <span class="form-check-label">C</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="NON GRUP"
                                            checked="" id="gN">
                                        <span class="form-check-label">NON GRUP</span>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="MTC"
                                            checked="" id="gM">
                                        <span class="form-check-label">MTC</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="OPD"
                                            checked="" id="gO">
                                        <span class="form-check-label">OPD</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="PPC/QC"
                                            checked="" id="gP">
                                        <span class="form-check-label">PPC/QC</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="grup[]" value="B"
                                            checked="" id="gB">
                                        <span class="form-check-label">B</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="button" class="btn btn-primary w-100" onclick="syn()" id="btn-filter">Filter
                                Data</button> <br>
                            <input type="reset" class="btn btn-link w-100" id="btn-reset-items"
                                value="Reset"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                $('.modal-detail-absensi').on('show.bs.modal', function(e) {
                    var rowid = $(e.relatedTarget).data('id');
                    var rowaw = $(e.relatedTarget).data('tglaw');
                    var rowak = $(e.relatedTarget).data('tglak');
                    console.log("Fetch: " + rowid);
                    $(".overlay").fadeIn(300);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('listAbsensiDetail') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: rowid,
                            tglaw: rowaw,
                            tglak: rowak,
                        },
                        success: function(data) {
                            $('.fetched-absensi-detail').html(
                                data); //menampilkan data ke dalam modal
                        }
                    }).done(function() {
                        setTimeout(function() {
                            $(".overlay").fadeOut(300);
                        }, 500);
                    });
                });


                $('#btnSynKom').click(function() {
                    var token = $("meta[name='csrf-token']").attr("content");
                    var tglaw = $('.tglaw').val();
                    var tglak = $('.tglak').val();
                    Swal.fire({
                        icon: 'question',
                        title: 'Perbarui Data Komunikasi',
                        text: 'Apakah anda yakin ingin Perbarui data absen tanggal ' + tglaw + ' - ' +
                            tglak + ' ?',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: ' Ya',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "{{ url('syncKom') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'tglaw': tglaw,
                                    'tglak': tglak,
                                },
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Mohon Menunggu',
                                        html: '<center><lottie-player src="https://lottie.host/f6ad03a7-1560-4082-8f73-eba358540a2a/jwBLWkLRwZ.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang Sinkronisasi data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    });
                                    console.log('fetch data: ' + tglaw + ' - ' + tglak);
                                },
                                success: function(data) {
                                    console.log(data);
                                    tb();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: "Berhasil Memperbarui data Surat Komunikasi"
                                    });
                                },
                                error: function(data) {
                                    console.log(data);
                                    console.log('Error:', data.error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Error: ' + data.responseText,
                                        showConfirmButton: true,
                                    });
                                }
                            });
                        }
                    });
                    // tableAbsensi.ajax.reload(); //just reload table
                });
                $('#fixUmum').click(function() {
                    var token = $("meta[name='csrf-token']").attr("content");
                    var tglaw = $('.tglaw').val();
                    var tglak = $('.tglak').val();
                    Swal.fire({
                        icon: 'question',
                        title: 'Perbarui Data Komunikasi Sopir',
                        text: 'Apakah anda yakin ingin Perbarui data absen tanggal ' + tglaw + ' - ' +
                            tglak + ' untuk sopir?',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: ' Ya',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "{{ url('fixUmum') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'tglaw': tglaw,
                                    'tglak': tglak,
                                },
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Mohon Menunggu',
                                        html: '<center><lottie-player src="https://lottie.host/f6ad03a7-1560-4082-8f73-eba358540a2a/jwBLWkLRwZ.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang Sinkronisasi data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    });
                                    console.log('fetch data: ' + tglaw + ' - ' + tglak);
                                },
                                success: function(data) {
                                    console.log(data);
                                    tb();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: "Berhasil Memperbarui data Absensi"
                                    });
                                },
                                error: function(data) {
                                    console.log(data);
                                    console.log('Error:', data.error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Error: ' + data.responseText,
                                        showConfirmButton: true,
                                    });
                                }
                            });
                        }
                    });
                    // tableAbsensi.ajax.reload(); //just reload table
                });
                $('#fixCM').click(function() {
                    var token = $("meta[name='csrf-token']").attr("content");
                    var tglaw = $('.tglaw').val();
                    var tglak = $('.tglak').val();
                    Swal.fire({
                        icon: 'question',
                        title: 'Perbarui Data Komunikasi Cuti Melahirkan',
                        text: 'Apakah anda yakin ingin Perbarui data absen tanggal ' + tglaw + ' - ' +
                            tglak + ' untuk karyawan Hamil?',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: ' Ya',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "{{ url('fixCutiMelahirkan') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'tglaw': tglaw,
                                    'tglak': tglak,
                                },
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Mohon Menunggu',
                                        html: '<center><lottie-player src="https://lottie.host/f6ad03a7-1560-4082-8f73-eba358540a2a/jwBLWkLRwZ.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang Sinkronisasi data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    });
                                    console.log('fetch data: ' + tglaw + ' - ' + tglak);
                                },
                                success: function(data) {
                                    console.log(data);
                                    tb();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: "Berhasil Memperbarui data Absensi"
                                    });
                                },
                                error: function(data) {
                                    console.log(data);
                                    console.log('Error:', data.error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Error: ' + data.responseText,
                                        showConfirmButton: true,
                                    });
                                }
                            });
                        }
                    });
                    // tableAbsensi.ajax.reload(); //just reload table
                });
            });
            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/

            function syn() {
                tb();
            }

            Date.prototype.addDays = function(days) {
                var dat = new Date(this.valueOf())
                dat.setDate(dat.getDate() + days);
                return dat;
            }

            function getDates(startDate, stopDate) {
                var dateArray = new Array();
                var currentDate = startDate;
                while (currentDate <= stopDate) {
                    dateArray.push(currentDate)
                    currentDate = currentDate.addDays(1);
                }
                return dateArray;
            }

            function monthDiff(d1, d2) {
                var months;
                months = (d2.getFullYear() - d1.getFullYear()) * 12;
                months -= d1.getMonth();
                months += d2.getMonth();
                return months <= 0 ? 0 : months;
            }

            function tb() {
                var tglfull = [];
                const days = [];
                const month = [];
                var dateArray = getDates(new Date($('.tglaw').val()), (new Date($('.tglak').val())));
                var monthArray = monthDiff(new Date($('.tglaw').val()), (new Date($('.tglak').val())));

                for (i = 0; i < dateArray.length; i++) {
                    days.push(dateArray[i].getDate());
                }
                for (i = 0; i < dateArray.length; i++) {
                    var dateString = new Date(dateArray[i].getTime() - (dateArray[i].getTimezoneOffset() * 60000))
                        .toISOString()
                        .split("T")[0];
                    tglfull.push(dateString);
                }
                var aw = $('.tglaw').val();
                var ak = $('.tglak').val();
                console.log("Fetch: " + aw + " - " + ak);

                $(".placehold-absensi").fadeIn(200);
                $('.fetched-data-absensi').html('');
                // var tglaw = $('.tglaw').val();
                // var tglak = $('.tglak').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: "{{ url('getabsensi') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'tglfull': tglfull,
                        'tgl': days,
                        'aw': aw,
                        'ak': ak,
                        'tglaw': $('.tglaw').val(),
                        'tglak': $('.tglak').val(),
                        'fbagian': $('#fbagian').val(),
                        'fstatus': $('#fstatus').val(),
                        'fshift': $('#fshift').val(),
                    },
                    success: function(data) {
                        $('.fetched-data-absensi').html(data);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".placehold-absensi").fadeOut(200);
                    }, 50);
                });
            }
            // Disable Error Notification
            // $.fn.dataTable.ext.errMode = 'none';
        </script>

        <div class="modal modal-blur fade modal-detail-absensi" tabindex="-1" style="display: none;"
            aria-hidden="true">
            <div class="overlay">
                <div class="loader">
                    <span class="spinner spinner1"></span>
                    <span class="spinner spinner2"></span>
                    <span class="spinner spinner3"></span>
                    <br>
                    <span class="loader-text">MEMUAT DATA</span>
                </div>
            </div>
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                            Detail Absensi Karyawan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-2">
                        <div class="fetched-absensi-detail"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l14 0" />
                                <path d="M5 12l6 6" />
                                <path d="M5 12l6 -6" />
                            </svg>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
