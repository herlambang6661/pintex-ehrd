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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:10px" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-beach">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M17.553 16.75a7.5 7.5 0 0 0 -10.606 0" />
                                    <path d="M18 3.804a6 6 0 0 0 -8.196 2.196l10.392 6a6 6 0 0 0 -2.196 -8.196z" />
                                    <path
                                        d="M16.732 10c1.658 -2.87 2.225 -5.644 1.268 -6.196c-.957 -.552 -3.075 1.326 -4.732 4.196" />
                                    <path d="M15 9l-3 5.196" />
                                    <path
                                        d="M3 19.25a2.4 2.4 0 0 1 1 -.25a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 1 .25" />
                                </svg>
                                Aktifitas Cuti
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
                                                class="fa-solid fa-umbrella-beach"></i> Aktifitas Cuti</a></li>
                                </ol>
                            </div>
                        </div>

                        @if (Auth::user()->role == 'super' || Auth::user()->role == 'admin')
                            <!-- Page title actions -->
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="#"
                                        class="btn bg-azure-lt border border-azure d-none d-sm-inline-block btnSynCuti">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                        Sinkronisasi Cuti
                                    </a>
                                    <a href="#" class="btn bg-azure-lt border border-azure d-sm-none btn-icon"
                                        data-bs-toggle="modal" data-bs-target="#modal-upload" aria-label="Upload Excel">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="card card-xl shadow rounded">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                    <div class="mb-3">
                                        <label class="form-label">Cari Karyawan</label>
                                        <div class="row g-2">
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control border border-azure"
                                                    autofocus="true" id="idcari"
                                                    placeholder="Masukkan STB / Nama untuk melihat cuti">
                                            </div>
                                            <div class="col-auto">
                                                <button tupe="button" class="btn btn-icon bg-azure-lt border border-azure"
                                                    aria-label="Button" onclick="get_cuti();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                    </svg>
                                                </button>
                                                <i class="text-muted" id="textLoading"
                                                    style="margin-left: 20px;display:none"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="loading" style="display:none">
                                    <div class="col-4 col-sm-3">
                                        <div class="ph-item">
                                            <div class="ph-col-12">
                                                <div class="ph-picture"></div>
                                                <div class="ph-row">
                                                    <div class="ph-col-4"></div>
                                                    <div class="ph-col-12"></div>
                                                </div>
                                            </div>
                                            <div class="ph-col-2">
                                                <div class="ph-avatar"></div>
                                            </div>
                                            <div>
                                                <div class="ph-row">
                                                    <div class="ph-col-12"></div>
                                                    <div class="ph-col-2"></div>
                                                    <div class="ph-col-8 big"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-3">
                                        <div class="ph-item">
                                            <div class="ph-col-12">
                                                <div class="ph-picture"></div>
                                                <div class="ph-row">
                                                    <div class="ph-col-4"></div>
                                                    <div class="ph-col-12"></div>
                                                </div>
                                            </div>
                                            <div class="ph-col-2">
                                                <div class="ph-avatar"></div>
                                            </div>
                                            <div>
                                                <div class="ph-row">
                                                    <div class="ph-col-12"></div>
                                                    <div class="ph-col-2"></div>
                                                    <div class="ph-col-8 big"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-3">
                                        <div class="ph-item">
                                            <div class="ph-col-12">
                                                <div class="ph-picture"></div>
                                                <div class="ph-row">
                                                    <div class="ph-col-4"></div>
                                                    <div class="ph-col-12"></div>
                                                </div>
                                            </div>
                                            <div class="ph-col-2">
                                                <div class="ph-avatar"></div>
                                            </div>
                                            <div>
                                                <div class="ph-row">
                                                    <div class="ph-col-12"></div>
                                                    <div class="ph-col-2"></div>
                                                    <div class="ph-col-8 big"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-3">
                                        <div class="ph-item">
                                            <div class="ph-col-12">
                                                <div class="ph-picture"></div>
                                                <div class="ph-row">
                                                    <div class="ph-col-4"></div>
                                                    <div class="ph-col-12"></div>
                                                </div>
                                            </div>
                                            <div class="ph-col-2">
                                                <div class="ph-avatar"></div>
                                            </div>
                                            <div>
                                                <div class="ph-row">
                                                    <div class="ph-col-12"></div>
                                                    <div class="ph-col-2"></div>
                                                    <div class="ph-col-8 big"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fetched-data-cuti"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.footer')
            </div>
        </div>

        <script>
            $(function() {
                /*------------------------------------------
                --------------------------------------------
                Render DataTable
                --------------------------------------------
                --------------------------------------------*/
                var tableWawancara = $('.datatable-cuti').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
                    "scrollX": true,
                    "scrollCollapse": false,
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
                    },
                    ajax: "{{ route('getCuti.index') }}",
                    columns: [{
                            title: 'Opsi',
                            data: 'action',
                            name: 'action',
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
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Tgl Awal',
                            data: 'tglawal',
                            name: 'tglawal',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Tgl Akhir',
                            data: 'tglakhir',
                            name: 'tglakhir',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Cuti Awal',
                            data: 'sacuti',
                            name: 'sacuti',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Cuti Terpakai',
                            data: 'cutiterpakai',
                            name: 'cutiterpakai',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Sisa Cuti',
                            data: 'sisacuti',
                            name: 'sisacuti',
                            className: 'cuspad0 text-center'
                        },
                    ],

                });
            });


            function get_cuti() {
                var idcari = $('#idcari').val();
                console.log("Searching for " + idcari);
                $("#loading").fadeIn(200);
                $("#textLoading").fadeIn(200);
                $('.fetched-data-cuti').html('');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: "{{ url('getcuti') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'idcari': idcari,
                    },
                    beforeSend: function() {
                        $('#textLoading').text('Mencari Data Cuti...');
                    },
                    success: function(data) {
                        $('.fetched-data-cuti').html(data);
                    },
                    error: function(data) {
                        console.log('Error:', data.responseText);
                        $('#textLoading').text('STB / Nama tidak ditemukan');
                        $("#loading").fadeOut(200);
                        setTimeout(function() {
                            $("#textLoading").fadeOut(200);
                        }, 4000);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $("#textLoading").fadeOut(200);
                        $("#loading").fadeOut(200);
                    }, 300);
                });
            }

            $(document).on('click', '.btnSynCuti', function() {
                // var id = $(this).data('id');
                // var noform = $(this).data('noform');
                // var kode = $(this).data('kode');
                // var typeHapus = $(this).data('typehapus');
                // var kodeproduksi = $(this).data('kodeproduksi');
                // var token = $("meta[name='csrf-token']").attr("content");
                // nama = (typeHapus == "form") ? noform : kode;
                // console.log("menghapus " + kodeproduksi);
                // let r = (Math.random() + 1).toString(36).substring(2);
                swal.fire({
                    title: 'Sinkronisasi',
                    html: 'Apakah anda yakin ingin sinkronisasi data cuti ?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('syncCuti') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                // "tipeHapus": typeHapus,
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
                                // tablePengebonan.ajax.reload(null,
                                //     false);
                                $('#modalViewItem').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    html: data,
                                    showConfirmButton: true
                                });
                                // if (kodeproduksi) {
                                //     $("#btn-remove" + kodeproduksi).remove();
                                // }
                            },
                            error: function(data) {
                                // tablePengebonan.ajax.reload(null,
                                //     false);
                                // console.log('Error:', data
                                //     .responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Error: ' + data.responseText,
                                    showConfirmButton: true,
                                });
                            }
                        });
                    }
                })
            });
        </script>
    @endsection
