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

        /* .cv-spinner {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                height: 100%;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                display: flex;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                justify-content: center;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                align-items: center;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            .spinner {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                width: 40px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                height: 40px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                border: 4px #ddd solid;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                border-top: 4px #2e93e6 solid;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                border-radius: 50%;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                animation: sp-anime 0.8s infinite linear;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @keyframes sp-anime {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                100% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    transform: rotate(360deg);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            .is-hide {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                display: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */
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
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-dollar">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                    <path d="M12 17v1m0 -8v1" />
                                </svg>
                                Payroll
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
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-solid fa-file-invoice-dollar"></i> Payroll
                                            <i class="text-danger"> (Restricted Area).</i>
                                        </a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <table class="table">
                                    <tr>
                                        <td>UMR</td>
                                        <td>:</td>
                                        <td><a href="" class="editable" data-type="text" data-name="nominal"
                                                data-pk="{{ $pkumr }}">{{ $nominal }}</a></td>
                                    </tr>
                                </table>
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
                                                <i class="fa-solid fa-sack-dollar"></i>
                                            </div>
                                        </div>
                                        <div class="row row-cards">
                                            <div class="col-sm-12 col-md-12 col-lg-5">
                                                <label class="form-label">Periode Gaji </label>
                                                <div class="input-group">
                                                    <select name="bulan" id="bulan"
                                                        class="form-select border border-primary">
                                                        <option value="01"
                                                            {{ date('m') == '01' ? 'selected="selected"' : '' }}>
                                                            Januari</option>
                                                        <option value="02"
                                                            {{ date('m') == '02' ? 'selected="selected"' : '' }}>
                                                            Februari</option>
                                                        <option value="03"
                                                            {{ date('m') == '03' ? 'selected="selected"' : '' }}>
                                                            Maret</option>
                                                        <option value="04"
                                                            {{ date('m') == '04' ? 'selected="selected"' : '' }}>
                                                            April</option>
                                                        <option value="05"
                                                            {{ date('m') == '05' ? 'selected="selected"' : '' }}>
                                                            Mei</option>
                                                        <option value="06"
                                                            {{ date('m') == '06' ? 'selected="selected"' : '' }}>
                                                            Juni</option>
                                                        <option value="07"
                                                            {{ date('m') == '07' ? 'selected="selected"' : '' }}>
                                                            Juli</option>
                                                        <option value="08"
                                                            {{ date('m') == '08' ? 'selected="selected"' : '' }}>
                                                            Agustus</option>
                                                        <option value="09"
                                                            {{ date('m') == '09' ? 'selected="selected"' : '' }}>
                                                            September</option>
                                                        <option value="10"
                                                            {{ date('m') == '10' ? 'selected="selected"' : '' }}>
                                                            Oktober</option>
                                                        <option value="11"
                                                            {{ date('m') == '11' ? 'selected="selected"' : '' }}>
                                                            November</option>
                                                        <option value="12"
                                                            {{ date('m') == '12' ? 'selected="selected"' : '' }}>
                                                            Desember</option>
                                                    </select>
                                                    <select name="tahun" id="tahun"
                                                        class="form-select border border-primary">
                                                        @for ($i = date('Y'); $i >= 2020; $i--)
                                                            <option value="{{ $i }}"
                                                                {{ date('Y') == $i ? 'selected="selected"' : '' }}>
                                                                {{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <button class="btn btn-primary " onclick="syn();"><i
                                                            class="fa-solid fa-magnifying-glass"
                                                            style="margin-right:5px"></i>
                                                        Perbarui</button>
                                                    <button data-bs-toggle="dropdown" type="button"
                                                        class="btn btn-primary  dropdown-toggle dropdown-toggle-split"
                                                        aria-expanded="false"></button>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <button class="dropdown-item" type="button"
                                                            onclick="generatePayroll();">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                style="margin-right: 5px" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-dollar">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3" />
                                                                <path
                                                                    d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                                <path d="M19 21v1m0 -8v1" />
                                                            </svg>
                                                            Generate Data Payroll
                                                        </button>
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
                                        {{-- @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif --}}
                                        <div class="setStatus"></div>
                                        <div class="table-responsive">
                                            <table style="width:100%; font-size:13px"
                                                class="display table table-sm  table-bordered table-hover text-nowrap datatable-payroll"
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
        <div class="modal modal-blur fade" id="modal-tambahan" tabindex="-1" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 9l5 -5l5 5" />
                                <path d="M12 4l0 12" />
                            </svg>
                            Upload Data Tambahan / Potongan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/payroll/import_excel" enctype="multipart/form-data">
                            <div class="form-label">
                                Upload Excel
                                <a href="/payroll/export_excel">
                                    <i>( Download file contoh )</i>
                                </a>
                            </div>

                            <div class="input-group">
                                {{ csrf_field() }}
                                <input type="hidden" name="periode" id="periodeUpload" value="">
                                <input type="file" name="file" required="required" class="form-control"
                                    accept=".xl*">
                                <button type="submit" class="btn btn-primary">Upload Excel</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Kembali</button>
                        {{-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button> --}}
                    </div>
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

            var tablePayroll;
            var d = new Date();
            var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
            $(function() {
                var token = $("meta[name='csrf-token']").attr("content");

                tablePayroll = $('.datatable-payroll').DataTable({
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
                            className: 'btn btn-orange',
                            attr: {
                                'href': '#offcanvasEnd-lamaran',
                                'data-bs-toggle': 'offcanvas',
                                'role': 'button',
                                'aria-controls': 'offcanvasEnd',
                            }
                        },
                        {
                            text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3v18h18" /><path d="M20 18v3" /><path d="M16 16v5" /><path d="M12 13v8" /><path d="M8 16v5" /><path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" /></svg> Rekap',
                            className: 'btn btn-dark',
                            attr: {
                                'href': '#offcanvasEnd-lamaran',
                                'data-bs-toggle': 'offcanvas',
                                'role': 'button',
                                'aria-controls': 'offcanvasEnd',
                            }
                        },
                        {
                            text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus-minus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h6" /><path d="M7 4v6" /><path d="M20 18h-6" /><path d="M5 19l14 -14" /></svg> Tambahan / Potongan',
                            className: 'btn btn-red',
                            attr: {
                                'href': '#modal-tambahan',
                                'data-bs-toggle': 'modal',
                                'onclick': 'setPeriodeToUpload()',
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
                                0: "Pilih item dan tekan tombol Proses data untuk memproses",
                            }
                        },
                    },
                    // ajax: "{{ route('getAbsensiLocal.index') }}",

                    "ajax": {
                        "url": "{{ route('getPayroll.index') }}",
                        "data": function(data) {
                            data._token = "{{ csrf_token() }}";
                            data.bulan = $('#bulan').val();
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
                        "selector": 'td:not(:nth-child(2))',
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
                            title: 'Gaji',
                            data: 'gapok',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            name: 'gapok',
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
                            title: 'T.Jabatan',
                            data: 'tjabat',
                            name: 'tjabat',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            className: 'cuspad0 text-center text-green'
                        },
                        {
                            title: 'Gaji Bruto',
                            data: 'gbruto',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            name: 'gbruto',
                            className: 'cuspad0 text-center text-green'
                        },
                        {
                            title: 'Pot. Bpjs',
                            data: 'potbpjs',
                            name: 'potbpjs',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            className: 'cuspad0 text-center text-red'
                        },
                        {
                            title: 'Pot. Lain',
                            data: 'potlain',
                            name: 'potlain',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            className: 'cuspad0 text-center text-red'
                        },
                        {
                            title: 'Gaji Netto',
                            data: 'gnetto',
                            name: 'gnetto',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            className: 'cuspad0 text-center text-green'
                        },
                        {
                            title: 'Pembulatan',
                            data: 'pembulatan',
                            name: 'pembulatan',
                            render: $.fn.dataTable.render.number('.', ',', 0, ''),
                            className: 'cuspad0 text-center'
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

            });

            function syn() {
                tablePayroll.ajax.reload();
            }

            function generatePayroll() {
                var bln = $('#bulan').val();
                var thn = $('#tahun').val();
                console.log('Generate payroll: ' + bln + '/' + thn);
                $(".spinnerLoading").fadeIn(200);
                $('.fetched-data-absensi').html('');
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
                    success: function(data) {
                        $('.fetched-data-absensi').html(data);
                    }
                }).done(function() {
                    tablePayroll.ajax.reload();
                    setTimeout(function() {
                        $(".spinnerLoading").fadeOut(200);
                        $('.setStatus').html(
                                '<div class="alert alert-important alert-success alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg></div><div>Berhasil Generate</div></div><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>'
                            )
                            .delay(3000)
                            .fadeOut(function() {
                                $(this).remove();
                            });
                    }, 300);
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
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Absensi Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-absensi-detail"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
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
        </script>
    @endsection