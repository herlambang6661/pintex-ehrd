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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                    <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                    <path d="M12 12l0 .01" />
                                    <path d="M3 13a20 20 0 0 0 18 0" />
                                </svg>
                                Lowongan Pekerjaan
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-box"></i>
                                            Daftar</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-solid fa-briefcase"></i> Lowongan Pekerjaan</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <ul class="nav">
                                    <a href="#tabs-tambah" class="nav-link btn bg-info text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab" style="margin-right: 5px">
                                        <i class="fa-solid fa-calendar-plus"></i>
                                        Tambah Data
                                    </a>
                                    <a href="#tabs-list"
                                        class="active nav-link btn bg-blue text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab">
                                        <i class="fa-solid fa-business-time"></i>
                                        List Lowongan
                                    </a>
                                    <a href="#tabs-tambah" class="btn btn-info d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="PHL" style="margin-right: 3px">
                                        <i class="fa-solid fa-calendar-plus"></i>
                                    </a>
                                    <a href="#tabs-list" class="btn btn-blue d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="list lowongan">
                                        <i class="fa-solid fa-business-time"></i>
                                    </a>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tabs-list" role="tabpanel">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-karyawan"
                                        id="tbkaryawan">
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-tambah" role="tabpanel">
                                <div class="card card-xl border-dark shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-dark">
                                            <i class="fa-solid fa-briefcase"></i>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h2>Tambah Lowongan Baru</h2>
                                    </div>
                                    <form id="formLoker" name="formLoker" method="post" action="javascript:void(0)">
                                        @csrf
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label required">Entitas</label>
                                                <input type="text"
                                                    class="form-control border border-dark bg-secondary-lt" name="entitas"
                                                    id="entitas" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Posisi Dibutuhkan</label>
                                                <div>
                                                    <select class="form-select" name="posisi">
                                                        <option hidden value="">-- Silahkan Pilih Posisi yang
                                                            dibutuhkan
                                                            --</option>
                                                        <option value="OPERATOR PRODUKSI">OPERATOR PRODUKSI</option>
                                                        <option value="HELPER GUDANG">HELPER GUDANG</option>
                                                        <option value="KEAMANAN / SECURITY">KEAMANAN / SECURITY</option>
                                                        <option value="PENGEMUDI">PENGEMUDI</option>
                                                        <option value="PENGEMUDI FORKLIFT">PENGEMUDI FORKLIFT</option>
                                                        <option value="IT">IT</option>
                                                        {{-- <optgroup label="Optgroup 1">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                    </optgroup> --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Tanggal Dibutuhkan</label>
                                                <div class="row row-cards">
                                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Awal</label>
                                                            <input type="text" class="form-control"
                                                                name="tanggal_buka" value="{{ date('Y-m-d') }}"
                                                                id="datepicker0">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Akhir</label>
                                                            <input type="text" class="form-control"
                                                                name="tanggal_tutup" value="{{ date('Y-m-d') }}"
                                                                id="datepicker1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label required">Deskripsi</label>
                                                <div class="border-success shadow rounded">
                                                    <textarea id="formLowongan1" name="deskripsi"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Persyaratan</label>
                                                <div class="border-success shadow rounded">
                                                    <textarea id="formLowongan2" name="persyaratan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" id="submitLoker" class="btn btn-primary ms-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-device-floppy" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
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
            <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Wawancara</h2>
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
                                    id="datepicker0" value="<?= date('Y-01-01') ?>" />
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
                                    id="datepicker1" value="<?= date('Y-12-31') ?>" />
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
    <script type="text/javascript">
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

        $(function() {
            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Create Data
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/
            $('.datatable-karyawan').on('init.dt', function() {
                $('.checkall').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Tooltip on top');
                $('.w_filter').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Advance Filter');
                $('.w_excel').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Download Excel dari tabel');
            });
            var tableLoker = $('.datatable-karyawan').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": true,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [25, 35, 40, 50, -1],
                    ['25', '35', '40', '50', 'Tampilkan Semua']
                ],
                "dom": "<'card-header h3' B>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                buttons: [{
                        className: 'btn btn-dark checkall',
                        text: '<i class="fa-regular fa-square-check"></i>',
                    },
                    {
                        text: '<i class="fa-solid fa-filter" style="margin-right:5px"></i>',
                        className: 'btn btn-blue w_filter',
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
                        className: 'btn btn-success w_excel',
                        text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i>',
                        action: newexportaction,
                    },
                ],
                "language": {
                    "lengthMenu": "Menampilkan Karyawan _MENU_",
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
                    // "select": {
                    //     rows: {
                    //         _: "%d kandidat dipilih",
                    //         0: "Pilih item dan tekan tombol Proses data untuk Penerimaan karyawan",
                    //     }
                    // },
                },
                ajax: "{{ route('getLoker.index') }}",
                // columnDefs: [{
                //         'targets': 0,
                //         "orderable": false,
                //         'className': 'select-checkbox',
                //         'checkboxes': {
                //             'selectRow': true
                //         },
                //     }

                // ],
                // select: {
                //     'style': 'multi',
                //     "selector": 'td:not(:last-child)',
                // },
                columns: [{
                        title: 'Opsi',
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Posisi',
                        data: 'posisi',
                        name: 'posisi',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Tgl Buka',
                        data: 'tanggal_buka',
                        name: 'tanggal_buka',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Tgl Tutup',
                        data: 'tanggal_tutup',
                        name: 'tanggal_tutup',
                        className: 'cuspad0 text-center'
                    },
                ],

            });

            $('#viewKaryawan').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                console.log(rowid);
                $(".overlay").fadeIn(300);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: '{{ url('listKaryawan') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: rowid,
                    },
                    success: function(data) {
                        $('.fetched-data-karyawan').html(
                            data); //menampilkan data ke dalam modal
                        // alert(itemTables);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });


            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Create Data
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/
            if ($("#formLoker").length > 0) {
                $("#formLoker").validate({
                    rules: {
                        posisi: {
                            required: true,
                        },
                        tanggal_buka: {
                            required: true,
                        },
                        tanggal_tutup: {
                            required: true,
                        },
                        deskripsi: {
                            required: true,
                        },
                        persyaratan: {
                            required: true,
                        },
                    },
                    messages: {
                        posisi: {
                            required: "Masukkan Posisi Lowongan",
                        },
                        tanggal_buka: {
                            required: "Masukkan Tanggal Buka",
                        },
                        tanggal_tutup: {
                            required: "Masukkan Tanggal Tutup",
                        },
                        deskripsi: {
                            required: "Masukkan Deskripsi",
                        },
                        persyaratan: {
                            required: "Masukkan Persyaratan",
                        },
                    },

                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submitLoker').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitLoker").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storeDataLoker') }}",
                            type: "POST",
                            data: $('#formLoker').serialize(),
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon Menunggu',
                                    html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, menambahkan ke Karir.pintex.co.id</h1>',
                                    showConfirmButton: false,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                })
                            },
                            success: function(response) {
                                console.log('Completed.');
                                $('#submitLoker').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitLoker").attr("disabled", false);
                                tableLoker.ajax.reload();
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
                                document.getElementById("formLoker").reset();
                                var sp = $('#selectEntitas').val();
                                $('#entitas').val(sp);
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                tableLoker.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submitLoker').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitLoker").attr("disabled", false);
                            }
                        });
                    }
                })
            }
        });

        $('#formLowongan1').richText({

            // text formatting
            bold: true,
            italic: true,
            underline: true,

            // text alignment
            leftAlign: true,
            centerAlign: true,
            rightAlign: true,
            justify: true,

            // lists
            ol: true,
            ul: true,

            // title
            heading: true,

            // fonts
            fonts: true,
            fontList: ["Arial",
                "Arial Black",
                "Comic Sans MS",
                "Courier New",
                "Geneva",
                "Georgia",
                "Helvetica",
                "Impact",
                "Lucida Console",
                "Tahoma",
                "Times New Roman",
                "Verdana"
            ],
            fontColor: true,
            backgroundColor: false,
            fontSize: true,

            // uploads
            imageUpload: false,
            fileUpload: false,


            // link
            urls: false,

            // tables
            table: true,

            // code
            removeStyles: false,
            code: false,

            // colors
            colors: [],

            // dropdowns
            fileHTML: '',
            imageHTML: '',

            // translations
            translations: {
                'title': 'Title',
                'white': 'White',
                'black': 'Black',
                'brown': 'Brown',
                'beige': 'Beige',
                'darkBlue': 'Dark Blue',
                'blue': 'Blue',
                'lightBlue': 'Light Blue',
                'darkRed': 'Dark Red',
                'red': 'Red',
                'darkGreen': 'Dark Green',
                'green': 'Green',
                'purple': 'Purple',
                'darkTurquois': 'Dark Turquois',
                'turquois': 'Turquois',
                'darkOrange': 'Dark Orange',
                'orange': 'Orange',
                'yellow': 'Yellow',
                'imageURL': 'Image URL',
                'fileURL': 'File URL',
                'linkText': 'Link text',
                'url': 'URL',
                'size': 'Size',
                'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
                'text': 'Text',
                'openIn': 'Open in',
                'sameTab': 'Same tab',
                'newTab': 'New tab',
                'align': 'Align',
                'left': 'Left',
                'justify': 'Justify',
                'center': 'Center',
                'right': 'Right',
                'rows': 'Rows',
                'columns': 'Columns',
                'add': 'Add',
                'pleaseEnterURL': 'Please enter an URL',
                'videoURLnotSupported': 'Video URL not supported',
                'pleaseSelectImage': 'Please select an image',
                'pleaseSelectFile': 'Please select a file',
                'bold': 'Bold',
                'italic': 'Italic',
                'underline': 'Underline',
                'alignLeft': 'Align left',
                'alignCenter': 'Align centered',
                'alignRight': 'Align right',
                'addOrderedList': 'Ordered list',
                'addUnorderedList': 'Unordered list',
                'addHeading': 'Heading/title',
                'addFont': 'Font',
                'addFontColor': 'Font color',
                'addBackgroundColor': 'Background color',
                'addFontSize': 'Font size',
                'addImage': 'Add image',
                'addVideo': 'Add video',
                'addFile': 'Add file',
                'addURL': 'Add URL',
                'addTable': 'Add table',
                'removeStyles': 'Remove styles',
                'code': 'Show HTML code',
                'undo': 'Undo',
                'redo': 'Redo',
                'save': 'Save',
                'close': 'Close'
            },

            // privacy
            youtubeCookies: false,

            // preview
            preview: false,

            // placeholder
            placeholder: '',

            // dev settings
            useSingleQuotes: false,
            height: 150,
            heightPercentage: 0,
            adaptiveHeight: false,
            id: "",
            class: "",
            useParagraph: false,
            maxlength: 0,
            maxlengthIncludeHTML: false,
            callback: undefined,
            useTabForNext: false,
            save: false,
            saveCallback: undefined,
            saveOnBlur: 0,
            undoRedo: true

        });
        $('#formLowongan2').richText({

            // text formatting
            bold: true,
            italic: true,
            underline: true,

            // text alignment
            leftAlign: true,
            centerAlign: true,
            rightAlign: true,
            justify: true,

            // lists
            ol: true,
            ul: true,

            // title
            heading: true,

            // fonts
            fonts: true,
            fontList: ["Arial",
                "Arial Black",
                "Comic Sans MS",
                "Courier New",
                "Geneva",
                "Georgia",
                "Helvetica",
                "Impact",
                "Lucida Console",
                "Tahoma",
                "Times New Roman",
                "Verdana"
            ],
            fontColor: true,
            backgroundColor: false,
            fontSize: true,

            // uploads
            imageUpload: false,
            fileUpload: false,


            // link
            urls: false,

            // tables
            table: true,

            // code
            removeStyles: false,
            code: false,

            // colors
            colors: [],

            // dropdowns
            fileHTML: '',
            imageHTML: '',

            // translations
            translations: {
                'title': 'Title',
                'white': 'White',
                'black': 'Black',
                'brown': 'Brown',
                'beige': 'Beige',
                'darkBlue': 'Dark Blue',
                'blue': 'Blue',
                'lightBlue': 'Light Blue',
                'darkRed': 'Dark Red',
                'red': 'Red',
                'darkGreen': 'Dark Green',
                'green': 'Green',
                'purple': 'Purple',
                'darkTurquois': 'Dark Turquois',
                'turquois': 'Turquois',
                'darkOrange': 'Dark Orange',
                'orange': 'Orange',
                'yellow': 'Yellow',
                'imageURL': 'Image URL',
                'fileURL': 'File URL',
                'linkText': 'Link text',
                'url': 'URL',
                'size': 'Size',
                'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
                'text': 'Text',
                'openIn': 'Open in',
                'sameTab': 'Same tab',
                'newTab': 'New tab',
                'align': 'Align',
                'left': 'Left',
                'justify': 'Justify',
                'center': 'Center',
                'right': 'Right',
                'rows': 'Rows',
                'columns': 'Columns',
                'add': 'Add',
                'pleaseEnterURL': 'Please enter an URL',
                'videoURLnotSupported': 'Video URL not supported',
                'pleaseSelectImage': 'Please select an image',
                'pleaseSelectFile': 'Please select a file',
                'bold': 'Bold',
                'italic': 'Italic',
                'underline': 'Underline',
                'alignLeft': 'Align left',
                'alignCenter': 'Align centered',
                'alignRight': 'Align right',
                'addOrderedList': 'Ordered list',
                'addUnorderedList': 'Unordered list',
                'addHeading': 'Heading/title',
                'addFont': 'Font',
                'addFontColor': 'Font color',
                'addBackgroundColor': 'Background color',
                'addFontSize': 'Font size',
                'addImage': 'Add image',
                'addVideo': 'Add video',
                'addFile': 'Add file',
                'addURL': 'Add URL',
                'addTable': 'Add table',
                'removeStyles': 'Remove styles',
                'code': 'Show HTML code',
                'undo': 'Undo',
                'redo': 'Redo',
                'save': 'Save',
                'close': 'Close'
            },

            // privacy
            youtubeCookies: false,

            // preview
            preview: false,

            // placeholder
            placeholder: '',

            // dev settings
            useSingleQuotes: false,
            height: 150,
            heightPercentage: 0,
            adaptiveHeight: false,
            id: "",
            class: "",
            useParagraph: false,
            maxlength: 0,
            maxlengthIncludeHTML: false,
            callback: undefined,
            useTabForNext: false,
            save: false,
            saveCallback: undefined,
            saveOnBlur: 0,
            undoRedo: true

        });
    </script>
@endsection
