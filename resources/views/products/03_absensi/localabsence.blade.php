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

        td.cuspad2 {}

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
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-red" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint-scan">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 11a3 3 0 0 1 6 0c0 1.657 .612 3.082 1 4" />
                                    <path d="M12 11v1.75c-.001 1.11 .661 2.206 1 3.25" />
                                    <path d="M9 14.25c.068 .58 .358 1.186 .5 1.75" />
                                    <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                    <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                    <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                </svg>
                                Kelola Absensi
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('lokal/mesinfinger') }}"><i
                                                class="fas fa-fingerprint"></i> Local</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fas fa-fingerprint"></i> kelola Absensi <i
                                                class="text-red">(Restricted Area)</i></a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <div class="input-group d">
                                    <div class=" d-none d-sm-inline-block">
                                        <div class="input-icon ">
                                            {{-- <input type="date" name="tgl" id="tgl" class="form-control border-blue" value="{{ date('Y-m-d') }}"> --}}
                                            <input class="form-control border-primary tgl" id="datepicker2"
                                                placeholder="Select a date" value="<?= date('Y-m-d') ?>" />
                                            {{-- <input class="form-control border-primary" value="04" /> --}}
                                            <span class="input-icon-addon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
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
                                    <button class="btn btn-blue d-none d-sm-inline-block" id="btnPerbarui">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                        Perbarui I/O
                                    </button>
                                    <button data-bs-toggle="dropdown" type="button"
                                        class="btn btn-blue dropdown-toggle dropdown-toggle-split"
                                        aria-expanded="false"></button>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        {{-- <button class="dropdown-item" id="btnUpload">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-upload">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                                <path d="M9 15l3 -3l3 3" />
                                                <path d="M12 12l0 9" />
                                            </svg>
                                            Upload Cloud
                                        </button> --}}
                                        <button class="dropdown-item" id="btnPerbaruiUpload">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-computing">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M6.657 16c-2.572 0 -4.657 -2.007 -4.657 -4.483c0 -2.475 2.085 -4.482 4.657 -4.482c.393 -1.762 1.794 -3.2 3.675 -3.773c1.88 -.572 3.956 -.193 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99c1.913 0 3.464 1.56 3.464 3.486c0 1.927 -1.551 3.487 -3.465 3.487h-11.878" />
                                                <path d="M12 16v5" />
                                                <path d="M16 16v4a1 1 0 0 0 1 1h4" />
                                                <path d="M8 16v4a1 1 0 0 1 -1 1h-4" />
                                            </svg>
                                            Upload Absensi Cloud
                                        </button>
                                        <button class="dropdown-item" id="btnRefreshAbsensi">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-network">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 20h7" />
                                                <path d="M14 20h7" />
                                                <path d="M10 20a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M12 16v2" />
                                                <path
                                                    d="M8 16.004h-1.343c-2.572 -.004 -4.657 -2.011 -4.657 -4.487c0 -2.475 2.085 -4.482 4.657 -4.482c.393 -1.762 1.794 -3.2 3.675 -3.773c1.88 -.572 3.956 -.193 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99c1.913 0 3.464 1.56 3.464 3.486c0 1.927 -1.551 3.487 -3.465 3.487h-2.535" />
                                            </svg>
                                            Refresh Absensi Cloud
                                        </button>
                                    </div>
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
                        <div class="col-12">
                            <div class="card card-xl shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-dark">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>

                                <table style="width:100%;"
                                    class="display text-center table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-absensi"
                                    id="tbabsensi">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">STB</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Libur</th>
                                            <th class="text-center">Set. Hari</th>
                                            <th class="text-center">In</th>
                                            <th class="text-center">Out</th>
                                            <th class="text-center">QJ</th>
                                            <th class="text-center">JIS</th>
                                            <th class="text-center">QJNET</th>
                                            <th class="text-center">SST</th>
                                            <th class="text-center">Bagian</th>
                                        </tr>
                                    </thead>
                                </table>
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
                                <input class="form-control border-primary dari" placeholder="Select a date"
                                    id="datepicker0" value="<?= date('Y-m-d') ?>" />
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
                                <input class="form-control border-primary sampai" placeholder="Select a date"
                                    id="datepicker1" value="<?= date('Y-m-d') ?>" />
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
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="PRIA"
                                        checked="" id="sSmp">
                                    <span class="form-check-label">Pria</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="WANITA"
                                        checked="" id="sSma">
                                    <span class="form-check-label">Wanita</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-label">Divisi</div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input divisi" value="HRD & GA"
                                        checked="" id="pOperator">
                                    <span class="form-check-label">HRD & GA</span>
                                </label>
                            </div>
                            <div class="col">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input divisi" value="PRODUKSI"
                                        checked="" id="pPengemudi">
                                    <span class="form-check-label">PRODUKSI</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-label">Bagian</div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="AKUNTING & KEUANGAN"
                                        checked="" id="pOperator">
                                    <span class="form-check-label">AKUNTING & KEUANGAN</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="GUDANG" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">GUDANG</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="KEAMANAN"
                                        checked="" id="pPengemudi">
                                    <span class="form-check-label">KEAMANAN</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="PERSONALIA"
                                        checked="" id="pPengemudi">
                                    <span class="form-check-label">PERSONALIA</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="TFI" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">TFI</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="TFO" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">TFO</span>
                                </label>
                            </div>
                            <div class="col">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="TFO 1" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">TFO 1</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="TFO 2" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">TFO 2</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="UMUM" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">UMUM</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="UNIT 1" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">UNIT 1</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="UNIT 2" checked=""
                                        id="pPengemudi">
                                    <span class="form-check-label">UNIT 2</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input bagian" value="WCR & WORKSHOP"
                                        checked="" id="pPengemudi">
                                    <span class="form-check-label">WCR & WORKSHOP</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="button" class="btn btn-primary w-100" onclick="syn()" id="btn-filter">Filter
                            Data</button> <br>
                        <button type="button" class="btn btn-link w-100" id="btn-reset-items">Reset to
                            defaults</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
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
        var tableAbsensi;
        var d = new Date();
        var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
        $(function() {
            var token = $("meta[name='csrf-token']").attr("content");

            tableAbsensi = $('.datatable-absensi').DataTable({
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
                        text: '<i class="fa-solid fa-filter" style="margin-right:5px"></i>',
                        className: 'btn btn-blue',
                        attr: {
                            'href': '#offcanvasEnd-lamaran',
                            'data-bs-toggle': 'offcanvas',
                            'role': 'button',
                            'aria-controls': 'offcanvasEnd',
                        }
                    },
                    {
                        title: 'Data Absen (' + strDate + ')',
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn btn-success',
                        text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i>',
                        //action: newexportaction,
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
                },

                "ajax": {
                    "url": "{{ route('getAbsensiServer.index') }}",
                    "data": function(data) {
                        data._token = "{{ csrf_token() }}";
                        data.dari = $('.dari').val();
                        data.sampai = $('.sampai').val();
                    }
                },

                columns: [{
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'stb',
                        name: 'stb',
                        className: 'cuspad0'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'cuspad0 cuspad1 text-center'
                    },
                    {
                        data: 'hrlibur',
                        name: 'hrlibur',
                        className: 'cuspad0 cuspad1 text-center'
                    },
                    {
                        data: 'sethari',
                        name: 'sethari',
                        className: 'cuspad0 cuspad1 text-center'
                    },
                    {
                        data: 'in',
                        name: 'in',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'out',
                        name: 'out',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'qj',
                        name: 'qj',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'jis',
                        name: 'jis',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'qjnet',
                        name: 'qjnet',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'sst',
                        name: 'sst',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'bagian',
                        name: 'bagian',
                        className: 'cuspad0 text-center'
                    },
                ],
            });

            $('#btnPerbarui').click(function() {
                var token = $("meta[name='csrf-token']").attr("content");
                var tgl = $('.tgl').val();
                Swal.fire({
                    icon: 'question',
                    title: 'Perbarui Data Absen',
                    text: 'Apakah anda yakin ingin Perbarui data absen tanggal ' + tgl + ' ?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: ' Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('syncAbsen') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'tgl': tgl,
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
                                console.log('fetch data: ' + tgl);
                            },
                            success: function(data) {
                                console.log(data);
                                tableAbsensi.ajax.reload();
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
                                    title: "Berhasil Memperbarui data"
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
                                tableAbsensi.ajax.reload();
                            }
                        });
                    }
                });
                // tableAbsensi.ajax.reload(); //just reload table
            });

            $('#btnUpload').click(function() {
                var token = $("meta[name='csrf-token']").attr("content");
                var tgl = $('.tgl').val();

                Swal.fire({
                    icon: 'question',
                    title: 'Upload Data Absen',
                    text: 'Apakah anda yakin ingin Upload data absen tanggal ' + tgl +
                        ' dari Lokal ke Cloud ?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: ' Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('uploadAbsen') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'tgl': tgl,
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
                                console.log('fetch data: ' + tgl);
                            },
                            success: function(data) {
                                console.log(data);
                                tableAbsensi.ajax.reload();
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
                                    title: "Berhasil Upload ke Cloud"
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
                                tableAbsensi.ajax.reload();
                            }
                        });
                    }
                });
            });

            $('#btnPerbaruiUpload').click(function() {
                var token = $("meta[name='csrf-token']").attr("content");
                var tgl = $('.tgl').val();

                Swal.fire({
                    icon: 'question',
                    title: 'Upload Data Absen',
                    text: 'Apakah anda yakin ingin Perbarui & Upload data absen tanggal ' + tgl +
                        ' dari Lokal ke Cloud ? Proses akan membutuhkan waktu yang cukup lama, mohon bersabar.',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: ' Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('perbaruiUploadAbsen') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'tgl': tgl,
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon Menunggu',
                                    html: '<center><lottie-player src="https://lottie.host/f6ad03a7-1560-4082-8f73-eba358540a2a/jwBLWkLRwZ.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang Sinkronisasi data, Proses mungkin membutuhkan beberapa menit. Proses akan membutuhkan waktu yang cukup lama, mohon bersabar.<br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                });
                                console.log('fetch data: ' + tgl);
                            },
                            success: function(data) {
                                console.log(data);
                                tableAbsensi.ajax.reload();
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
                                    title: "Berhasil Perbarui & Upload ke Cloud"
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
                                tableAbsensi.ajax.reload();
                            }
                        });
                    }
                });
            });

            $('#btnRefreshAbsensi').click(function() {
                var token = $("meta[name='csrf-token']").attr("content");
                var tgl = $('.tgl').val();
                Swal.fire({
                    icon: 'question',
                    title: 'Perbarui Data Absen Cloud',
                    text: 'Apakah anda yakin ingin Perbarui data absen Cloud tanggal ' + tgl +
                        ' ? Proses akan membutuhkan waktu yang cukup lama, mohon bersabar.',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: ' Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('refreshUploadAbsen') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'tgl': tgl,
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon Menunggu',
                                    html: '<center><lottie-player src="https://lottie.host/f6ad03a7-1560-4082-8f73-eba358540a2a/jwBLWkLRwZ.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang Sinkronisasi data, Proses mungkin membutuhkan beberapa menit. Proses akan membutuhkan waktu yang cukup lama, mohon bersabar.<br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                });
                                console.log('fetch data: ' + tgl);
                            },
                            success: function(data) {
                                console.log(data);
                                tableAbsensi.ajax.reload();
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
                                    title: "Berhasil Perbarui & Upload ke Cloud"
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
                                tableAbsensi.ajax.reload();
                            }
                        });
                    }
                });
            });

        });

        function syn() {
            tableAbsensi.ajax.reload();
        }
    </script>
@endsection
