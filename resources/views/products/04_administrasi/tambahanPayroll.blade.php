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
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-dollar">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                    <path d="M12 17v1m0 -8v1" />
                                </svg>Kelola Potongan koperasi & Pinjaman
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-calendar-days"></i>
                                            Administrasi</a></li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('administrasi/payroll') }}">
                                            <i class="fa-solid fa-file-invoice-dollar"></i> Payroll
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-file-invoice-dollar"></i> Kelola Pinjaman
                                            <i class="text-danger"> (Restricted Area).</i>
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
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
                                                <form method="post" action="{{ route('importPayroll') }}"
                                                    enctype="multipart/form-data">
                                                    <div class="form-label">
                                                        Upload Excel
                                                        <a href="/payroll/export_excel">
                                                            <i>( Download file contoh )</i>
                                                        </a>
                                                    </div>
                                                    <div class="input-group">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="periode" id="periodeUpload"
                                                            value="{{ $periode }}">
                                                        <input type="file" name="file" required="required"
                                                            class="form-control" accept=".xl*">
                                                        <button type="submit" class="btn btn-primary"
                                                            onclick="loading();">Upload Excel</button>
                                                    </div>
                                                </form>
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
                                        <table class="table table-sm table-bordered table-hover table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">TH/BL</th>
                                                    <th class="text-center">STB</th>
                                                    <th class="text-center">NAMA</th>
                                                    <th class="text-center">KOPERASI</th>
                                                    <th class="text-center">PINJAMAN</th>
                                                    <th class="text-center">OPSI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tambahan as $t)
                                                    <tr>
                                                        <td class="text-center">{{ $t->periode }}</td>
                                                        <td class="text-center">{{ $t->stb }}</td>
                                                        <td>{{ $t->nama }}</td>
                                                        <td class="text-center">{{ $t->level }}</td>
                                                        <td class="text-center">
                                                            <a href="" class="editable" data-type="number"
                                                                data-stb="{{ $t->stb }}"
                                                                data-periode="{{ $periode }}"
                                                                data-name="{{ $t->id }}" data-pk="koperasi">
                                                                {{ $t->potongan_koperasi }}
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" class="editable" data-type="number"
                                                                data-stb="{{ $t->stb }}"
                                                                data-periode="{{ $periode }}"
                                                                data-name="{{ $t->id }}" data-pk="pinjaman">
                                                                {{ $t->potongan_pinjaman }}
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-icon btn-sm btn-red">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M4 7l16 0" />
                                                                    <path d="M10 11l0 6" />
                                                                    <path d="M14 11l0 6" />
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
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
        <div class="modal modal-blur fade bg-dark" id="modal-rekap" tabindex="-1" style="display: none;"
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
            <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="fetched-rekap-payroll"></div>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                $('#modal-rekap').on('show.bs.modal', function(e) {
                    var bln = $('#bulan').val();
                    var thn = $('#tahun').val();
                    console.log('Rekap payroll: ' + bln + '/' + thn);
                    // var rowid = $(e.relatedTarget).data('id');
                    // var rowaw = $(e.relatedTarget).data('tglaw');
                    // var rowak = $(e.relatedTarget).data('tglak');
                    // console.log("Fetch: " + rowid);
                    $(".overlay").fadeIn(300);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('rekapPayroll') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            bulan: bln,
                            tahun: thn,
                            // tglak: rowak,
                        },
                        success: function(data) {
                            //menampilkan data ke dalam modal
                            $('.fetched-rekap-payroll').html(data);
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
            function loading() {
                $(".spinnerLoading").fadeIn(200);
            }

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

            var d = new Date();
            var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
            $(function() {
                var token = $("meta[name='csrf-token']").attr("content");


            });

            function syn() {
                tablePayroll.ajax.reload();
            }

            function setPeriodeToUpload() {
                var bln = $('#bulan').val();
                var thn = $('#tahun').val();

                $('#periodeUpload').val(thn.substring(2, 4) + bln)
            }
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
                url: '/administrasi/updateTambahanPayroll',
                pk: 1,
                title: 'Enter nominal',
            });
        </script>
    @endsection
