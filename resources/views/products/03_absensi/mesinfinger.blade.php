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
                                    <svg  xmlns="http://www.w3.org/2000/svg"  class="text-red" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint-scan"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 0 1 6 0c0 1.657 .612 3.082 1 4" /><path d="M12 11v1.75c-.001 1.11 .661 2.206 1 3.25" /><path d="M9 14.25c.068 .58 .358 1.186 .5 1.75" /><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /></svg>
                                    Mesin Fingerprint
                                    <div id="entitasText" style="margin-left: 5px;">Loading... <i class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                                </h2>
                                <div class="page-pretitle">
                                    <ol class="breadcrumb" aria-label="breadcrumbs">
                                        <li class="breadcrumb-item"><a href="{{ url('dashboard'); }}"><i class="fa fa-home"></i> Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a href="#" class="text-red"><i class="fas fa-fingerprint"></i> Mesin Fingerprint (Restricted Area)</a></li>
                                    </ol>
                                </div>
                            </div>
                            
                            <!-- Page title actions -->
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <div class=" d-none d-sm-inline-block">
                                        <input type="date" name="" id="" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class=" d-none d-sm-inline-block">
                                        <input type="date" name="" id="" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <a href="{{ url('absensi/fingerprint') }}" class="btn btn-primary d-none d-sm-inline-block">
                                        <i class="fa-solid fa-fingerprint"></i>
                                        Perbarui
                                    </a>
                                    <a href="{{ url('absensi/absensi') }}" class="btn btn-secondary d-none d-sm-inline-block">
                                        <i class="fa-solid fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                    <a href="#" class="btn btn-danger d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-lamaran" aria-label="Tambah Lamaran">
                                        <i class="fa-solid fa-person-running"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-upload" aria-label="Upload Excel">
                                        <i class="fa-solid fa-user-slash"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-upload" aria-label="Upload Excel">
                                        <i class="fa-solid fa-fingerprint"></i>
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
                            <div class="col-12">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
    
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>USERID</th>
                                                <th>NAME</th>
                                                <th>BADGENUMBER</th>
                                                <th>SSN</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($playlist as $dt)
                                                <tr>
                                                    <td>{{ $dt->USERID }}</td>
                                                    <td>{{ $dt->Name }}</td>
                                                    <td>{{ $dt->Badgenumber }}</td>
                                                    <td>{{ $dt->SSN }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
        <div class="offcanvas offcanvas-blur offcanvas-end" tabindex="-1" id="offcanvasEnd-lamaran" aria-labelledby="offcanvasEndLabel">
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
                    <form action="#" id="form-filter-items" method="get" autocomplete="off" novalidate="" class="sticky-top">
                        <div class="form-label">Tanggal Penginputan</div>
                        <div class="row">
                            <div class="col">
                                <div class="input-icon mb-2">
                                    <input name="dari" class="form-control border-primary" placeholder="Select a date" id="datepicker1" value="<?= date('Y-01-01'); ?>"/>
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-icon mb-2">
                                    <input name="sampai" class="form-control border-primary" placeholder="Select a date" id="datepicker2" value="<?= date('Y-12-31'); ?>"/>
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
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
                                        <input type="checkbox" class="form-check-input filter-checkbox-rayon" name="pendidikan[]" value="IBR" checked="" id="sSmp">
                                        <span class="form-check-label">Pria</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input filter-checkbox-rayon" name="pendidikan[]" value="SPV" checked="" id="sSma">
                                        <span class="form-check-label">Wanita</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-label">Posisi Dituju</div>
                        <div class="mb-4">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="OPERATOR" checked="" id="pOperator">
                                <span class="form-check-label">Operator</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="PENGEMUDI" checked="" id="pPengemudi">
                                <span class="form-check-label">Pengemudi</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="IT" checked="" id="pIT">
                                <span class="form-check-label">IT</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="HRD" checked="" id="pHRD">
                                <span class="form-check-label">HRD</span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="posisidituju[]" value="KEAMANAN" checked="" id="pKeamanan">
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
            

            var tableLamaran = $('.datatable-absensi').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "scrollX": true,
                    "scrollCollapse": true,
                    "pagingType": 'full_numbers',
                    "dom": "<'card-header h3' B>" +
                        "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                        "<'table-responsive' <'col-sm-12'tr> >" +
                        "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                    "lengthMenu": [
                        [25, 35, 40, 50, -1],
                        ['25', '35', '40', '50', 'Tampilkan Semua']
                    ],
                    buttons: [
                        {
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
                            extend: 'excelHtml5',
                            autoFilter: true,
                            className: 'btn btn-success',
                            text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i>',
                            action: newexportaction,
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
                    ajax: "{{ route('getAbsensi.index') }}",
                    
                    columns: [
                        { data: 'tanggal', name: 'tanggal', className: 'cuspad0 text-center' },
                        { data: 'stb', name: 'stb', className: 'cuspad0' },
                        { data: 'name', name: 'name', className: 'cuspad0 cuspad1 text-center' },
                        { data: 'hrlibur', name: 'hrlibur', className: 'cuspad0 cuspad1 text-center' },
                        { data: 'sethari', name: 'sethari', className: 'cuspad0 cuspad1 text-center' },
                        { data: 'in', name: 'in', className: 'cuspad0 text-center' },
                        { data: 'out', name: 'out', className: 'cuspad0 text-center' },
                        { data: 'qj', name: 'qj', className: 'cuspad0 text-center' },
                        { data: 'jis', name: 'jis', className: 'cuspad0 text-center' },
                        { data: 'qj', name: 'qj', className: 'cuspad0 text-center' },
                        { data: 'sst', name: 'sst', className: 'cuspad0 text-center' },
                        { data: 'name', name: 'name', className: 'cuspad0' },
                    ],
                });

        </script>
@endsection
