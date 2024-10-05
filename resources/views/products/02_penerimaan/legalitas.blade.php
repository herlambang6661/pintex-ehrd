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
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                                    <path d="M10 16h6" />
                                    <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M4 8h3" />
                                    <path d="M4 12h3" />
                                    <path d="M4 16h3" />
                                </svg>
                                Legalitas
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
                                                class="fa-solid fa-file-signature"></i> Legalitas</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <ul class="nav">
                                    <a href="#tabs-ol" class="nav-link btn bg-dark text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab" style="margin-right: 5px"
                                        aria-label="Orientasi Lapangan">
                                        <i class="fa-solid fa-person-chalkboard"></i>
                                        OL
                                    </a>
                                    <a href="#tabs-phl" class="nav-link btn bg-blue text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab" style="margin-right: 5px">
                                        <i class="fa-solid fa-people-arrows"></i>
                                        PHL
                                    </a>
                                    <a href="#tabs-karyawan"
                                        class="active nav-link btn bg-green text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab">
                                        <i class="fa-solid fa-users-viewfinder"></i>
                                        Karyawan
                                    </a>
                                    <a href="#tabs-ol" class="btn btn-secondary d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="Orientasi Lapangan"
                                        style="margin-right: 3px">
                                        <i class="fa-solid fa-person-chalkboard"></i>
                                    </a>
                                    <a href="#tabs-phl" class="btn btn-info d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="PHL" style="margin-right: 3px">
                                        <i class="fa-solid fa-people-arrows"></i>
                                    </a>
                                    <a href="#tabs-karyawan" class="btn btn-blue d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="Karyawan">
                                        <i class="fa-solid fa-users-viewfinder"></i>
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
                            {{-- Tab Karyawan --}}
                            <div class="tab-pane fade active show" id="tabs-karyawan" role="tabpanel">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-karyawan"
                                        id="tblamaran">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Opsi</th>
                                                <th>Masuk</th>
                                                <th>STB</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>No Map</th>
                                                <th>Bagian</th>
                                                <th>Grup</th>
                                                <th>Profesi</th>
                                                <th>Pendidikan</th>
                                                <th>Jurusan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <th class="px-1 py-1 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                            </th>
                                            <th class="px-1 th py-1">Masuk</th>
                                            <th class="px-1 th py-1">STB</th>
                                            <th class="px-1 th py-1">NIK</th>
                                            <th class="px-1 th py-1">Nama</th>
                                            <th class="px-1 th py-1">Gender</th>
                                            <th class="px-1 th py-1">Email</th>
                                            <th class="px-1 th py-1">Status</th>
                                            <th class="px-1 th py-1">No Map</th>
                                            <th class="px-1 th py-1">Bagian</th>
                                            <th class="px-1 th py-1">Grup</th>
                                            <th class="px-1 th py-1">Profesi</th>
                                            <th class="px-1 th py-1">Pendidikan</th>
                                            <th class="px-1 th py-1">Jurusan</th>
                                            <th class="px-1 th py-1">Status</th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            {{-- Tab Orientasi Lapangan --}}
                            <div class="tab-pane fade" id="tabs-ol" role="tabpanel">
                                <div class="card card-xl border-dark shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-dark">
                                            <i class="fa-solid fa-person-chalkboard"></i>
                                        </div>
                                    </div>
                                    <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-ol"
                                        id="tbol">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Opsi</th>
                                                <th>Masuk</th>
                                                <th>STB</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>No Map</th>
                                                <th>Bagian</th>
                                                <th>Grup</th>
                                                <th>Profesi</th>
                                                <th>Pendidikan</th>
                                                <th>Jurusan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <th class="px-1 py-1 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                            </th>
                                            <th class="px-1 th py-1">Masuk</th>
                                            <th class="px-1 th py-1">STB</th>
                                            <th class="px-1 th py-1">NIK</th>
                                            <th class="px-1 th py-1">Nama</th>
                                            <th class="px-1 th py-1">Gender</th>
                                            <th class="px-1 th py-1">Email</th>
                                            <th class="px-1 th py-1">Status</th>
                                            <th class="px-1 th py-1">No Map</th>
                                            <th class="px-1 th py-1">Bagian</th>
                                            <th class="px-1 th py-1">Grup</th>
                                            <th class="px-1 th py-1">Profesi</th>
                                            <th class="px-1 th py-1">Pendidikan</th>
                                            <th class="px-1 th py-1">Jurusan</th>
                                            <th class="px-1 th py-1">Status</th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            {{-- Tab Pekerja Harian Lepas --}}
                            <div class="tab-pane fade" id="tabs-phl" role="tabpanel">
                                <div class="card card-xl border-blue shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-blue">
                                            <i class="fa-solid fa-people-arrows"></i>
                                        </div>
                                    </div>
                                    <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-phl"
                                        id="tblamaran">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Opsi</th>
                                                <th>Masuk</th>
                                                <th>STB</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>No Map</th>
                                                <th>Bagian</th>
                                                <th>Grup</th>
                                                <th>Profesi</th>
                                                <th>Pendidikan</th>
                                                <th>Jurusan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <th class="px-1 py-1 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                            </th>
                                            <th class="px-1 th py-1">Masuk</th>
                                            <th class="px-1 th py-1">STB</th>
                                            <th class="px-1 th py-1">NIK</th>
                                            <th class="px-1 th py-1">Nama</th>
                                            <th class="px-1 th py-1">Gender</th>
                                            <th class="px-1 th py-1">Email</th>
                                            <th class="px-1 th py-1">Status</th>
                                            <th class="px-1 th py-1">No Map</th>
                                            <th class="px-1 th py-1">Bagian</th>
                                            <th class="px-1 th py-1">Grup</th>
                                            <th class="px-1 th py-1">Profesi</th>
                                            <th class="px-1 th py-1">Pendidikan</th>
                                            <th class="px-1 th py-1"Jurusan</th>
                                            <th class="px-1 th py-1">Status</th>
                                        </tfoot>
                                    </table>
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
    <div class="offcanvas offcanvas-blur offcanvas-end" tabindex="-1" id="offcanvasEnd-karyawan"
        aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Legalitas</h2>
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
                                    @foreach ($bagian as $b)
                                        <option value="{{ $b->desc }}">{{ $b->desc }}</option>
                                    @endforeach
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
                                    @foreach ($shift as $s)
                                        <option value="{{ $s->desc }}">{{ $s->desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-label">Grup</div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <select name="fgrup" id="fgrup" class="form-select border-primary">
                                    <option value="*">Semua</option>
                                    @foreach ($grup as $g)
                                        <option value="{{ $g->desc }}">{{ $g->desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="button" class="btn btn-primary w-100" onclick="syn();" id="btn-filter">Filter
                            Data</button> <br>
                        <input type="reset" class="btn btn-link w-100" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal View --}}
    <div class="modal modal-blur fade" id="viewKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form id="formCheckWawancara" name="formCheckWawancara" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-user" style="margin-right: 5px"></i> Detail
                            Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-karyawan"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitCheck" class="btn btn-green"><i class="fas fa-save"
                                style="margin-right: 5px"></i> Proses</button>
                        <button type="button" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal"><i
                                class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</button>
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

        var tableWawancara, tableOl, tablePhl;

        function syn() {
            tableWawancara.ajax.reload();
            tableOl.ajax.reload();
            tablePhl.ajax.reload();
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
            tableWawancara = $('.datatable-karyawan').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
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
                        className: 'btn btn-outline-blue',
                        text: '<i class="fa-solid fa-envelope-open-text"></i> Mass Input',
                        action: function(e, dt, button, config) {
                            window.location = 'massUpload';
                        }
                    },
                    {
                        text: '<i class="fa-solid fa-filter" style="margin-right:5px"></i>',
                        className: 'btn btn-blue w_filter',
                        attr: {
                            'href': '#offcanvasEnd-karyawan',
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
                "ajax": {
                    "url": "{{ route('getLegalitasKaryawan.index') }}",
                    "data": function(data) {
                        data._token = "{{ csrf_token() }}";
                        data.dari = $('.dari').val();
                        data.sampai = $('.sampai').val();
                        data.status = $('#fstatus').val();
                        data.bagian = $('#fbagian').val();
                        data.grup = $('#fgrup').val();
                        data.shift = $('#fshift').val();
                    }
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'ttl',
                        name: 'ttl',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'stb',
                        name: 'stb',
                        className: 'cuspad0'
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        visible: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nomap',
                        name: 'nomap',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'bagian',
                        name: 'bagian',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'grup',
                        name: 'grup',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'profesi',
                        name: 'profesi',
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
            $('.datatable-karyawan tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm my-0 border border-dark" placeholder="' +
                    $(this).text() + '" />'
                );
            });

            tableOl = $('.datatable-ol').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [25, 35, 40, 50, -1],
                    ['25', '35', '40', '50', 'Tampilkan Semua']
                ],
                ajax: "{{ route('getLegalitasKaryawanOl.index') }}",
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
                            'href': '#offcanvasEnd-ol',
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
                    "lengthMenu": "Menampilkan OL _MENU_",
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
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'ttl',
                        name: 'ttl',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'stb',
                        name: 'stb',
                        className: 'cuspad0'
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        visible: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nomap',
                        name: 'nomap',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'bagian',
                        name: 'bagian',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'grup',
                        name: 'grup',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'profesi',
                        name: 'profesi',
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
            $('.datatable-ol tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm my-0 border border-dark" placeholder="' +
                    $(this).text() + '" />'
                );
            });

            tablePhl = $('.datatable-phl').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [25, 35, 40, 50, -1],
                    ['25', '35', '40', '50', 'Tampilkan Semua']
                ],
                ajax: "{{ route('getLegalitasKaryawanPhl.index') }}",
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
                            'href': '#offcanvasEnd-phl',
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
                    "lengthMenu": "Menampilkan PHL _MENU_",
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
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'ttl',
                        name: 'ttl',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'stb',
                        name: 'stb',
                        className: 'cuspad0'
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        visible: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'nomap',
                        name: 'nomap',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'bagian',
                        name: 'bagian',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'grup',
                        name: 'grup',
                        className: 'cuspad0 text-center'
                    },
                    {
                        data: 'profesi',
                        name: 'profesi',
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
            $('.datatable-phl tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm my-0 border border-dark" placeholder="' +
                    $(this).text() + '" />'
                );
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
                            url: "{{ url('storeChecklistWawancara') }}",
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
                                document.getElementById("formCheckWawancara").reset();
                                $('#myModalCheck').modal('hide');
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
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

            if ($("#formCheckWawancaraX").length > 0) {
                $("#formCheckWawancaraX").validate({
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
                        $('#submitCheckXmark').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitCheckXmark").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storeChecklistWawancara') }}",
                            type: "POST",
                            data: $('#formCheckWawancaraX').serialize(),
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
                                $('#submitCheckXmark').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitCheckXmark").attr("disabled", false);
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
                                document.getElementById("formCheckWawancaraX").reset();
                                $('#myModalXmark').modal('hide');
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                tableWawancara.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submitCheckXmark').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitCheckXmark").attr("disabled", false);
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
                                $('.datatable-karyawan').DataTable().ajax.reload();
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
