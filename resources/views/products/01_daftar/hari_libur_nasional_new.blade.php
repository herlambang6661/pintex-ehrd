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
                                                class="fa-regular fa-envelope"></i> Libur Nasional</a></li>
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
                        <div class="col-12">
                            <div class="card card-xl border-success shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-success">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 mt-3 ms-3">
                                        <div class="mb-3">
                                            <form action="javascript:void(0)">
                                                @csrf
                                                <label class="form-label">Pilih Tahun</label>
                                                <div class="input-group">
                                                    <input type="number" id="selectYear" min="2000" max="9999"
                                                        step="1" value="{{ date('Y') }}"
                                                        class="form-control formattahun">
                                                    <button type="button" class="btn btn-blue" id="btnView"
                                                        onclick="tb();"><i class="fa-regular fa-eye fa-fw"
                                                            style="margin-right:5px"></i>
                                                        Lihat</button>
                                                    <button data-bs-toggle="dropdown" type="button"
                                                        class="btn btn-blue dropdown-toggle dropdown-toggle-split"
                                                        aria-expanded="false"></button>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <a class="dropdown-item" href="javascript:void(0)" id="genYear">
                                                            <i class="fa-solid fa-cloud-arrow-down fa-fw"
                                                                style="margin-right:5px"></i>Generate Libur Nasional
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fa-solid fa-arrows-rotate fa-fw"
                                                                style="margin-right:5px"></i>
                                                            Sinkronisasi ke Absensi
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="fa-solid fa-calendar-plus fa-fw"
                                                                style="margin-right:5px"></i>Tambahkan Manual
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="fetched-data-liburnas"></div>

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
            @include('shared.footer')
        </div>
    </div>

    <script class="text/javascript">
        $(function() {
            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            // var tablePos = $('.datatable-libur').DataTable({
            //     "processing": true, //Feature control the processing indicator.
            //     "serverSide": false, //Feature control DataTables' server-side processing mode.
            //     "scrollX": false,
            //     "scrollCollapse": true,
            //     "pagingType": 'full_numbers',
            //     "lengthMenu": [
            //         [-1, 25, 35, 40, 50, ],
            //         ['Tampilkan Semua', '25', '35', '40', '50', ]
            //     ],
            //     "dom": "" +
            //         "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
            //         "<'table-responsive' <'col-sm-12'tr> >" +
            //         "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
            //     "language": {
            //         "lengthMenu": "Menampilkan _MENU_",
            //         "zeroRecords": "Data Tidak Ditemukan",
            //         "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
            //         "infoEmpty": "Data Tidak Ditemukan",
            //         "infoFiltered": "(Difilter dari _MAX_ total records)",
            //         "processing": '<div class="container container-slim py-4"><div class="text-center"><div class="mb-3"></div><div class="text-secondary mb-3">Loading Data...</div><div class="progress progress-sm"><div class="progress-bar progress-bar-indeterminate"></div></div></div></div>',
            //         "search": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>',
            //         "paginate": {
            //             "first": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6v12"></path><path d="M18 6l-6 6l6 6"></path></svg>',
            //             "last": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 6l6 6l-6 6"></path><path d="M17 5v13"></path></svg>',
            //             "next": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>',
            //             "previous": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>',
            //         },
            //     },
            //     // ajax: "{{ route('getLibur.index') }}",
            //     "ajax": {
            //         "url": "{{ route('getLibur.index') }}",
            //         "data": function(data) {
            //             data._token = "{{ csrf_token() }}";
            //             data.tahun = $('#selectYear').val();
            //         }
            //     },
            //     columns: [{
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false,
            //             className: 'cuspad0 text-center w-0'
            //         },
            //         {
            //             data: 'entitas',
            //             name: 'entitas',
            //             className: 'cuspad0 text-center w-0'
            //         },
            //         {
            //             title: "Tanggal",
            //             data: "tanggal",
            //             render: function(data, type, row) {
            //                 return '<input class="form-control" id="tanggal' + row.id +
            //                     '" name="tanggal' + row.id + '" type="date"  value = ' +
            //                     row.tanggal + '  >';
            //             }
            //         },
            //         {
            //             data: 'tahun',
            //             name: 'tahun',
            //             className: 'cuspad0 text-center w-0'
            //         },
            //         {
            //             title: "Libur",
            //             data: 'libur_nasional',
            //         },
            //         {
            //             title: "Sumber",
            //             data: 'sumber_ketentuan',
            //             render: function(data, type, row) {
            //                 return '<input class="form-control" id="sumber_ketentuan' + row.id +
            //                     '" name="sumber_ketentuan' + row.id + '" type="text"  value = "' +
            //                     row.sumber_ketentuan + '" >';
            //             }
            //         },
            //         {
            //             title: "Keterangan",
            //             data: 'keterangan',
            //             render: function(data, type, row) {
            //                 return '<input class="form-control" id="keterangan' + row.id +
            //                     '" name="keterangan' + row.id + '" type="text"  value="' +
            //                     row.keterangan + '">';
            //             }
            //         },
            //     ],

            // });

            $('#btnView').click(function() { //button filter event click
                tablePos.ajax.reload(); //just reload table
            });

            $(document).on('click', '#genYear', function(e) {
                e.preventDefault();

                var year = $('#selectYear').val();
                var csrfToken = $('form').find('input[name="_token"]').val();

                $('#btnView').html(
                    '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                $("#btnView").attr("disabled", true);
                $.ajax({
                    url: '{{ url('generateYear') }}',
                    method: 'POST',
                    // data: formData,
                    data: {
                        "_token": csrfToken,
                        'year': year,
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
                        $('#btnView').html(
                            '<i class="fa-regular fa-eye fa-fw" style="margin-right:5px"></i> Lihat'
                        );
                        $("#btnView").attr("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat generate data. Silakan coba lagi.',
                        });
                        $('#btnView').html(
                            '<i class="fa-regular fa-eye fa-fw" style="margin-right:5px"></i> Lihat'
                        );
                        $("#btnView").attr("disabled", false);
                    }
                });
            });

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
                        keterangan: {
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
                        keterangan: {
                            required: "Masukkan Keterangan"
                        }
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
        });

        function tb() {
            var thn = $('#selectYear').val();
            console.log('set: ' + thn);

            $(".ph-item").fadeIn(200);
            $('.fetched-data-liburnas').html('');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type: 'POST',
                url: "{{ url('getLibur') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'thn': thn,
                },
                success: function(data) {
                    $('.fetched-data-liburnas').html(data);
                }
            }).done(function() {
                setTimeout(function() {
                    $(".ph-item").fadeOut(200);
                }, 300);
            });
        }
    </script>
@endsection
