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
                                </svg>Kelola Potongan Data Karyawan
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
                                            <i class="fa-solid fa-file-invoice-dollar"></i> Kelola Karyawan
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
                                        <table
                                            class="table table-sm table-bordered table-hover table-striped mt-3 dt-karyawan"
                                            style="width: 100%">
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

        {{-- Modal Edit --}}
        <div class="modal modal-blur fade" id="editKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <form id="formUpdateKaryawan" name="formUpdateKaryawan" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa-solid fa-user" style="margin-right: 5px"></i> Data Karyawan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="fetched-data-karyawan"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" id="submitEdit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Simpan
                            </button>
                            <button type="button" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal">
                                <i class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var tablePayroll;
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
                console.log("fetch: " + "{{ substr($periode, 2, 2) }} - 20{{ substr($periode, 0, 2) }}");
                tablePayroll = $('.dt-karyawan').DataTable({
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
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn btn-success',
                        text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-table"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /><path d="M3 10h18" /><path d="M10 3v18" /></svg> Download Excel',
                        action: newexportaction,
                    }, ],
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
                    },
                    "ajax": {
                        "url": "{{ route('getPayroll.index') }}",
                        "data": function(data) {
                            data._token = "{{ csrf_token() }}";
                            data.bulan = "{{ substr($periode, 2, 2) }}";
                            data.tahun = "20{{ substr($periode, 0, 2) }}";
                        }
                    },
                    columns: [{
                            title: 'TH/BL',
                            data: 'periode',
                            name: 'periode',
                            orderable: false,
                            searchable: false,
                            className: 'cuspad0 text-center'
                        },
                        {
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
                        {
                            title: 'Level',
                            data: 'level',
                            name: 'level',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Tunj. Jabatan',
                            data: 'tjabat',
                            name: 'tjabat',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Prestasi',
                            data: 'prestasi',
                            name: 'prestasi',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Opsi',
                            data: 'opsiEditLevelKaryawan',
                            name: 'opsiEditLevelKaryawan',
                            className: 'cuspad0 text-center'
                        },
                    ],
                });

                $('#editKaryawan').on('show.bs.modal', function(e) {
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
                        url: '{{ url('editLevelKaryawan') }}',
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


                if ($("#formUpdateKaryawan").length > 0) {
                    $("#formUpdateKaryawan").validate({
                        submitHandler: function(form) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#submitEdit').html(
                                '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                            $("#submitEdit").attr("disabled", true);
                            $.ajax({
                                url: "{{ url('storeUpdateLevelKaryawan') }}",
                                type: "POST",
                                data: $('#formUpdateKaryawan').serialize(),
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Mohon Menunggu',
                                        html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit.</h1>',
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    })
                                },
                                success: function(response) {
                                    console.log('Completed.');
                                    $('#submitEdit').html(
                                        '<i class="fas fa-save" style="margin-right: 5px"></i> Simpan'
                                    );
                                    $("#submitEdit").attr("disabled", false);
                                    tablePayroll.ajax.reload();
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
                                    document.getElementById("formUpdateKaryawan").reset();
                                    $('#editKaryawan').modal('hide');
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    // const obj = JSON.parse(data.responseJSON);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#submitEdit').html(
                                        '<i class="fas fa-save" style="margin-right: 5px"></i> Simpan'
                                    );
                                    $("#submitEdit").attr("disabled", false);
                                }
                            });
                        }
                    })
                }
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
