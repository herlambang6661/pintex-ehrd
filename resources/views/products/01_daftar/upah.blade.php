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
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-upah"
                                        id="tbkaryawan">
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
    {{-- Modal edit --}}
    <div class="modal modal-blur fade" id="modal-edit-upah" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Edit dan Update Libur Nasional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-edit-entitas"></div>
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
            $('.datatable-upah').on('init.dt', function() {
                $('.checkall').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Tooltip on top');
                $('.w_filter').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Advance Filter');
                $('.w_excel').attr('data-toggle', 'tooltip').attr('data-placement', 'top').attr('title',
                    'Download Excel dari tabel');
            });
            var tableUpah = $('.datatable-upah').DataTable({
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
                ajax: "{{ route('getUpah.index') }}",
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
                        title: 'Entitas',
                        data: 'entitas',
                        name: 'entitas',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Jenis',
                        data: 'jenis',
                        name: 'jenis',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Nominal',
                        data: 'nominal',
                        name: 'nominal',
                        className: 'cuspad0 text-center'
                    },
                ],

            });

            // $('#viewKaryawan').on('show.bs.modal', function(e) {
            //     var rowid = $(e.relatedTarget).data('id');
            //     console.log(rowid);
            //     $(".overlay").fadeIn(300);

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     //menggunakan fungsi ajax untuk pengambilan data
            //     $.ajax({
            //         type: 'POST',
            //         url: '{{ url('listKaryawan') }}',
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //             id: rowid,
            //         },
            //         success: function(data) {
            //             $('.fetched-data-karyawan').html(
            //                 data); //menampilkan data ke dalam modal
            //             // alert(itemTables);
            //         }
            //     }).done(function() {
            //         setTimeout(function() {
            //             $(".overlay").fadeOut(300);
            //         }, 500);
            //     });
            // });

            /*------------------------------------------
              --------------------------------------------
              Edit Update
              --------------------------------------------
              --------------------------------------------*/
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id'); // Menggunakan data-id
                var jenis = $(this).data('jenis');
                var nominal = $(this).data('nominal');

                $('#modal-edit-upah .fetched-edit-entitas').html(`
            <div class="card-stamp card-stamp-lg">
            <div class="card-stamp-icon bg-primary">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            </div>
            <div class="mb-3">
            <label class="form-label">Jenis</label>
            <input type="text" class="form-control border border-dark" name="jenis" id="editjenis" value="${jenis}">
            </div>
            <div class="mb-3">
            <label class="form-label">Nominal</label>
            <input type="text" class="form-control border border-dark" name="nominal" id="editnominal" value="${nominal}">
            </div>
            <div class="modal-footer">
            <button type="button" id="submiteditupah" class="btn btn-success" data-bs-dismiss="modal" data-id="${id}">
                <i class="fa-solid fa-pen-nib" style="margin-right:5px"></i> Update
            </button>
            </div>
            `);
            });

            $(document).on('click', '#submiteditupah', function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var csrfToken = $('form').find('input[name="_token"]').val();
                var formData = {
                    '_token': csrfToken,
                    'id': id,
                    'jenis': $('#editjenis').val(),
                    'nominal': $('#editnominal').val(),
                };

                $.ajax({
                    url: '/update/upah', // Menggunakan URL endpoint tanpa menggunakan blade syntax
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: response.msg,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#modal-edit').modal('hide');
                                    tableUpah.ajax.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.msg,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengirim data. Silakan coba lagi.',
                        });
                    }
                });
            });


            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Create Data
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/
            // if ($("#formLoker").length > 0) {
            //     $("#formLoker").validate({
            //         rules: {
            //             posisi: {
            //                 required: true,
            //             },
            //             tanggal_buka: {
            //                 required: true,
            //             },
            //             tanggal_tutup: {
            //                 required: true,
            //             },
            //             deskripsi: {
            //                 required: true,
            //             },
            //             persyaratan: {
            //                 required: true,
            //             },
            //         },
            //         messages: {
            //             posisi: {
            //                 required: "Masukkan Posisi Lowongan",
            //             },
            //             tanggal_buka: {
            //                 required: "Masukkan Tanggal Buka",
            //             },
            //             tanggal_tutup: {
            //                 required: "Masukkan Tanggal Tutup",
            //             },
            //             deskripsi: {
            //                 required: "Masukkan Deskripsi",
            //             },
            //             persyaratan: {
            //                 required: "Masukkan Persyaratan",
            //             },
            //         },

            //         submitHandler: function(form) {
            //             $.ajaxSetup({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 }
            //             });
            //             $('#submitLoker').html(
            //                 '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
            //             $("#submitLoker").attr("disabled", true);
            //             $.ajax({
            //                 url: "{{ url('storeDataLoker') }}",
            //                 type: "POST",
            //                 data: $('#formLoker').serialize(),
            //                 beforeSend: function() {
            //                     Swal.fire({
            //                         title: 'Mohon Menunggu',
            //                         html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, menambahkan ke Karir.pintex.co.id</h1>',
            //                         showConfirmButton: false,
            //                         timerProgressBar: true,
            //                         allowOutsideClick: false,
            //                         allowEscapeKey: false,
            //                     })
            //                 },
            //                 success: function(response) {
            //                     console.log('Completed.');
            //                     $('#submitLoker').html(
            //                         '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
            //                     );
            //                     $("#submitLoker").attr("disabled", false);
            //                     tableUpah.ajax.reload();
            //                     const Toast = Swal.mixin({
            //                         toast: true,
            //                         position: "top-end",
            //                         showConfirmButton: false,
            //                         timer: 4000,
            //                         timerProgressBar: true,
            //                         didOpen: (toast) => {
            //                             toast.onmouseenter = Swal.stopTimer;
            //                             toast.onmouseleave = Swal.resumeTimer;
            //                         }
            //                     });
            //                     Toast.fire({
            //                         icon: "success",
            //                         title: response.msg,
            //                     });
            //                     document.getElementById("formLoker").reset();
            //                     var sp = $('#selectEntitas').val();
            //                     $('#entitas').val(sp);
            //                 },
            //                 error: function(data) {
            //                     console.log('Error:', data);
            //                     tableUpah.ajax.reload();
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: 'Gagal Input',
            //                         html: data.responseJSON.message,
            //                         showConfirmButton: true
            //                     });
            //                     $('#submitLoker').html(
            //                         '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
            //                     );
            //                     $("#submitLoker").attr("disabled", false);
            //                 }
            //             });
            //         }
            //     })
            // }
        });
    </script>
@endsection
