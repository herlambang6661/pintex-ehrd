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

        <?php
        
        use Carbon\Carbon;
        date_default_timezone_set('Asia/Jakarta');
        ?>
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
                                List Absensi {{ Str::upper($jns) }}
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-calendar-days"></i>
                                            Absensi</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('absensi/absensi') }}"><i
                                                class="fa-regular fa-calendar-check"></i> List Absensi</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-person-running"></i> Data {{ $jns }}
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            {{-- <div class="btn-list">
                                <button onclick="history.back()" class="btn btn-info d-none d-sm-inline-block">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    Kembali
                                </button>
                                <button onclick="history.back()" class="btn btn-info d-sm-none btn-icon">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </button>
                            </div> --}}
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
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="row row-cards">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-sm table-bordered table-striped mb-0 table-hover text-nowrap"
                                                    id="table-alpa">
                                                    {{-- <thead>
                                                        <tr>
                                                            <th class="text-center"></th>
                                                            <th class="text-center">Tanggal</th>
                                                            <th class="text-center">STB</th>
                                                            <th class="text-center">Nama</th>
                                                            <th class="text-center">IN</th>
                                                            <th class="text-center">OUT</th>
                                                            <th class="text-center">Hari</th>
                                                            <th class="text-center">Libur</th>
                                                            <th class="text-center">Set. Hari</th>
                                                            <th class="text-center">Grup</th>
                                                            <th class="text-center">Bagian</th>
                                                            <th class="text-center">Jabatan</th>
                                                            <th class="text-center">Profesi</th>
                                                            <th class="text-center">SST</th>
                                                        </tr>
                                                    </thead> --}}
                                                    {{-- <tbody>
                                                        @foreach ($getalpa as $a)
                                                            <tr class="cursor-pointer">
                                                                <td class="text-center">{{ $a->idabsensi }}</td>
                                                                <td class="text-center">{{ $a->tanggal }}</td>
                                                                <td class="text-center">{{ $a->stb }}</td>
                                                                <td>{{ $a->name }}</td>
                                                                <td class="text-center">{{ $a->in }}</td>
                                                                <td class="text-center">{{ $a->out }}</td>
                                                                <td class="text-center">
                                                                    {{ strtoupper(Carbon::parse($a->tanggal)->isoFormat('dddd')) }}
                                                                </td>
                                                                <td class="text-center">{{ $a->hrlibur }}</td>
                                                                <td class="text-center">{{ $a->sethari }}</td>
                                                                <td class="text-center">{{ $a->grup }}</td>
                                                                <td class="text-center">{{ $a->bagian }}</td>
                                                                <td class="text-center">{{ $a->jabatan }}</td>
                                                                <td>{{ $a->profesi }}</td>
                                                                <td class="text-center">{{ $a->sst }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody> --}}
                                                    <tfoot>
                                                        <tr>
                                                            <th class="px-1 py-1 text-center"></th>
                                                            <th class="px-1 th py-1 text-center">Tanggal</th>
                                                            <th class="px-1 th py-1 text-center">STB</th>
                                                            <th class="px-1 th py-1 text-center">Nama</th>
                                                            <th class="px-1 th py-1 text-center">IN</th>
                                                            <th class="px-1 th py-1 text-center">OUT</th>
                                                            <th class="px-1 py-1 text-center">Hari</th>
                                                            <th class="px-1 py-1 text-center">Libur</th>
                                                            <th class="px-1 py-1 text-center">Bagian</th>
                                                            <th class="px-1 py-1 text-center">Set. Hari</th>
                                                            <th class="px-1 py-1 text-center">Grup</th>
                                                            <th class="px-1 py-1 text-center">Bagian</th>
                                                            <th class="px-1 py-1 text-center">Jabatan</th>
                                                            <th class="px-1 py-1 text-center">Profesi</th>
                                                            <th class="px-1 py-1 text-center">SST</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        {{-- <div class="fetched-data-absensi"></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.footer')
            </div>
        </div>
        {{-- Modal --}}

        <div class="modal modal-blur fade" id="modalProses" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="overlay">
                <div class="loader">
                    <span class="spinner spinner1"></span>
                    <span class="spinner spinner2"></span>
                    <span class="spinner spinner3"></span>
                    <br>
                    <span class="loader-text">MEMUAT DATA {{ Str::upper($jns) }}</span>
                </div>
            </div>
            <div class="modal-dialog modal-xl  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formProses{{ $jns }}" name="formProses{{ $jns }}" method="post"
                        action="javascript:void(0)">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Proses data {{ Str::upper($jns) }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="resultChecklist"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnProses" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Proses
                            </button>
                            <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                Tutup
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var tableAlpa;
            $(function() {
                tableAlpa = $('#table-alpa').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
                    "scrollX": false,
                    "scrollCollapse": true,
                    "pagingType": 'full_numbers',
                    "lengthMenu": [
                        [20, 25, 35, 40, 50, -1],
                        ['20', '25', '35', '40', '50', 'Tampilkan Semua']
                    ],
                    "dom": "<'card-header h3' B>" +
                        "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                        "<'table-responsive' <'col-sm-12'tr> >" +
                        "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                    "buttons": [{
                            extend: 'excelHtml5',
                            autoFilter: true,
                            className: 'btn btn-green',
                            text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i> Download Excel',
                            // action: newexportaction,
                        },
                        {
                            text: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg> Proses',
                            className: 'btn btn-indigo',
                            action: function(e, node, config) {
                                $('#modalProses').modal('show')
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
                        "select": {
                            rows: {
                                _: "%d kandidat dipilih",
                                0: "Pilih item dan tekan tombol Proses data untuk memproses Acc",
                            }
                        },
                    },
                    "ajax": {
                        "url": "{{ route('getAlphaDatatables.index') }}",
                        "data": function(data) {
                            data._token = "{{ csrf_token() }}";
                            data.dari = "{{ $dari }}";
                            data.sampai = "{{ $sampai }}";
                            data.jns = "{{ $jns }}";
                        }
                    },
                    autoWidth: true,
                    select: {
                        'style': 'multi',
                    },
                    columns: [{
                            data: 'select_orders',
                            name: 'select_orders',
                            className: 'cursor-pointer',
                            orderable: false,
                            searchable: false,
                        },
                        {
                            title: 'Tanggal',
                            data: 'tanggal',
                            name: 'tanggal',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'STB',
                            data: 'stb',
                            name: 'stb',
                            className: 'cuspad0'
                        },
                        {
                            title: 'Nama',
                            data: 'name',
                            name: 'name',
                            visible: true,
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'In',
                            data: 'in',
                            name: 'in',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Out',
                            data: 'out',
                            name: 'out',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Hari',
                            data: 'hari',
                            name: 'hari',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Libur',
                            data: 'hrlibur',
                            name: 'hrlibur',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Bagian',
                            data: 'bagian',
                            name: 'bagian',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Set.Hari',
                            data: 'sethari',
                            name: 'sethari',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Grup',
                            data: 'grup',
                            name: 'grup',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Bagian',
                            data: 'bagian',
                            name: 'bagian',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'Jabatan',
                            data: 'jabatan',
                            name: 'jabatan',
                            className: 'cuspad0'
                        },
                        {
                            title: 'Profesi',
                            data: 'profesi',
                            name: 'profesi',
                            className: 'cuspad0 text-center'
                        },
                        {
                            title: 'SST',
                            data: 'sst',
                            name: 'sst',
                            className: 'cuspad0 text-center'
                        },
                    ],
                    columnDefs: [{
                        'targets': 0,
                        "orderable": false,
                        'className': 'select-checkbox',
                        'checkboxes': {
                            'selectRow': true
                        },
                    }],
                    "initComplete": function() {
                        this.api()
                            .columns()
                            .every(function() {
                                var that = this;
                                $('input', this.footer()).on('keyup change clear', function() {
                                    if (that.search() !== this.value) {
                                        that.search(this.value).draw();
                                    }
                                });
                            });
                        this.api().columns([6, 7, 8, 9, 10, 11, 12, 13, 14]).every(function() {
                            var column = this;
                            var select = $('<select><option value="">Semua</option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });
                            column.data().unique().sort().each(function(d, j) {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>');
                            });
                        });
                    },
                    "aaSorting": [
                        [9, 'asc'],
                        [8, 'asc'],
                        [2, 'asc'],
                        [0, 'asc'],
                    ],
                });
                $('#table-alpa tfoot tr .th').each(function() {
                    var title = $(this).text();
                    $(this).html(
                        '<input type="text" class="form-control form-control-sm my-0 border border-dark" placeholder="' +
                        $(this).text() + '" />'
                    );
                });

                $('#modalProses').on('show.bs.modal', function(e) {
                    $(".overlay").fadeIn(300);
                    itemTables = [];
                    // console.log(count);

                    $.each(tableAlpa.rows('.selected').nodes(), function(index, rowId) {
                        var rows_selected = tableAlpa.rows('.selected').data();
                        itemTables.push(rows_selected[index]['idabsensi']);
                    });
                    console.log(itemTables);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //menggunakan fungsi ajax untuk pengambilan data
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('checkProses') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: itemTables,
                            jml: itemTables.length,
                            tipe: '{{ $jns }}',
                        },
                        success: function(data) {
                            $('.resultChecklist').html(data);
                        }
                    }).done(function() {
                        setTimeout(function() {
                            $(".overlay").fadeOut(300);
                        }, 500);
                    });
                });

                if ($("#formProsesf1f2").length > 0) {
                    $("#formProsesf1f2").validate({
                        submitHandler: function(form) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#btnProses').html(
                                '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                            $("#btnProses").attr("disabled", true);
                            $.ajax({
                                url: "{{ url('storedataF1') }}",
                                type: "POST",
                                data: $('#formProsesf1f2').serialize(),
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Menyimpan {{ $jns }}...',
                                        html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menyimpan data</h1>',
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    })
                                },
                                success: function(response) {
                                    console.log('Completed.');
                                    // tableAlpa.ajax.reload();
                                    if (response.status == true) {
                                        $('#btnProses').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                        );
                                        $("#btnProses").attr("disabled", false);
                                        Swal.fire({
                                            icon: "success",
                                            title: "Berhasil!",
                                            text: "Data Berhasil diubah",
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                        document.getElementById("formProsesf1f2").reset();
                                        $('#modalProses').modal('hide');
                                    } else if (response.status == false) {
                                        console.log('Error:', response);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Input',
                                            html: response.msg,
                                            showConfirmButton: true
                                        });
                                        $('#btnProses').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                        );
                                        $("#btnProses").attr("disabled", false);
                                    }
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#btnProses').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                    );
                                    $("#btnProses").attr("disabled", false);
                                }
                            });
                        }
                    })
                }
                if ($("#formProsesalpa").length > 0) {
                    $("#formProsesalpa").validate({
                        submitHandler: function(form) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#btnProses').html(
                                '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                            $("#btnProses").attr("disabled", true);
                            $.ajax({
                                url: "{{ url('storedataAlpa') }}",
                                type: "POST",
                                data: $('#formProsesalpa').serialize(),
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Menyimpan {{ $jns }}...',
                                        html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menyimpan data</h1>',
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    })
                                },
                                success: function(response) {
                                    console.log('Completed.');
                                    // tableAlpa.ajax.reload();
                                    if (response.status == true) {
                                        $('#btnProses').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                        );
                                        $("#btnProses").attr("disabled", false);
                                        Swal.fire({
                                            icon: "success",
                                            title: "Berhasil!",
                                            text: "Data Berhasil diubah",
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                        document.getElementById("formProsesalpa").reset();
                                        $('#modalProses').modal('hide');
                                    } else if (response.status == false) {
                                        console.log('Error:', response);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Input',
                                            html: response.msg,
                                            showConfirmButton: true
                                        });
                                        $('#btnProses').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                        );
                                        $("#btnProses").attr("disabled", false);
                                    }
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#btnProses').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                    );
                                    $("#btnProses").attr("disabled", false);
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
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
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
