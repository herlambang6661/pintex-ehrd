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
                                Surat Komunikasi
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
                                                class="fa-solid fa-envelopes-bulk"></i> Surat Komunikasi</a></li>
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
                        <div class="card shadow rounded">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#tabs-home-3" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                            role="tab" tabindex="-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                                <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                                <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                                <path d="M11 6l9 0" />
                                                <path d="M11 12l9 0" />
                                                <path d="M11 18l9 0" />
                                            </svg>
                                            List Surat</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab"
                                            aria-selected="false" role="tab" tabindex="-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-mail-plus">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                <path d="M16 19h6" />
                                                <path d="M19 16v6" />
                                                <path d="M3 7l9 6l9 -6" />
                                            </svg>
                                            Buat Surat Baru</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                                            role="tab">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                            Berdasarkan Absensi</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
                                        <div class="card-stamp card-stamp-lg">
                                            <div class="card-stamp-icon bg-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-mail-plus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                    <path d="M16 19h6" />
                                                    <path d="M19 16v6" />
                                                    <path d="M3 7l9 6l9 -6" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-profile-3" role="tabpanel">
                                        <div class="card-stamp card-stamp-lg">
                                            <div class="card-stamp-icon bg-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class=" mb-0">
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
                                                            <input type="text" class="form-control tglaw"
                                                                value="{{ date('Y-m-16') }}" id="datepicker0">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control tglak"
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

            Date.prototype.addDays = function(days) {
                var dat = new Date(this.valueOf())
                dat.setDate(dat.getDate() + days);
                return dat;
            }

            function getDates(startDate, stopDate) {
                var dateArray = new Array();
                var currentDate = startDate;
                while (currentDate <= stopDate) {
                    dateArray.push(currentDate)
                    currentDate = currentDate.addDays(1);
                }
                return dateArray;
            }

            function monthDiff(d1, d2) {
                var months;
                months = (d2.getFullYear() - d1.getFullYear()) * 12;
                months -= d1.getMonth();
                months += d2.getMonth();
                return months <= 0 ? 0 : months;
            }

            function tb() {
                var tglfull = [];
                const days = [];
                const month = [];
                var dateArray = getDates(new Date($('.tglaw').val()), (new Date($('.tglak').val())));
                var monthArray = monthDiff(new Date($('.tglaw').val()), (new Date($('.tglak').val())));

                for (i = 0; i < dateArray.length; i++) {
                    days.push(dateArray[i].getDate());
                }
                for (i = 0; i < dateArray.length; i++) {
                    var dateString = new Date(dateArray[i].getTime() - (dateArray[i].getTimezoneOffset() * 60000))
                        .toISOString()
                        .split("T")[0];
                    tglfull.push(dateString);
                }
                var aw = $('.tglaw').val();
                var ak = $('.tglak').val();
                console.log(aw);

                $(".ph-item").fadeIn(200);
                $('.fetched-data-absensi').html('');
                // var tglaw = $('.tglaw').val();
                // var tglak = $('.tglak').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: "{{ url('getabsensi') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'tglfull': tglfull,
                        'tgl': days,
                        'aw': aw,
                        'ak': ak,
                        'tglaw': $('.tglaw').val(),
                        'tglak': $('.tglak').val(),
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
    @endsection
