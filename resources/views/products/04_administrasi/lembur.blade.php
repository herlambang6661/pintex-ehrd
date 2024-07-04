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
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clock-24">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12a9 9 0 0 0 5.998 8.485m12.002 -8.485a9 9 0 1 0 -18 0" />
                                    <path d="M12 7v5" />
                                    <path d="M12 15h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 0 -1 1v1a1 1 0 0 0 1 1h2" />
                                    <path d="M18 15v2a1 1 0 0 0 1 1h1" />
                                    <path d="M21 15v6" />
                                </svg>
                                Lemburan
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-user-clock"></i> Lemburan
                                        </a>
                                    </li>
                                </ol>
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
                                    <div class="setStatus"></div>
                                    <div class="table-responsive">
                                        <table style="width:100%; font-size:13px"
                                            class="display table table-sm  table-bordered table-hover text-nowrap datatable-lembur"
                                            id="tbabsensi">
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
        <div class="offcanvas offcanvas-blur offcanvas-end" tabindex="-1" id="offcanvasEnd-lamaran"
            aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Payroll</h2>
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
                                        <input type="checkbox" class="form-check-input bagian"
                                            value="AKUNTING & KEUANGAN" checked="" id="pOperator">
                                        <span class="form-check-label">AKUNTING & KEUANGAN</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input bagian" value="GUDANG"
                                            checked="" id="pPengemudi">
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
                                        <input type="checkbox" class="form-check-input bagian" value="TFI"
                                            checked="" id="pPengemudi">
                                        <span class="form-check-label">TFI</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input bagian" value="TFO"
                                            checked="" id="pPengemudi">
                                        <span class="form-check-label">TFO</span>
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input bagian" value="TFO 1"
                                            checked="" id="pPengemudi">
                                        <span class="form-check-label">TFO 1</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input bagian" value="TFO 2"
                                            checked="" id="pPengemudi">
                                        <span class="form-check-label">TFO 2</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input bagian" value="UMUM"
                                            checked="" id="pPengemudi">
                                        <span class="form-check-label">UMUM</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input bagian" value="UNIT 1"
                                            checked="" id="pPengemudi">
                                        <span class="form-check-label">UNIT 1</span>
                                    </label>
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input bagian" value="UNIT 2"
                                            checked="" id="pPengemudi">
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
        {{-- Modal Tambah Lembur --}}
        <div class="modal modal-blur fade" id="modal-tambah-lembur" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="overlay">
                <div class="loader">
                    <span class="spinner spinner1"></span>
                    <span class="spinner spinner2"></span>
                    <span class="spinner spinner3"></span>
                    <br>
                    <span class="loader-text">MEMUAT DATA</span>
                </div>
            </div>
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form id="formTambahLembur" name="formTambahLembur" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa-solid fa-user" style="margin-right: 5px"></i>
                                Tambah Lembur
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cards">
                                <div class="mb-0 col-lg-4">
                                    <label class="form-label">Tanggal Input</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="mb-0 col-lg-4">
                                    <label class="form-label">Diperintah Oleh</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama">
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label">Diketahui Oleh</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama">
                                </div>
                            </div>

                            <a href="#" class="btn btn-success shadow rounded" onclick="tambahItem();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                </svg>
                                Tambah Karyawan
                            </a>
                            <input id="idf" value="1" type="hidden" />
                        </div>
                        <div class="cards">
                            <table id="table-tambah-lembur" class="table table-vcenter table-sm table-hover card-table"
                                onkeydown="return event.key != 'Enter';">
                                <thead>
                                    <tr>
                                        <td class="text-center" style="width: 10px"></td>
                                        <td class="text-center">STB</td>
                                        <td class="text-center">Nama</td>
                                        <td class="text-center">Masuk</td>
                                        <td class="text-center">Pulang</td>
                                        <td class="text-center">Total</td>
                                        <td class="text-center">Keterangan</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cards">
                                <div class="col-md-12">
                                    <div class="mb-3 mb-0">
                                        <label class="form-label">Keterangan</label>
                                        <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submitLembur" class="btn btn-blue shadow rounded">
                                <i class="fas fa-save" style="margin-right: 5px"></i> Simpan
                            </button>
                            <button type="button" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal">
                                <i class="fa-solid fa-fw fa-arrow-rotate-left"></i>
                                Kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
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


            function tambahItem() {
                var idf = document.getElementById("idf").value;
                var detail_transaksi = document.getElementById("table-tambah-lembur");
                var tr = document.createElement("tr");
                tr.setAttribute("id", "btn-remove-item" + idf);
                // Kolom 1 Hapus
                var td = document.createElement("td");
                td.setAttribute("align", "center");
                td.innerHTML +=
                    '<a href="javascript:void(0)" class="btn btn-red btn-icon bg-red btn-sm" onclick="hapusElemen(' +
                    idf +
                    ');"><i class="fas fa-trash-can"></i> </a>';
                tr.appendChild(td);
                // Kolom 2 STB
                var td = document.createElement("td");
                td.setAttribute("style", "width:100px");
                td.innerHTML += '<input type="text" name="stb[]" id="stb' + idf +
                    '" class="form-control text-center" onchange="fetchKar(' +
                    idf + ', `H`)" onkeydown = "if (event.keyCode == 13)  fetchKar(' + idf + ', `H`)">';
                tr.appendChild(td);
                // Kolom 3 NAMA
                var td = document.createElement("td");
                td.setAttribute("style", "width:100px");
                td.innerHTML += '<input type="text" name="nama[]" id="nama' + idf +
                    '" class="form-control">';
                tr.appendChild(td);
                // Kolom 4 MASUK
                var td = document.createElement("td");
                td.setAttribute("style", "width:50px");
                td.innerHTML += '<input type="datetime-local" name="masuk[]" id="masuk' + idf +
                    '" class="form-control text-center" value="' + `{{ date('Y-m-d H:i') }}` + '">';
                tr.appendChild(td);
                // Kolom 5 PULANG
                var td = document.createElement("td");
                td.setAttribute("style", "width:50px");
                td.innerHTML += '<input type="datetime-local" name="pulang[]" id="pulang' + idf +
                    '" class="form-control text-center" value="' + `{{ date('Y-m-d H:i') }}` + '">';
                tr.appendChild(td);
                // Kolom 6 TOTAL
                var td = document.createElement("td");
                td.setAttribute("style", "width:100px");
                td.innerHTML += '<input type="text" name="total[]" id="total' + idf +
                    '" class="form-control text-center bg-secondary-lt" readonly>';
                tr.appendChild(td);
                // Kolom 7 Keterangan
                var td = document.createElement("td");
                td.setAttribute("style", "width:100px");
                td.innerHTML += '<input type="text" name="keterangan[]" id="keterangan' + idf +
                    '" class="form-control">';
                tr.appendChild(td);
                detail_transaksi.appendChild(tr);
                idf = (idf - 1) + 2;
                document.getElementById("idf").value = idf;
            }

            function hapusElemen(idf) {
                $("#btn-remove-item" + idf).remove();
            }

            function fetchKar(params, sst) {
                var stb = $("#stb" + params).val();
                console.log("Searching : " + stb + "...");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $('#nama' + params).attr("readonly", true);
                $('#nama' + params).val('Mengambil data...');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('getalpha') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'stb': stb,
                        'sst': sst,
                    },
                    success: function(data) {
                        if (data.success = 'Data Ditemukan') {
                            $('#nama' + params).attr("readonly", false);
                            $('#nama' + params).val(data.result);
                            $('#userid' + params).val(data.userid);
                        } else {
                            $('#nama' + params).attr("readonly", false);
                            $('#nama' + params).val(data.error);
                        }
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                        $('#nama' + params).attr("readonly", false);
                        $('#nama' + params).val('STB Tdk Ditemukan');
                    }
                })
            }

            var tableLembur;
            $(function() {
                var token = $("meta[name='csrf-token']").attr("content");
                tableLembur = $('.datatable-lembur').DataTable({
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
                            text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Buat Lemburan',
                            className: 'btn btn-info',
                            attr: {
                                'href': '#modal-tambah-lembur',
                                'data-bs-toggle': 'modal',
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
                        "url": "{{ route('getLembur.index') }}",
                        "data": function(data) {
                            data._token = "{{ csrf_token() }}";
                            data.dari = $('#dari').val();
                            data.sampai = $('#sampai').val();
                        }
                    },
                    columns: [{
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
                    ],
                });
            });

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
                url: '{{ url('bpjsupdate') }}',
                type: 'number',
                pk: 1,
                name: 'nominal',
                title: 'Enter nominal',
            });
        </script>
    @endsection
