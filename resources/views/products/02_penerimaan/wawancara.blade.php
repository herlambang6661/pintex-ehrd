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

        .overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                    class="icon icon-tabler icon-tabler-heart-handshake" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                    <path
                                        d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
                                    <path d="M12.5 15.5l2 2" />
                                    <path d="M15 13l2 2" />
                                </svg>
                                Wawancara
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i>
                                            Penerimaan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-regular fa-handshake"></i> Wawancara</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        {{-- <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-lamaran" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <i class="fa-solid fa-user-plus"></i>
                                        Tambah Lamaran
                                    </a>
                                    <a href="#" class="btn btn-green d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#importExcel" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <i class="fa-regular fa-file-excel"></i>
                                        Upload Excel
                                    </a>
                                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-lamaran" aria-label="Tambah Lamaran">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                    <a href="#" class="btn btn-green d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-upload" aria-label="Upload Excel">
                                        <i class="fa-regular fa-file-excel"></i>
                                    </a>
                                </div>
                            </div> --}}
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card card-xl border-success shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-success">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                    class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-wawancara"
                                    id="tblamaran">
                                    <thead>
                                        <tr class="text-center">
                                            <th></th>
                                            <th>Opsi</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Gender</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Umur</th>
                                            <th>Pendidikan</th>
                                            <th>Jurusan</th>
                                            <th>Tinggi</th>
                                            <th>Berat</th>
                                            <th>No Telp</th>
                                            <th>Email</th>
                                            <th>Posisi Dituju</th>
                                            <th>Ket</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th class="px-1 py-1 text-center"> </th>
                                        <th class="px-1 py-1 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                        </th>
                                        <th class="px-1 th py-1">NIK</th>
                                        <th class="px-1 th py-1">Nama</th>
                                        <th class="px-1 th py-1">Gender</th>
                                        <th class="px-1 th py-1">Tempat, Tanggal Lahir</th>
                                        <th class="px-1 th py-1">Umur</th>
                                        <th class="px-1 th py-1">Pendidikan</th>
                                        <th class="px-1 th py-1">Jurusan</th>
                                        <th class="px-1 th py-1">Tinggi</th>
                                        <th class="px-1 th py-1">Berat</th>
                                        <th class="px-1 th py-1">No Telp</th>
                                        <th class="px-1 th py-1">Email</th>
                                        <th class="px-1 th py-1">Posisi Dituju</th>
                                        <th class="px-1 th py-1">Ket</th>
                                        <th class="px-1 th py-1">Status</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('shared.footer')
        </div>
    </div>
    {{-- Modal Check --}}
    <div class="modal modal-blur fade" id="myModalProses" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form id="formCheckWawancara" name="formCheckWawancara" method="post" action="javascript:void(0)"
                    onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-user-check" style="margin-right: 5px"></i> Proses
                            Kandidat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-wawancara-proses"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitCheck" class="btn btn-green"><i class="fas fa-save"
                                style="margin-right: 5px"></i> Proses</button>
                        <button type="button" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal"><i
                                class="fa-solid fa-fw fa-arrow-rotate-left"></i> Batal</button>
                    </div>
                </form>
            </div>
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
                                    id="datepicker1" value="<?= date('Y-01-01') ?>" />
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
                                    id="datepicker2" value="<?= date('Y-12-31') ?>" />
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

        $(document).on('click', '.printButton', function(e) {
            e.preventDefault();

            var noform = $(this).data('noform');

            if (noform) {
                window.open('/penerimaan/printLamaran/' + noform, '_blank');
            } else {
                alert('Noform tidak ditemukan!');
            }

        });

        $(function() {
            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Create Data
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/
            $('.datatable-wawancara').on('init.dt', function() {
                $('.w_filter').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Advance Filter');
                $('.w_excel').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Download Excel dari tabel');
                $('.w_back').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Kembalikan status Lamaran');
                $('.w_check').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Terima Pelamar');
                $('.w_xmark').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Tolak Pelamar');
            });
            var tableWawancara = $('.datatable-wawancara').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": true,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
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
                    // {
                    //     text: '<i class="fa-solid fa-arrow-rotate-left"></i>',
                    //     className: 'btn btn-warning w_back',
                    //     attr: {
                    //         'href': '#offcanvasEnd-lamaran',
                    //         'data-bs-toggle': 'offcanvas',
                    //         'role': 'button',
                    //         'aria-controls': 'offcanvasEnd',
                    //     }
                    // },
                    // {
                    //     className: 'btn btn-lime w_check',
                    //     text: '<i class="fa-solid fa-check"></i>',
                    //     action: function(e, node, config) {
                    //         $('#myModalCheck').modal('show')
                    //     }
                    // },
                    // {
                    //     className: 'btn btn-red w_xmark',
                    //     text: '<i class="fa-solid fa-xmark"></i>',
                    //     action: function(e, node, config) {
                    //         $('#myModalXmark').modal('show')
                    //     }
                    // },
                    {
                        className: 'btn btn-info w_xmark',
                        text: 'Proses',
                        action: function(e, node, config) {
                            $('#myModalProses').modal('show')
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
                    "select": {
                        rows: {
                            _: "%d kandidat dipilih",
                            0: "Pilih item dan tekan tombol Proses data untuk Penerimaan karyawan",
                        }
                    },
                },
                ajax: "{{ route('getWawancara.index') }}",
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
                autoWidth: true,
                columns: [{
                        data: 'select_orders',
                        name: 'select_orders',
                        className: 'cuspad2',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'cuspad0'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'ttl',
                        name: 'ttl',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'umur',
                        name: 'umur',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'pendidikan',
                        name: 'pendidikan',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'tinggi',
                        name: 'tinggi',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'berat',
                        name: 'berat',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'notlp',
                        name: 'notlp',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'posisi',
                        name: 'posisi',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'cuspad0'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'cuspad0'
                    },
                ],
                "initComplete": function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;
                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                }
            });
            $('.datatable-wawancara tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm my-0 border border-dark" placeholder="' +
                    $(this).text() + '" />'
                );
            });

            var selected = new Array();

            $('#myModalProses').on('show.bs.modal', function(e) {
                $(".overlay").fadeIn(300);
                itemTables = [];
                // console.log(count);

                $.each(tableWawancara.rows('.selected').nodes(), function(index, rowId) {
                    var rows_selected = tableWawancara.rows('.selected').data();
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
                    url: '{{ url('prosesWawancara') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: itemTables,
                        jml: itemTables.length,
                    },
                    success: function(data) {
                        $('.fetched-data-wawancara-proses').html(
                            data); //menampilkan data ke dalam modal
                        // alert(itemTables);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });

            if ($("#formCheckWawancara").length > 0) {
                $("#formCheckWawancara").validate({
                    rules: {
                        tglwawancara: {
                            required: true,
                        },
                    },
                    messages: {
                        tglwawancara: {
                            required: "Masukkan Tanggal Wawancara",
                        },
                    },

                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submitCheck').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitCheck").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storeHasilWawancara') }}",
                            type: "POST",
                            data: $('#formCheckWawancara').serialize(),
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon Menunggu',
                                    html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                    showConfirmButton: false,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                })
                            },
                            success: function(response) {
                                console.log('Completed.');
                                $('#submitCheck').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitCheck").attr("disabled", false);
                                tableWawancara.ajax.reload();
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
                                document.getElementById("formCheckProsesLamaran").reset();
                                $('#myModalProses').modal('hide');
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                tableWawancara.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submitCheck').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitCheck").attr("disabled", false);
                            }
                        });
                    }
                })
            }

            $('body').on('click', '.cancelWawancara', function() {
                var contract_id = $(this).data("id");
                var nama = $(this).data("nama");
                var noform = $(this).data("noform");
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    icon: 'warning',
                    title: 'Batalkan Proses Wawancara',
                    text: 'Apakah anda yakin ingin membatalkan ' + nama + ' ?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fa-solid fa-arrow-rotate-left"></i> Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('cancelWawancara') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: contract_id,
                                noform: noform,
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon Menunggu',
                                    html: '<center><lottie-player src="https://lottie.host/54b33864-47d1-4f30-b38c-bc2b9bdc3892/1xkjwmUkku.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menghapus data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                })
                            },
                            success: function(data) {
                                $('.datatable-wawancara').DataTable().ajax.reload();
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
                                    title: "Data Lamaran : " + nama +
                                        " dikembalikan ke lamaran"
                                });
                            },
                            error: function(data) {
                                console.log('Error:', data.responseText);
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

            });
        });
    </script>
@endsection
