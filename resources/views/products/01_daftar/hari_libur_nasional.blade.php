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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                    <path d="M3 7l9 6l9 -6" />
                                </svg>
                                {{ $judul }}
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i>
                                            Daftar</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-regular fa-envelope"></i> Pos Pekerjaan</a></li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <li class="list-group-item placeholder-glow placehold-absensi" style="display: none">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                            </div>
                            <div class="col-6 ms-auto text-end">
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                                <div class="placeholder placeholder-xs col-12"></div>
                            </div>
                        </div>
                    </li>
                    <div class="row row-cards" id="tableShow">
                        <div class="col-6">
                            <div class="card card-xl border-success shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-success">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                <div class="container pt-3">
                                    <form action="javascript:void(0)">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" id="selectYear" min="2000" max="9999"
                                                step="1" value="{{ date('Y') }}" class="form-control formattahun">
                                            <button type="button" class="btn btn-blue" id="btnView" onclick="syn()">
                                                <i class="fa-regular fa-eye fa-fw" style="margin-right:5px"></i>
                                                Lihat
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                    class="display table table-vcenter card-table table-sm table-bordered table-hover text-nowrap datatable-libur"
                                    id="tblamaran">
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-xl border-blue-lt shadow rounded">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="fa-solid fa-file-circle-plus"></i> Buat Hari Libur
                                        Nasional
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form id="formlibur" name="formlibur" method="post" action="javascript:void(0)">
                                        @csrf
                                        <div class="card-stamp card-stamp-lg">
                                            <div class="card-stamp-icon bg-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Entitas</label>
                                            <input type="text" class="form-control border border-dark bg-secondary-lt"
                                                name="entitas" id="entitas" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" class="form-control border border-dark" name="tanggal"
                                                value="{{ date('Y-m-d') }}" id="datepicker0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Libur Nasional</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="libur_nasional" id="libur_nasional"
                                                placeholder="Masukkan Nama Libur Nasional">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sumber Ketentuan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="sumber_ketentuan" id="sumber_ketentuan"
                                                placeholder="Masukkan Nama Sumber Ketentuan">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <input type="text" class="form-control border border-dark"
                                                name="keterangan" id="keterangan" placeholder="Masukkan Nama Keterangan">
                                        </div>
                                        <div class="modal-footer">
                                            {{-- <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a> --}}
                                            <button type="submit" id="submitLibur" class="btn btn-primary ms-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-device-floppy" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                </svg>
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

    {{-- Modal View --}}
    <div class="modal modal-blur fade" id="modal-view-liburnas" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post">
                    @csrf
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Hari Libur Nasional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-liburnas"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa-solid fa-arrow-rotate-left" style="margin-right:5px"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal edit --}}
    <div class="modal modal-blur fade" id="modal-edit-liburnas" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editliburnasional" name="editliburnasional" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Edit dan Update Libur Nasional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-edit-liburnas"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                            <i class="fa-solid fa-pen-nib" style="margin-right:5px"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script class="text/javascript">
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
        var tablePos;

        function syn() {
            tablePos.ajax.reload();
        }

        function loading() {
            $("#tableShow").fadeOut(50);
            $(".placehold-absensi").fadeIn(200);
        }

        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/

            tablePos = $('.datatable-libur').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [-1, 25, 35, 40, 50, ],
                    ['Tampilkan Semua', '25', '35', '40', '50', ]
                ],
                "dom": "<'card-header h3'>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
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
                // ajax: "{{ route('getLibur.index') }}",
                "ajax": {
                    "url": "{{ route('getLibur.index') }}",
                    "data": function(data) {
                        data._token = "{{ csrf_token() }}";
                        data.tahun = $('#selectYear').val();
                    }
                },
                columns: [{
                        title: 'Opsi',
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'cuspad0 text-center w-0'
                    },
                    {
                        title: 'Tanggal',
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Libur',
                        data: 'libur_nasional',
                        name: 'libur_nasional',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Sumber',
                        data: 'sumber_ketentuan',
                        name: 'sumber_ketentuan',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Keterangan',
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'cuspad0 text-center'
                    },
                ],

            });

            var selected = new Array();

            $('#modal-view-liburnas').on('show.bs.modal', function(e) {
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
                    url: '{{ url('detail/liburnas') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: rowid,
                    },
                    success: function(data) {
                        $('.fetched-data-liburnas').html(
                            data); //menampilkan data ke dalam modal
                        // alert(itemTables);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });

            /*------------------------------------------
            --------------------------------------------
            Edit Update
            --------------------------------------------
            --------------------------------------------*/
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var entitas = $(this).data('entitas');
                var tanggal = $(this).data('tanggal');
                var libur_nasional = $(this).data('libur_nasional');
                var sumber_ketentuan = $(this).data('sumber_ketentuan');
                var keterangan = $(this).data('keterangan');

                $('#modal-edit-liburnas .fetched-edit-liburnas').html(`
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Entitas</label>
                                <input type="hidden" name="idlibur" id="idlibur" value="${id}">
                                <input type="text" class="form-control border border-dark bg-secondary-lt" readonly name="entitas" id="editentitas" value="${entitas}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control border border-dark" name="tanggal" id="edittanggal" value="${tanggal}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Libur Nasional</label>
                                <input type="text" class="form-control border border-dark" name="libur_nasional" id="editlibur_nasional" value="${libur_nasional}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sumber Ketentuan</label>
                                <input type="text" class="form-control border border-dark" name="sumber_ketentuan" id="editsumber_ketentuan" value="${sumber_ketentuan}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control border border-dark" name="keterangan" id="editketerangan"value="${keterangan}">
                            </div>
                `);
            });

            $(document).on('click', '#submiteditliburnas', function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var csrfToken = $('form').find('input[name="_token"]').val();

                var formData = {
                    '_token': csrfToken,
                    'id': id,
                    'entitas': $('#editentitas').val(),
                    'tanggal': $('#edittanggal').val(),
                    'libur_nasional': $('#editlibur_nasional').val(),
                    'sumber_ketentuan': $('#editsumber_ketentuan').val(),
                    'keterangan': $('#editketerangan').val()
                };

                $.ajax({
                    url: '{{ url('update/liburnas') }}',
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
                                    tablePos.ajax.reload();
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

            if ($("#editliburnasional").length > 0) {
                $("#editliburnasional").validate({
                    rules: {
                        entitas: {
                            required: true,
                        },
                        tanggal: {
                            required: true,
                            date: true
                        },
                        libur_nasional: {
                            required: true,
                        },
                        sumber_ketentuan: {
                            required: true,
                        },
                    },
                    messages: {
                        entitas: {
                            required: "Masukkan Entitas",
                        },
                        tanggal: {
                            required: "Masukkan Tanggal",
                        },
                        libur_nasional: {
                            required: "Masukkan Libur Nasional",
                        },
                        sumber_ketentuan: {
                            required: "Masukkan Sumber Ketentuan",
                        },
                    },

                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submiteditliburnas').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submiteditliburnas").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('updatelibur') }}",
                            type: "POST",
                            data: $('#editliburnasional').serialize(),
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
                                $('#submiteditliburnas').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submiteditliburnas").attr("disabled", false);
                                tablePos.ajax.reload();
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
                                var sp = $('#selectEntitas').val();
                                $('#entitas').val(sp);
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                tablePos.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submiteditliburnas').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submiteditliburnas").attr("disabled", false);
                            }
                        });
                    }
                })
            }

            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Create Data
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/
            if ($("#formlibur").length > 0) {
                $("#formlibur").validate({
                    rules: {
                        entitas: {
                            required: true,
                        },
                        tanggal: {
                            required: true,
                            date: true
                        },
                        libur_nasional: {
                            required: true,
                        },
                        sumber_ketentuan: {
                            required: true,
                        },
                    },
                    messages: {
                        entitas: {
                            required: "Masukkan Entitas",
                        },
                        tanggal: {
                            required: "Masukkan Tanggal",
                        },
                        libur_nasional: {
                            required: "Masukkan Libur Nasional",
                        },
                        sumber_ketentuan: {
                            required: "Masukkan Sumber Ketentuan",
                        },
                    },

                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submitLibur').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitLibur").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataLibur') }}",
                            type: "POST",
                            data: $('#formlibur').serialize(),
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
                                $('#submitLibur').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitLibur").attr("disabled", false);
                                tablePos.ajax.reload();
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
                                document.getElementById("formlibur").reset();
                                var sp = $('#selectEntitas').val();
                                $('#entitas').val(sp);
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                tablePos.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submitLibur').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitLibur").attr("disabled", false);
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

            $('body').on('click', '.deletePos', function() {
                var contract_id = $(this).data("id");
                var nama = $(this).data("tanggal");
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    icon: 'warning',
                    title: 'Hapus Data Hari Libur Nasional',
                    text: 'Apakah anda yakin ingin menghapus ' + nama + ' ?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('getLibur.store') }}" + '/' + contract_id,
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
                            success: function(data) {
                                $('.datatable-surat').DataTable().ajax.reload();
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
                                    title: "Data Hari Libur Nasional : " +
                                        nama +
                                        " Terhapus"
                                });
                                tablePos.ajax.reload();
                            },
                            error: function(data) {
                                console.log('Error:', data.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Error: ' + data.responseText,
                                    showConfirmButton: true,
                                });
                                tablePos.ajax.reload();
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection
