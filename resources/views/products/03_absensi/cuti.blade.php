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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:10px" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-beach">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M17.553 16.75a7.5 7.5 0 0 0 -10.606 0" />
                                    <path d="M18 3.804a6 6 0 0 0 -8.196 2.196l10.392 6a6 6 0 0 0 -2.196 -8.196z" />
                                    <path
                                        d="M16.732 10c1.658 -2.87 2.225 -5.644 1.268 -6.196c-.957 -.552 -3.075 1.326 -4.732 4.196" />
                                    <path d="M15 9l-3 5.196" />
                                    <path
                                        d="M3 19.25a2.4 2.4 0 0 1 1 -.25a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 1 .25" />
                                </svg>
                                Aktifitas Cuti
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
                                                class="fa-solid fa-umbrella-beach"></i> Aktifitas Cuti</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        {{-- <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-danger d-none d-sm-inline-block" onclick="alpha();">
                                    <i class="fa-solid fa-person-running"></i>
                                    Data Alfa
                                </a>
                                <a href="#" class="btn btn-warning d-none d-sm-inline-block" onclick="f1();">
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
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="card card-xl shadow rounded">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                    class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-cuti"
                                    id="tbkaryawan">
                                </table>
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
                        <div class="form-label">Bagian</div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <select name="bagian" id="bagian" class="form-select">
                                        <option value="ALL">SEMUA</option>
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
                        <div class="form-label">Gender</div>
                        <div class="mb-4">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="gender[]" value="PRIA"
                                    checked="" id="gPria">
                                <span class="form-check-label">Pria</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="gender[]" value="WANITA"
                                    checked="" id="gWanita">
                                <span class="form-check-label">Wanita</span>
                            </label>
                        </div>
                        <div class="form-label">Status</div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Semua">Semua</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non Aktif">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
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
                /*------------------------------------------
                --------------------------------------------
                Render DataTable
                --------------------------------------------
                --------------------------------------------*/
                var tableWawancara = $('.datatable-cuti').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
                    "scrollX": true,
                    "scrollCollapse": false,
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
                    },
                    ajax: "{{ route('getCuti.index') }}",
                    columns: [{
                            title: 'Opsi',
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Nama',
                            data: 'nama',
                            name: 'nama',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Unit',
                            data: 'bagian',
                            name: 'bagian',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Tgl Awal',
                            data: 'tglaw',
                            name: 'tglaw',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Tgl Akhir',
                            data: 'tglak',
                            name: 'tglak',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Cuti Awal',
                            data: 'sacuti',
                            name: 'sacuti',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Cuti Terpakai',
                            data: 'cutiTerpakai',
                            name: 'cutiTerpakai',
                            className: 'cuspad0 text-center'
                        },
                    ],

                });
            });

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
        </script>
    @endsection