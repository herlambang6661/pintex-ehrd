<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">


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
            /* padding-top: 0.5px;
                                                                                                                        padding-bottom: 0.5px;
                                                                                                                        padding-right: 0.5px;
                                                                                                                        padding-left: 0.5px;
                                                                                                                        margin-top: 5px;
                                                                                                                        margin-bottom: 5px;
                                                                                                                        margin-right: 5px;
                                                                                                                        margin-left: 5px; */
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
                                <a href="#" class="btn btn-danger d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#modal-lamaran" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <i class="fa-solid fa-person-running"></i>
                                    Data Alfa
                                </a>
                                <a href="#" class="btn btn-warning d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#importExcel" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint-off">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                                        <path
                                            d="M8 11c0 -.848 .264 -1.634 .713 -2.28m2.4 -1.621a4 4 0 0 1 4.887 3.901l0 1" />
                                        <path d="M12 12v1a14 14 0 0 0 2.5 8" />
                                        <path d="M8 15a18 18 0 0 0 1.8 6" />
                                        <path
                                            d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 1.854 -5.143m2.176 -1.825a8 8 0 0 1 7.97 .018" />
                                        <path d="M3 3l18 18" />
                                    </svg>
                                    Data F1F2
                                </a>
                                <a href="#" class="btn btn-danger d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#modal-lamaran" aria-label="Tambah Lamaran">
                                    <i class="fa-solid fa-person-running"></i>
                                </a>
                                <a href="#" class="btn btn-warning d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#modal-upload" aria-label="Upload Excel">
                                    <i class="fa-solid fa-user-slash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        {{-- <div class="col-12">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        <div class="col-md-12">
                            <div class="card card-xl shadow rounded">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-gaji" class="nav-link active" data-bs-toggle="tab"
                                                aria-selected="true" role="tab">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                                    <path d="M3 10h18" />
                                                    <path d="M16 19h6" />
                                                    <path d="M19 16l3 3l-3 3" />
                                                    <path d="M7.005 15h.005" />
                                                    <path d="M11 15h2" />
                                                </svg>
                                                Periode Gaji
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-bulan" class="nav-link" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M7 14h.013" />
                                                    <path d="M10.01 14h.005" />
                                                    <path d="M13.01 14h.005" />
                                                    <path d="M16.015 14h.005" />
                                                    <path d="M13.015 17h.005" />
                                                    <path d="M7.01 17h.005" />
                                                    <path d="M10.01 17h.005" />
                                                </svg>
                                                Periode Bulan
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="tabs-gaji" role="tabpanel">
                                        <div class="card-stamp card-stamp-lg">
                                            <div class="card-stamp-icon bg-success">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="card card-xl shadow rounded">
                                            <div class="card-body">
                                                <div class="row row-cards">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
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
                                                                            value="{{ date('Y-m-16') }}" id="datepicker0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" class="form-control tglak"
                                                                            value="{{ date('Y-m-15', strtotime('first day of +1 month')) }}"
                                                                            id="datepicker1">
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
                                                    <div class="table-responsive">
                                                        <table style="width:100%; font-size:12px"
                                                            class="display table  mb-0 table-sm table-striped table-bordered table-hover text-nowrap datatable-absensi">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>STB</th>
                                                                    <th>NAMA</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12">
                                                        <div class="ph-item" style="display:none">
                                                            <div class="ph-col-3">
                                                                <div class="ph-picture"></div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-4 "></div>
                                                                    <div class="ph-col-4"></div>
                                                                    <div class="ph-col-2 "></div>
                                                                    <div class="ph-col-2"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-8"></div>
                                                                    <div class="ph-col-4"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-12"></div>
                                                                </div>
                                                            </div>
                                                            <div class="ph-col-3">
                                                                <div class="ph-picture"></div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-4 "></div>
                                                                    <div class="ph-col-4"></div>
                                                                    <div class="ph-col-2 "></div>
                                                                    <div class="ph-col-2"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-8"></div>
                                                                    <div class="ph-col-4"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-12"></div>
                                                                </div>
                                                            </div>
                                                            <div class="ph-col-3">
                                                                <div class="ph-picture"></div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-4 "></div>
                                                                    <div class="ph-col-4"></div>
                                                                    <div class="ph-col-2 "></div>
                                                                    <div class="ph-col-2"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-8"></div>
                                                                    <div class="ph-col-4"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-12"></div>
                                                                </div>
                                                            </div>
                                                            <div class="ph-col-3">
                                                                <div class="ph-picture"></div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-4 "></div>
                                                                    <div class="ph-col-4"></div>
                                                                    <div class="ph-col-2 "></div>
                                                                    <div class="ph-col-2"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-8"></div>
                                                                    <div class="ph-col-4"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-12"></div>
                                                                </div>
                                                            </div>
                                                            <div class="ph-col-3">
                                                                <div class="ph-picture"></div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-4 "></div>
                                                                    <div class="ph-col-4"></div>
                                                                    <div class="ph-col-2 "></div>
                                                                    <div class="ph-col-2"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-8"></div>
                                                                    <div class="ph-col-4"></div>
                                                                </div>
                                                                <div class="ph-row">
                                                                    <div class="ph-col-12"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fetched-data-absensi"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-bulan" role="tabpanel">
                                        <div class="card-body">
                                            <h4>Profile tab</h4>
                                            <div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus ut,
                                                molestias, amet deleniti cumque rem recusandae, incidunt distinctio quia
                                                nobis nostrum dolorum reiciendis! Quisquam deleniti omnis dolores! Tempore,
                                                blanditiis accusantium!</div>
                                        </div>
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
            <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Absensi</h2>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
                    <div class="form-label">Tanggal Penginputan</div>
                    <div class="row">
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input name="dari" class="form-control border-primary" placeholder="Select a date"
                                    id="datepicker2" value="<?= date('Y-01-01') ?>" />
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input name="sampai" class="form-control border-primary" placeholder="Select a date"
                                    id="" value="<?= date('Y-12-31') ?>" />
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-label">Jenis Kelamin</div>
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

    <script>
        $(function() {
            // tb();
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

        function tb() {
            $(".ph-item").fadeIn(200);
            $('.fetched-data-absensi').html('');
            var tglaw = $('.tglaw').val();
            var tglak = $('.tglak').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type: 'POST',
                url: '{{ url('getabsensi') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'tglaw': tglaw,
                    'tglak': tglak,
                },
                success: function(data) {
                    $('.fetched-data-absensi').html(data);
                }
            }).done(function() {
                setTimeout(function() {
                    $(".ph-item").fadeOut(200);
                }, 300);
            });
        }
    </script>
@endsection
