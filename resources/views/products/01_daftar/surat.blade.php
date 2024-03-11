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
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                                    Surat-Surat
                                    <div id="entitasText" style="margin-left: 5px;">Loading... <i class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                                </h2>
                                <div class="page-pretitle">
                                    <ol class="breadcrumb" aria-label="breadcrumbs">
                                        <li class="breadcrumb-item"><a href="{{ url('dashboard'); }}"><i class="fa fa-home"></i> Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i> Penerimaan</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a href="#"><i class="fa-regular fa-envelope"></i> Lamaran</a></li>
                                    </ol>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row row-cards">
                            <div class="col-6">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-bordered table-hover text-nowrap datatable-surat" id="tblamaran">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Opsi</th>
                                                <th>Jenis Surat</th>
                                                <th>Nama Surat</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card card-xl border-blue-lt shadow rounded">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="modal-title"><i class="fa-solid fa-file-circle-plus"></i> Buat surat-surat</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="formSurat" name="formSurat" method="post" action="javascript:void(0)">
                                            @csrf
                                                <div class="card-stamp card-stamp-lg">
                                                    <div class="card-stamp-icon bg-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Entitas</label>
                                                    <input type="text" class="form-control border border-dark bg-secondary-lt" name="entitas" id="entitas" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Surat</label>
                                                    <select name="jenissurat" id="jenissurat" class="form-select border border-dark">
                                                        <option value="" hidden>-- Pilih Jenis Surat --</option>
                                                        <option value="Basic">Basic</option>
                                                        <option value="Intern">Intern</option>
                                                        <option value="Komunikasi">Komunikasi</option>
                                                        <option value="Perjanjian">Perjanjian</option>
                                                        <option value="Status">Status</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Surat</label>
                                                    <input type="text" class="form-control border border-dark" name="nmsurat" id="nmsurat" placeholder="Masukkan Nama Surat">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nilai</label>
                                                    <input type="text" class="form-control border border-dark" name="nilai" id="nilai" placeholder="Masukkan Nilai Surat">
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a> --}}
                                                    <button type="submit" id="submitSurat" class="btn btn-primary ms-auto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                                                        Simpan
                                                    </button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.footer')
            </div>
        </div>
        {{-- Modal tambah lamaran --}}
        <div class="modal modal-blur fade" id="modal-lamaran" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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

            $(function () {
                
                /*------------------------------------------
                --------------------------------------------
                Render DataTable
                --------------------------------------------
                --------------------------------------------*/
            
                var tableSurat = $('.datatable-surat').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
                    "scrollX": true,
                    "scrollCollapse": true,
                    "pagingType": 'full_numbers',
                    "lengthMenu": [
                        [ -1, 25, 35, 40, 50,],
                        ['Tampilkan Semua', '25', '35', '40', '50', ]
                    ],
                    "dom": "<'card-header h3' B>" +
                        "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                        "<'table-responsive' <'col-sm-12'tr> >" +
                        "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                    buttons: [
                        {
                            className: 'btn btn-dark checkall',
                            text: '<i class="fa-regular fa-square-check"></i>',
                        },
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
                    ajax: "{{ route('getSurat.index') }}",
                    columns: [
                        {data: 'action', name: 'action', orderable: false, searchable: false, className:'cuspad0 text-center w-0'},
                        {data: 'jenissurat', name: 'jenissurat', className:'cuspad0 text-center w-0'},
                        {data: 'nmsurat', name: 'nmsurat', className:'cuspad0'},
                        {data: 'nilai', name: 'nilai', className:'cuspad0 text-center'},
                    ],
                    
                });

                /*------------------------------------------==============================================================================================================================================================
                --------------------------------------------==============================================================================================================================================================
                Create Data
                --------------------------------------------==============================================================================================================================================================
                --------------------------------------------==============================================================================================================================================================*/
                if ($("#formSurat").length > 0) {
                    $("#formSurat").validate({
                        rules: {
                            entitas: {
                                required: true,
                            },
                            jenissurat: {
                                required: true,
                            },
                            nmsurat: {
                                required: true,
                            },
                        },
                        messages: {
                            entitas: {
                                required: "Masukkan Entitas",
                            },
                            jenissurat: {
                                required: "Masukkan Jenis Surat",
                            },
                            nmsurat: {
                                required: "Masukkan nama Surat",
                            },
                        },

                        submitHandler: function(form) {
                            $.ajaxSetup({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#submitSurat').html('<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                            $("#submitSurat"). attr("disabled", true);
                            $.ajax({
                                url: "{{url('storedataSurat')}}",
                                type: "POST",
                                data: $('#formSurat').serialize(),
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
                                success: function( response ) {
                                    console.log( 'Completed.' );
                                    $('#submitSurat').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan');
                                    $("#submitSurat"). attr("disabled", false);
                                    tableSurat.ajax.reload();
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
                                    document.getElementById("formSurat").reset();
                                    var sp = $('#selectEntitas').val();
                                    $('#entitas').val(sp);
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                    // const obj = JSON.parse(data.responseJSON);
                                    tableSurat.ajax.reload();
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#submitSurat').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan');
                                    $("#submitSurat"). attr("disabled", false);
                                }
                            });
                        }
                    })
                }
                
                /*------------------------------------------
                --------------------------------------------
                Delete
                --------------------------------------------
                --------------------------------------------*/
                $('body').on('click', '.deleteSurat', function () {
                    var contract_id = $(this).data("id");
                    var nama = $(this).data("nama");
                    var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        icon: 'warning',
                        title: 'Hapus Data Lamaran',
                        text: 'Apakah anda yakin ingin menghapus '+nama+' ?',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ route('getSurat.store') }}"+'/'+contract_id,
                                    data: {
                                        "_token": "{{ csrf_token() }}",
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
                                    success: function (data) {
                                        $('.datatable-surat').DataTable().ajax.reload();
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                            Toast.fire({
                                            icon: "success",
                                            title: "Data Lamaran : "+nama+" Terhapus"
                                        });
                                    },
                                    error: function (data) {
                                        console.log('Error:', data.responseText);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Error: '+ data.responseText,
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
