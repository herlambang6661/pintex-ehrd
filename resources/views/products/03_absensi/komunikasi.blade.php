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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:10px"
                                    class="icon icon-tabler icon-tabler-mail-fast" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 7h3" />
                                    <path d="M3 11h2" />
                                    <path
                                        d="M9.02 8.801l-.6 6a2 2 0 0 0 1.99 2.199h7.98a2 2 0 0 0 1.99 -1.801l.6 -6a2 2 0 0 0 -1.99 -2.199h-7.98a2 2 0 0 0 -1.99 1.801z" />
                                    <path d="M9.8 7.5l2.982 3.28a3 3 0 0 0 4.238 .202l3.28 -2.982" />
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
                    <div class="row row-deck">
                        <div class="col-md-12">
                            <div class="card shadow rounded">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab-list-komunikasi" class="nav-link active" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    style="margin-right: 5px" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list text-blue">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M9 6l11 0" />
                                                    <path d="M9 12l11 0" />
                                                    <path d="M9 18l11 0" />
                                                    <path d="M5 6l0 .01" />
                                                    <path d="M5 12l0 .01" />
                                                    <path d="M5 18l0 .01" />
                                                </svg>
                                                List Surat</a>
                                        </li>
                                        @if (Auth::user()->role != 'operator')
                                            <li class="nav-item" role="presentation">
                                                <a href="#tab-acc-komunikasi" class="nav-link" data-bs-toggle="tab"
                                                    aria-selected="false" role="tab" tabindex="-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list-check text-green">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                                        <path d="M11 6l9 0" />
                                                        <path d="M11 12l9 0" />
                                                        <path d="M11 18l9 0" />
                                                    </svg>
                                                    Acc Surat Komunikasi
                                                </a>
                                            </li>
                                        @endif
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab-create-new" class="nav-link" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:5px"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-mail-plus text-purple">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                    <path d="M16 19h6" />
                                                    <path d="M19 16v6" />
                                                    <path d="M3 7l9 6l9 -6" />
                                                </svg>
                                                Buat Formulir Komunikasi</a>
                                        </li>
                                        <li class="nav-item ms-auto" role="presentation">
                                            <a href="#" class="nav-link" data-bs-toggle="modal" title="Cari STB"
                                                data-bs-target="#modal-large">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search text-teal">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                                STB
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab-list-komunikasi" role="tabpanel">
                                        <div class="card card-xl shadow rounded">
                                            <div class="table-responsive">
                                                <form action="#" id="form-filter-items" method="get"
                                                    autocomplete="off" novalidate="" class="">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Tgl Awal</th>
                                                                <th class="text-center">Tgl Akhir</th>
                                                                <th class="text-center"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="date" id="idfilter_dari"
                                                                        class="form-control" value="{{ date('Y-m-01') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="date" id="idfilter_sampai"
                                                                        class="form-control " value="{{ date('Y-m-t') }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary"
                                                                        onclick="synList()">
                                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                            <div class="table-responsive">
                                                <table style="width:100%; height: 100%;font-size:13px;"
                                                    class="table table-bordered table-striped table-vcenter card-table table-hover text-nowrap datatable datatable-list-komunikasi">
                                                    <tfoot>
                                                        <tr>
                                                            <th class="px-1 py-1 text-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                                    <path d="M21 21l-6 -6" />
                                                                </svg>
                                                            </th>
                                                            <th class="px-1 th py-1">Tgl Form</th>
                                                            <th class="px-1 th py-1">Noform</th>
                                                            <th class="px-1 th py-1">Tgl Surat</th>
                                                            <th class="px-1 th py-1">Hari</th>
                                                            <th class="px-1 th py-1">STB</th>
                                                            <th class="px-1 th py-1">Nama</th>
                                                            <th class="px-1 th py-1">Bagian</th>
                                                            <th class="px-1 th py-1">Grup</th>
                                                            <th class="px-1 th py-1">Surat</th>
                                                            <th class="px-1 th py-1">Status</th>
                                                            <th class="px-1 th py-1">Keterangan</th>
                                                            <th class="px-1 th py-1">Status Surat</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::user()->role != 'operator')
                                        <div class="tab-pane" id="tab-acc-komunikasi" role="tabpanel">
                                            <div class="table-responsive">
                                                <form action="#" id="form-filter-items" method="get"
                                                    autocomplete="off" novalidate="" class="">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Tgl Awal</th>
                                                                <th class="text-center">Tgl Akhir</th>
                                                                <th class="text-center"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="date" id="idfilter_acc_dari"
                                                                        class="form-control" value="{{ date('Y-m-01') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="date" id="idfilter_acc_sampai"
                                                                        class="form-control " value="{{ date('Y-m-t') }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary"
                                                                        onclick="synFormList()">
                                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                            <ul class="nav nav-tabs card-header-tabs mb-3 mt-3 ms-auto"
                                                data-bs-toggle="tabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a href="#tabs-form" class="btn btn-info active"
                                                        style="margin-right:10px" data-bs-toggle="tab"
                                                        aria-selected="true" role="tab">
                                                        <i class="fa-solid fa-book" style="margin-right:10px"></i>
                                                        Form</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a href="#tabs-items" class="btn btn-orange" data-bs-toggle="tab"
                                                        aria-selected="false" tabindex="-1" role="tab">
                                                        <i class="fa-solid fa-list-ul" style="margin-right:10px"></i>
                                                        Items</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="tabs-form" role="tabpanel">
                                                    <table style="width: 100%"
                                                        class="table table-striped table-bordered table-hover text-nowrap datatable-acc-komunikasi">
                                                        <tfoot>
                                                            <tr>
                                                                <th class="px-1 py-1 text-center" style="width: 1%">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list-search">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                                        <path d="M18.5 18.5l2.5 2.5" />
                                                                        <path d="M4 6h16" />
                                                                        <path d="M4 12h4" />
                                                                        <path d="M4 18h4" />
                                                                    </svg>
                                                                </th>
                                                                <th class="px-1 th py-1" style="width: 1%">Noform</th>
                                                                <th class="px-1 th py-1" style="width: 1%">Tanggal</th>
                                                                <th class="px-1 th py-1" style="width: 1%">Dibuat</th>
                                                                <th class="px-1 th py-1">List</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div class="tab-pane" id="tabs-items" role="tabpanel">
                                                    <table style="width: 100%"
                                                        class="table table-striped table-bordered table-hover text-nowrap datatable-acc-items">
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="tab-pane fade" id="tab-create-new" role="tabpanel">
                                        <div class="card card-xl shadow rounded">
                                            <div class="table-responsive">
                                                <input id="idf" value="1" type="hidden" />
                                                <div class="row row-cards">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h3 class="card-title">Pilih Surat Komunikasi</h3>
                                                                <div class="row g-2 align-items-center">
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl ">
                                                                        <a href="#"
                                                                            class="btn btn-outline-primary w-100 shadow rounded"
                                                                            onclick="tambahItem('C'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-mail-plus">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                                                <path d="M16 19h6" />
                                                                                <path d="M19 16v6" />
                                                                                <path d="M3 7l9 6l9 -6" />
                                                                            </svg>
                                                                            Surat Cuti
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl ">
                                                                        <a href="#"
                                                                            class="btn btn-outline-info w-100 shadow rounded"
                                                                            onclick="tambahItem('S'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-ambulance">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                                <path
                                                                                    d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                                <path
                                                                                    d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                                                                <path d="M6 10h4m-2 -2v4" />
                                                                            </svg>
                                                                            Surat Sakit
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl ">
                                                                        <a href="#"
                                                                            class="btn btn-outline-success w-100 shadow rounded"
                                                                            onclick="tambahItem('CK'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-bolt">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                                <path
                                                                                    d="M6 21v-2a4 4 0 0 1 4 -4h4c.267 0 .529 .026 .781 .076" />
                                                                                <path d="M19 16l-2 3h4l-2 3" />
                                                                            </svg>
                                                                            Surat Cuti Khusus
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl ">
                                                                        <a href="#"
                                                                            class="btn btn-outline-warning w-100 shadow rounded"
                                                                            onclick="tambahItem('I'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-exclamation">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                                <path
                                                                                    d="M6 21v-2a4 4 0 0 1 4 -4h4c.348 0 .686 .045 1.008 .128" />
                                                                                <path d="M19 16v3" />
                                                                                <path d="M19 22v.01" />
                                                                            </svg>
                                                                            Surat IP
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl ">
                                                                        <a href="#"
                                                                            class="btn btn-outline-secondary w-100 shadow rounded"
                                                                            onclick="tambahItem('CM'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-baby-carriage">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M8 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                                <path
                                                                                    d="M18 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                                <path
                                                                                    d="M2 5h2.5l1.632 4.897a6 6 0 0 0 5.693 4.103h2.675a5.5 5.5 0 0 0 0 -11h-.5v6" />
                                                                                <path d="M6 9h14" />
                                                                                <path d="M9 17l1 -3" />
                                                                                <path d="M16 14l1 3" />
                                                                            </svg>
                                                                            Surat Cuti Melahirkan
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2 align-items-center">
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl py-3">
                                                                        <a href="#"
                                                                            class="btn btn-outline-cyan w-100 shadow rounded"
                                                                            onclick="tambahItem('½'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                                                                <path d="M9 12h12l-3 -3" />
                                                                                <path d="M18 15l3 -3" />
                                                                            </svg>
                                                                            Surat PC
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl py-3">
                                                                        <a href="#"
                                                                            class="btn btn-outline-purple w-100 shadow rounded"
                                                                            onclick="tambahItem('L'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-mail-heart">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M10.5 19h-5.5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v4" />
                                                                                <path
                                                                                    d="M3 7l9 6l2.983 -1.989l6.017 -4.011" />
                                                                                <path
                                                                                    d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" />
                                                                            </svg>
                                                                            Surat Libur KJK
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl py-3">
                                                                        <a href="#"
                                                                            class="btn btn-outline-red w-100 shadow rounded"
                                                                            onclick="tambahItem('A'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-ban">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                                                <path d="M5.7 5.7l12.6 12.6" />
                                                                            </svg>
                                                                            Ket. Alpa
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl py-3">
                                                                        <a href="#"
                                                                            class="btn btn-outline-teal w-100 shadow rounded"
                                                                            onclick="tambahItem('GL'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-a-b-2">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M16 21h3c.81 0 1.48 -.67 1.48 -1.48l.02 -.02c0 -.82 -.69 -1.5 -1.5 -1.5h-3v3z" />
                                                                                <path
                                                                                    d="M16 15h2.5c.84 -.01 1.5 .66 1.5 1.5s-.66 1.5 -1.5 1.5h-2.5v-3z" />
                                                                                <path
                                                                                    d="M4 9v-4c0 -1.036 .895 -2 2 -2s2 .964 2 2v4" />
                                                                                <path
                                                                                    d="M2.99 11.98a9 9 0 0 0 9 9m9 -9a9 9 0 0 0 -9 -9" />
                                                                                <path d="M8 7h-4" />
                                                                            </svg>
                                                                            Geser Libur
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-6 col-sm-4 col-md-4 col-xl py-3">
                                                                        <a href="#"
                                                                            class="btn btn-outline-dark w-100 shadow rounded"
                                                                            onclick="tambahItem('H'); return false;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-a-b-2">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M16 21h3c.81 0 1.48 -.67 1.48 -1.48l.02 -.02c0 -.82 -.69 -1.5 -1.5 -1.5h-3v3z" />
                                                                                <path
                                                                                    d="M16 15h2.5c.84 -.01 1.5 .66 1.5 1.5s-.66 1.5 -1.5 1.5h-2.5v-3z" />
                                                                                <path
                                                                                    d="M4 9v-4c0 -1.036 .895 -2 2 -2s2 .964 2 2v4" />
                                                                                <path
                                                                                    d="M2.99 11.98a9 9 0 0 0 9 9m9 -9a9 9 0 0 0 -9 -9" />
                                                                                <path d="M8 7h-4" />
                                                                            </svg>
                                                                            Geser Setengah Hari
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form class="card shadow rounded" id="formKomunikasi"
                                                            name="formKomunikasi" method="post"
                                                            action="javascript:void(0)">
                                                            <div class="card-stamp card-stamp-lg">
                                                                <div class="card-stamp-icon bg-primary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-mail-plus">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5" />
                                                                        <path d="M16 19h6" />
                                                                        <path d="M19 16v6" />
                                                                        <path d="M3 7l9 6l9 -6" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row row-cards">
                                                                    <div class="col-md-3">
                                                                        <div class="">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Tanggal
                                                                                    Formulir</label>
                                                                                <input type="text" id="datepicker2"
                                                                                    class="form-control shadow rounded"
                                                                                    name="tanggalform"
                                                                                    style="border-color: black"
                                                                                    value="{{ date('Y-m-d') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Dibuat</label>
                                                                                <input type="text"
                                                                                    class="form-control shadow rounded"
                                                                                    name="dibuat"
                                                                                    style="border-color: black"
                                                                                    placeholder="User" readonly
                                                                                    value="{{ Auth::user()->name }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div class="">
                                                                            <div class="mb-3 mb-0">
                                                                                <label class="form-label">Keterangan
                                                                                    Tambahan</label>
                                                                                <div class="border-success shadow rounded">
                                                                                    <textarea class="content" name="keterangantambahan"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <table
                                                                            class="display table table-sm table-bordered text-nowrap border-dark shadow rounded"
                                                                            id="table-tambah-komunikasi"
                                                                            onkeydown="return event.key != 'Enter';">
                                                                            <thead>
                                                                                <tr class="text-center">
                                                                                    <th style="width: 50px">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="2"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                                            <path stroke="none"
                                                                                                d="M0 0h24v24H0z"
                                                                                                fill="none" />
                                                                                            <path d="M4 7l16 0" />
                                                                                            <path d="M10 11l0 6" />
                                                                                            <path d="M14 11l0 6" />
                                                                                            <path
                                                                                                d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                            <path
                                                                                                d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                                        </svg>
                                                                                    </th>
                                                                                    <th>SST</th>
                                                                                    <th>Tanggal Surat</th>
                                                                                    <th>STB</th>
                                                                                    <th>NAMA</th>
                                                                                    <th>KETERANGAN</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-end">
                                                                <button type="submit" class="btn btn-primary"
                                                                    id="btnSubmitKomunikasi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                                        <path
                                                                            d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
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
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.footer')
            </div>
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
                    <div class="form-label">Tanggal Formulir</div>
                    <div class="row">
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input type="date" class="form-control border-primary TglFormDari"
                                    value="<?= date('Y-m-01') ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input type="date" class="form-control border-primary TglFormSampai"
                                    value="<?= date('Y-m-t') ?>" />
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-label">Tanggal Surat Komunikasi</div>
                    <div class="row">
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input type="date" class="form-control border-primary ListDari"
                                    value="<?= date('Y-m-01') ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input type="date" class="form-control border-primary ListSampai"
                                    value="<?= date('Y-m-t') ?>" />
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-label">Jenis Surat Komunikasi</div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="PRIA"
                                        checked="" id="sSmp">
                                    <span class="form-check-label">Formulir Permohonan Cuti</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="WANITA"
                                        checked="" id="sSma">
                                    <span class="form-check-label">Formulir Izin Tidak Masuk Karena Sakit</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="WANITA"
                                        checked="" id="sSma">
                                    <span class="form-check-label">Keputusan Izin (IP)</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="WANITA"
                                        checked="" id="sSma">
                                    <span class="form-check-label">Keputusan Alpa</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="WANITA"
                                        checked="" id="sSma">
                                    <span class="form-check-label">Keputusan-Mgr. Libur</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input jenis_kelamin" value="WANITA"
                                        checked="" id="sSma">
                                    <span class="form-check-label">Surat Geser/Tukar Libur</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-label">Status</div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input divisi" value="HRD & GA"
                                        checked="" id="pOperator">
                                    <span class="form-check-label">PENGAJUAN</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input divisi" value="PRODUKSI"
                                        checked="" id="pPengemudi">
                                    <span class="form-check-label">KOREKSI</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input divisi" value="PRODUKSI"
                                        checked="" id="pPengemudi">
                                    <span class="form-check-label">ACC</span>
                                </label>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input divisi" value="PRODUKSI"
                                        checked="" id="pPengemudi">
                                    <span class="form-check-label">REJECT</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="button" class="btn btn-primary w-100" onclick="synList()" id="btn-filter">Filter
                            Data</button> <br>
                        <button type="button" class="btn btn-link w-100" id="btn-reset-items">Reset Saring Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal modal-blur fade" id="modal-large" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List STB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover text-nowrap datatable-karyawan">
                    </table>
                    <script>
                        let text = document.getElementById("stbText").innerHTML;
                        const copyContent = async () => {
                            try {
                                await navigator.clipboard.writeText(text);
                                console.log("Content copied to clipboard");
                                $("#modal-large").modal("hide");
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
                                    title: "STB Berhasil Disalin ke Clipboard",
                                });
                            } catch (err) {
                                console.error("Failed to copy: ", err);
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="myModalCheck" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="overlay">
            <div class="loader">
                <span class="spinner spinner1"></span>
                <span class="spinner spinner2"></span>
                <span class="spinner spinner3"></span>
                <br>
                <span class="loader-text">MEMUAT DATA</span>
            </div>
        </div>
        <div class="modal-dialog modal-full-width  modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form id="formAcc" name="formAcc" method="post" action="javascript:void(0)">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="resultChecklist"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="myModalCheckitem" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="overlay">
            <div class="loader">
                <span class="spinner spinner1"></span>
                <span class="spinner spinner2"></span>
                <span class="spinner spinner3"></span>
                <br>
                <span class="loader-text">MEMUAT DATA</span>
            </div>
        </div>
        <div class="modal-dialog modal-full-width  modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <form id="formAccItem" name="formAccItem" method="post" action="javascript:void(0)">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="resultChecklist"></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var tableKaryawan, tableKomunikasi, tableAccKomunikasi;

        function synList() {
            tableKomunikasi.ajax.reload();
        }

        function synFormList() {
            tableKomunikasi.ajax.reload();
            tableAccKomunikasi.ajax.reload();
        }

        $(function() {
            var token = $("meta[name='csrf-token']").attr("content");
            tableKaryawan = $('.datatable-karyawan').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [10, 25, 35, 40, 50],
                    ['10', '25', '35', '40', '50']
                ],
                "dom": "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-8'><'col-sm-4'p> >>",
                "language": {
                    "lengthMenu": "_MENU_",
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
                ajax: "{{ route('getKaryawan.index') }}",
                autoWidth: false,
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
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Bagian',
                        data: 'bagian',
                        name: 'bagian',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Grup',
                        data: 'grup',
                        name: 'grup',
                        className: 'cuspad0 text-center'
                    },
                ],

            });

            tableKomunikasi = $('.datatable-list-komunikasi').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [10, 25, 35, 40, 50, -1],
                    ['10', '25', '35', '40', '50', 'Tampilkan Semua']
                ],
                "dom": "<'card-header h3' B>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                buttons: [
                    // {
                    //     text: '<i class="fa-solid fa-filter" style="margin-right:5px"></i> Saring Surat Komunikasi',
                    //     className: 'btn btn-blue',
                    //     attr: {
                    //         'href': '#offcanvasEnd-lamaran',
                    //         'data-bs-toggle': 'offcanvas',
                    //         'role': 'button',
                    //         'aria-controls': 'offcanvasEnd',
                    //     }
                    // },
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn btn-green',
                        text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i> Download Excel',
                        // action: newexportaction,
                    },
                    {
                        className: 'btn btn-dark',
                        text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                        action: function(e, dt, node, config) {
                            dt.ajax.reload();
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
                },
                "ajax": {
                    "url": "{{ route('getListKomunikasi.index') }}",
                    "data": function(data) {
                        data._token = "{{ csrf_token() }}";
                        data.dari = $('#idfilter_dari').val();
                        data.sampai = $('#idfilter_sampai').val();
                    }
                },
                autoWidth: true,
                columns: [{
                        title: 'Opsi',
                        data: 'action',
                        name: 'action',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Tgl Form',
                        data: 'tanggalform',
                        name: 'tanggalform',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Noform',
                        data: 'noform',
                        name: 'noform',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Tanggal Surat',
                        data: 'tanggalKomunikasi',
                        name: 'tanggalKomunikasi',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Hari',
                        data: 'thari',
                        name: 'thari',
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
                        data: 'nama',
                        name: 'nama',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Bagian',
                        data: 'bagian',
                        name: 'bagian',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Grup',
                        data: 'grup',
                        name: 'grup',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Surat',
                        data: 'suratid',
                        name: 'suratid',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Status',
                        data: 'sst',
                        name: 'sst',
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Keterangan',
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Status Surat',
                        data: 'statussurat',
                        name: 'statussurat',
                        className: 'cuspad0 text-center'
                    },
                ],
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
                }
            });
            $('.datatable-list-komunikasi tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm my-0 border border-dark" placeholder="' +
                    $(this).text() + '" />'
                );
            });

            tableAccKomunikasi = $('.datatable-acc-komunikasi').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [10, 25, 35, 40, 50, -1],
                    ['10', '25', '35', '40', '50', 'Tampilkan Semua']
                ],

                "dom": "<'card-header h3' B>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                buttons: [

                    {
                        className: 'btn btn-dark',
                        text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                        action: function(e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn btn-green',
                        text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i> Download Excel',
                        // action: newexportaction,
                    },
                    {
                        className: 'btn btn-red',
                        text: '<i class="fa-solid fa-list-check" style="margin-right:5px"></i> Proses Surat Komunikasi',
                        action: function(e, node, config) {
                            $('#myModalCheck').modal('show')
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
                    "url": "{{ route('getAccKomunikasi.index') }}",
                    "data": function(data) {
                        data._token = "{{ csrf_token() }}";
                        data.dari = $('#idfilter_acc_dari').val();
                        data.sampai = $('#idfilter_acc_sampai').val();
                    }
                },
                autoWidth: false,
                select: {
                    'style': 'multi',
                },
                columnDefs: [{
                        'targets': 0,
                        // "orderable": false,
                        'className': 'select-checkbox',
                        'checkboxes': {
                            'selectRow': true
                        },
                    }

                ],
                columns: [{
                        data: 'select_orders',
                        name: 'select_orders',
                        // className: 'cuspad2',
                        className: 'cuspad0 text-center',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        title: 'Noform',
                        data: 'noform',
                        name: 'noform',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Tanggal',
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Dibuat',
                        data: 'dibuat',
                        name: 'dibuat',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'List',
                        data: 'list',
                        name: 'list',
                        className: 'cuspad0 text-start',
                    },
                ],
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
                    this.api().columns([3]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select form-select-sm"><option value="">Semua</option></select>'
                            )
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
                }
            });
            $('.datatable-acc-komunikasi tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                    $(this).text().toUpperCase() + '" />'
                );
            });

            tableAccItems = $('.datatable-acc-items').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "lengthMenu": [
                    [10, 25, 35, 40, 50, -1],
                    ['10', '25', '35', '40', '50', 'Tampilkan Semua']
                ],

                "dom": "<'card-header h3' B>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                buttons: [

                    {
                        text: '<i class="fa-solid fa-filter" style="margin-right:5px"></i> Saring Surat Komunikasi',
                        className: 'btn btn-blue',
                        attr: {
                            'href': '#offcanvasEnd-acc',
                            'data-bs-toggle': 'offcanvas',
                            'role': 'button',
                            'aria-controls': 'offcanvasEnd',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn btn-green',
                        text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i> Download Excel',
                        action: newexportaction,
                    },
                    {
                        className: 'btn btn-red',
                        text: '<i class="fa-solid fa-list-check" style="margin-right:5px"></i> Proses Surat Komunikasi',
                        action: function(e, node, config) {
                            $('#myModalCheckitem').modal('show')
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
                ajax: "{{ route('getAccKomunikasiitems.index') }}",
                autoWidth: false,
                select: {
                    'style': 'multi',
                },
                columnDefs: [{
                        'targets': 0,
                        // "orderable": false,
                        'className': 'select-checkbox',
                        'checkboxes': {
                            'selectRow': true
                        },
                    }

                ],
                columns: [{
                        data: 'select_orders',
                        name: 'select_orders',
                        // className: 'cuspad2',
                        className: 'cuspad0 text-center',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        title: 'Noform',
                        data: 'noform',
                        name: 'noform',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Tanggal',
                        data: 'tanggalKomunikasi',
                        name: 'tanggalKomunikasi',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Hari',
                        data: 'thari',
                        name: 'thari',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Nama',
                        data: 'nama',
                        name: 'nama',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Surat',
                        data: 'suratid',
                        name: 'suratid',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Keterangan',
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'cuspad0 text-center',
                    },
                    {
                        title: 'Status',
                        data: 'statussurat',
                        name: 'statussurat',
                        className: 'cuspad0 text-center',
                    },
                ],
            });

            /*------------------------------------------
            --------------------------------------------
            Submit Form
            --------------------------------------------
            --------------------------------------------*/

            if ($("#formKomunikasi").length > 0) {
                $("#formKomunikasi").validate({
                    rules: {
                        tanggalform: {
                            required: true,
                        },
                        dibuat: {
                            required: true,
                        },
                    },
                    messages: {
                        tanggalform: {
                            required: "Masukkan Tanggal",
                        },
                        dibuat: {
                            required: "Nama Pembuat tidak boleh kosong",
                        },
                    },

                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#btnSubmitKomunikasi').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#btnSubmitKomunikasi").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataKomunikasi') }}",
                            type: "POST",
                            data: $('#formKomunikasi').serialize(),
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
                                $('#btnSubmitKomunikasi').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /> <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /> <path d="M14 4l0 4l-6 0l0 -4" /> </svg> Simpan'
                                );
                                $("#btnSubmitKomunikasi").attr("disabled", false);
                                tableKomunikasi.ajax.reload();
                                tableAccKomunikasi.ajax.reload();
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
                                document.getElementById("formKomunikasi").reset();
                                $('#tab-list-komunikasi').addClass('active show');
                                $('#tab-create-new').removeClass('active show');
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                tableKomunikasi.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#btnSubmitKomunikasi').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /> <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /> <path d="M14 4l0 4l-6 0l0 -4" /> </svg> Simpan'
                                );
                                $("#btnSubmitKomunikasi").attr("disabled", false);
                            }
                        });
                    }
                })
            }

            if ($("#formAcc").length > 0) {
                var tipeinput = $('#suratjns').val();
                $("#formAcc").validate({
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#simpanAcc').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#simpanAcc").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataAcc') }}",
                            type: "POST",
                            data: $('#formAcc').serialize(),
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Menyimpan ' + tipeinput,
                                    html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menyimpan data</h1>',
                                    showConfirmButton: false,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                })
                            },
                            success: function(response) {
                                console.log('Completed.');
                                tableAccKomunikasi.ajax.reload();
                                if (response.status == true) {
                                    $('#simpanAcc').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses Surat Komunikasi'
                                    );
                                    $("#simpanAcc").attr("disabled", false);
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 4000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: response.msg,
                                    });
                                    document.getElementById("formAcc").reset();
                                    var sp = $('#selectEntitas').val();
                                    $('#entitas').val(sp);
                                    $('#myModalCheck').modal('hide');
                                } else if (response.status == false) {
                                    console.log('Error:', response);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: response.msg,
                                        showConfirmButton: true
                                    });
                                    $('#simpanAcc').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses Surat Komunikasi'
                                    );
                                    $("#simpanAcc").attr("disabled", false);
                                }
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
                                $('#simpanAccItem').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses Surat Komunikasi'
                                );
                                $("#simpanAccItem").attr("disabled", false);
                            }
                        });
                    }
                })
            }
            if ($("#formAccItem").length > 0) {
                var tipeinput = $('#suratjns').val();
                $("#formAccItem").validate({
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#simpanAccItem').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#simpanAccItem").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataAcc') }}",
                            type: "POST",
                            data: $('#formAccItem').serialize(),
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Menyimpan ' + tipeinput,
                                    html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menyimpan data</h1>',
                                    showConfirmButton: false,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                })
                            },
                            success: function(response) {
                                console.log('Completed.');
                                tableAccKomunikasi.ajax.reload();
                                if (response.status == true) {
                                    $('#simpanAccItem').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses Surat Komunikasi'
                                    );
                                    $("#simpanAccItem").attr("disabled", false);
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 4000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: response.msg,
                                    });
                                    document.getElementById("formAccItem").reset();
                                    var sp = $('#selectEntitas').val();
                                    $('#entitas').val(sp);
                                    $('#myModalCheck').modal('hide');
                                } else if (response.status == false) {
                                    console.log('Error:', response);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: response.msg,
                                        showConfirmButton: true
                                    });
                                    $('#simpanAccItem').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses Surat Komunikasi'
                                    );
                                    $("#simpanAccItem").attr("disabled", false);
                                }
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
                                $('#simpanAccItem').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses Surat Komunikasi'
                                );
                                $("#simpanAccItem").attr("disabled", false);
                            }
                        });
                    }
                })
            }

            $('#myModalCheck').on('show.bs.modal', function(e) {
                $(".overlay").fadeIn(300);
                itemTables = [];
                // console.log(count);

                $.each(tableAccKomunikasi.rows('.selected').nodes(), function(index, rowId) {
                    var rows_selected = tableAccKomunikasi.rows('.selected').data();
                    itemTables.push(rows_selected[index]['noform']);
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
                    url: '{{ url('checkAccKomunikasi') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: itemTables,
                        jml: itemTables.length,
                        tipe: 'form',
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
            $('#myModalCheckitem').on('show.bs.modal', function(e) {
                $(".overlay").fadeIn(300);
                itemTables = [];
                // console.log(count);

                $.each(tableAccItems.rows('.selected').nodes(), function(index, rowId) {
                    var rows_selected = tableAccItems.rows('.selected').data();
                    itemTables.push(rows_selected[index]['id']);
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
                    url: '{{ url('checkAccKomunikasi') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: itemTables,
                        jml: itemTables.length,
                        tipe: 'item',
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


            /*------------------------------------------
                --------------------------------------------
                Delete
                --------------------------------------------
                --------------------------------------------*/

            $('body').on('click', '.deletePos', function() {
                var id = $(this).data("id");
                var nama = $(this).data("nama");
                var noform = $(this).data("noform");
                var suratid = $(this).data("suratid");
                var keterangan = $(this).data("keterangan");
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    icon: 'warning',
                    title: 'Hapus Data ' + suratid,
                    text: 'Apakah anda yakin ingin menghapus ' + suratid + " : " + nama + ' ( ' +
                        keterangan + ' ) ?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('getListKomunikasi.store') }}" + '/' + id,
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
                                $('.datatable-list-komunikasi').DataTable().ajax
                                    .reload();
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter =
                                            Swal.stopTimer;
                                        toast.onmouseleave =
                                            Swal
                                            .resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: suratid + " : " +
                                        nama +
                                        " Berhasil Dihapus"
                                });
                            },
                            error: function(data) {
                                console.log('Error:', data.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Error: ' + data
                                        .responseText,
                                    showConfirmButton: true,
                                });
                            }
                        });
                    }
                });

            });
        });

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

        function findByDate() {
            var entitas = $('#selectEntitas').val();
            var dateStart = $('.tglaw').val();
            var dateEnd = $('.tglak').val();
            console.log("Fetch: " + dateStart + " -> " + dateEnd + " entitas: " + entitas);

            $(".ph-item").fadeIn(200);
            $('.fetched-data-absensi').html('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type: 'POST',
                url: "{{ url('getalphabydate') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'tglaw': dateStart,
                    'tglak': dateEnd,
                    'entitas': entitas,
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

        function tambahItem(sst) {

            var idf = document.getElementById("idf").value;
            var detail_transaksi = document.getElementById("table-tambah-komunikasi");
            var tr = document.createElement("tr");
            tr.setAttribute("id", "btn-remove-item" + idf);
            // Kolom 1 Hapus
            var td = document.createElement("td");
            td.setAttribute("align", "center");
            td.innerHTML +=
                '<a href="javascript:void(0)" class="btn btn-red w-100 h-100 btn-icon bg-red btn-sm" onclick="hapusElemen(' +
                idf +
                ');"><i class="fas fa-trash-can"></i> </a>';
            tr.appendChild(td);
            // Kolom 2 SST
            var td = document.createElement("td");
            td.setAttribute("align", "center");
            td.innerHTML += (sst == "H" ? "GS" : sst);
            td.innerHTML += '<input type="hidden" name="sst[]" value="' + sst + '">';
            td.innerHTML += '<input type="hidden" name="userid[]" id="userid' + idf + '">';
            td.innerHTML += '<input type="hidden" name="idf[]" value="' + idf + '">';
            td.innerHTML += '<input type="hidden" name="idform[]" value="' + idf + '">';
            tr.appendChild(td);
            // Kolom 3 TANGGAL
            var td = document.createElement("td");
            td.setAttribute("style", "width:250px");
            if (sst == "½" || sst == "GL" || sst == "H") {
                td.innerHTML +=
                    '<div class="row"><div class="col"><input type="date" name="tanggalitm[]" id="tanggalitm' +
                    idf +
                    '" class="form-control" value="<?= date('Y-m-d') ?>"><input type="hidden" name="tanggalitm2[]" style="width:120px" id="tanggalitm' +
                    idf +
                    '" class="form-control " value="<?= date('Y-m-d') ?>"><input type="hidden" name="totaltanggal[]" value="1"></div></div>';
            } else {
                td.innerHTML +=
                    '<div class="row"><div class="col"><input type="date" style="width:120px" name="tanggalitm[]" id="tanggalitm' +
                    idf +
                    '" class="form-control " value="<?= date('Y-m-d') ?>"></div><div class="col"><input type="date" name="tanggalitm2[]" style="width:120px" id="tanggalitm' +
                    idf +
                    '" class="form-control " value="<?= date('Y-m-d') ?>"></div></div><input type="hidden" name="totaltanggal[]" value="2">';
            }
            tr.appendChild(td);
            // Kolom 4 STB
            var td = document.createElement("td");
            td.setAttribute("style", "width:100px");
            td.innerHTML += '<input type="text" name="stb[]" id="stb' + idf +
                '" class="form-control text-center" onchange="fetchKar(' +
                idf + ', `' + sst + '`)" onkeydown = "if (event.keyCode == 13)  fetchKar(' + idf + ', `' + sst + '`)">';
            tr.appendChild(td);
            // Kolom 5 NAMA
            var td = document.createElement("td");
            td.setAttribute("style", "width:300px");
            td.innerHTML += '<input type="text" name="nama[]" id="nama' + idf + '" class="form-control" readonly>';
            tr.appendChild(td);

            // Kolom 6 KETERANGAN
            var td = document.createElement("td");
            if (sst == "C") {
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Formulir Permohonan Cuti">';
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="KEPERLUAN KELUARGA">';
            } else if (sst == "CK") {
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Permohonan Cuti Khusus">';
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="CK: ">';
            } else if (sst == "A") {
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Keputusan-Mgr. Alpa">';
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="KETERANGAN ALPA">';
            } else if (sst == "GL") {
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Surat Geser/Tukar Libur">';
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="GESER LIBUR DENGAN: ">';
            } else if (sst == "L") {
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Keputusan-Mgr. Libur">';
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="AMBIL LIBUR KJK">';
            } else if (sst == "S") {
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="">';
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Formulir Izin Tidak Masuk Karena Sakit">';
            } else if (sst == "I") {
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="">';
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Keputusan-Mgr. Izin">';
            } else if (sst == "½") {
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="">';
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Surat Izin Setengah Hari">';
            } else if (sst == "H") {
                td.innerHTML += '<input type="text" name="keterangan[]" class="form-control" value="GESER SETENGAH HARI">';
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Surat Geser Setengah Hari">';
            } else if (sst == "CM") {
                td.innerHTML +=
                    '<input type="text" name="keterangan[]" class="form-control" value="SURAT CUTI MELAHIRKAN">';
                td.innerHTML += '<input type="hidden" name="suratid[]" value="Surat Cuti Melahirkan">';
            }
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
            console.log(stb);
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
                    // 'entitas': entitas,
                },
                success: function(data) {
                    if (data.success = 'Data Ditemukan') {
                        if (sst == "C") {
                            var finalcuti = data.sisacuti - data.cutidikomunikasi;
                            console.log("Sisa Cuti: " + finalcuti + " ( " + data.sisacuti + " - " + data
                                .cutidikomunikasi + " )")
                            if (finalcuti > 0) {
                                $('#nama' + params).attr("readonly", true);
                                $('#nama' + params).val(data.result);
                                $('#userid' + params).val(data.userid);
                            } else {
                                // alert("Karyawan tidak memiliki cuti");
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tidak dapat di proses',
                                    html: data.result + ' tidak memiliki cuti',
                                    showConfirmButton: true
                                });
                                $('#stb' + params).val('');
                                $('#nama' + params).val('');
                                $('#userid' + params).val('');
                            }
                        } else {
                            $('#nama' + params).attr("readonly", true);
                            $('#nama' + params).val(data.result);
                            $('#userid' + params).val(data.userid);
                        }
                    } else {
                        $('#nama' + params).attr("readonly", true);
                        $('#nama' + params).val(data.error);
                    }
                    console.log(data);
                    // $('#nama' + params).html(data);
                },
                error: function(data) {
                    console.log(data);
                    $('#nama' + params).attr("readonly", false);
                    $('#nama' + params).val('STB Tdk Ditemukan');
                }
            })
        }

        $('.content').richText({

            // text formatting
            bold: true,
            italic: true,
            underline: true,

            // text alignment
            leftAlign: true,
            centerAlign: true,
            rightAlign: true,
            justify: true,

            // lists
            ol: true,
            ul: true,

            // title
            heading: true,

            // fonts
            fonts: true,
            fontList: ["Arial",
                "Arial Black",
                "Comic Sans MS",
                "Courier New",
                "Geneva",
                "Georgia",
                "Helvetica",
                "Impact",
                "Lucida Console",
                "Tahoma",
                "Times New Roman",
                "Verdana"
            ],
            fontColor: true,
            backgroundColor: false,
            fontSize: true,

            // uploads
            imageUpload: false,
            fileUpload: false,


            // link
            urls: false,

            // tables
            table: true,

            // code
            removeStyles: false,
            code: false,

            // colors
            colors: [],

            // dropdowns
            fileHTML: '',
            imageHTML: '',

            // translations
            translations: {
                'title': 'Title',
                'white': 'White',
                'black': 'Black',
                'brown': 'Brown',
                'beige': 'Beige',
                'darkBlue': 'Dark Blue',
                'blue': 'Blue',
                'lightBlue': 'Light Blue',
                'darkRed': 'Dark Red',
                'red': 'Red',
                'darkGreen': 'Dark Green',
                'green': 'Green',
                'purple': 'Purple',
                'darkTurquois': 'Dark Turquois',
                'turquois': 'Turquois',
                'darkOrange': 'Dark Orange',
                'orange': 'Orange',
                'yellow': 'Yellow',
                'imageURL': 'Image URL',
                'fileURL': 'File URL',
                'linkText': 'Link text',
                'url': 'URL',
                'size': 'Size',
                'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
                'text': 'Text',
                'openIn': 'Open in',
                'sameTab': 'Same tab',
                'newTab': 'New tab',
                'align': 'Align',
                'left': 'Left',
                'justify': 'Justify',
                'center': 'Center',
                'right': 'Right',
                'rows': 'Rows',
                'columns': 'Columns',
                'add': 'Add',
                'pleaseEnterURL': 'Please enter an URL',
                'videoURLnotSupported': 'Video URL not supported',
                'pleaseSelectImage': 'Please select an image',
                'pleaseSelectFile': 'Please select a file',
                'bold': 'Bold',
                'italic': 'Italic',
                'underline': 'Underline',
                'alignLeft': 'Align left',
                'alignCenter': 'Align centered',
                'alignRight': 'Align right',
                'addOrderedList': 'Ordered list',
                'addUnorderedList': 'Unordered list',
                'addHeading': 'Heading/title',
                'addFont': 'Font',
                'addFontColor': 'Font color',
                'addBackgroundColor': 'Background color',
                'addFontSize': 'Font size',
                'addImage': 'Add image',
                'addVideo': 'Add video',
                'addFile': 'Add file',
                'addURL': 'Add URL',
                'addTable': 'Add table',
                'removeStyles': 'Remove styles',
                'code': 'Show HTML code',
                'undo': 'Undo',
                'redo': 'Redo',
                'save': 'Save',
                'close': 'Close'
            },

            // privacy
            youtubeCookies: false,

            // preview
            preview: false,

            // placeholder
            placeholder: 'Keterangan tambahan bila diperlukan',

            // dev settings
            useSingleQuotes: false,
            height: 150,
            heightPercentage: 0,
            adaptiveHeight: false,
            id: "",
            class: "",
            useParagraph: false,
            maxlength: 0,
            maxlengthIncludeHTML: false,
            callback: undefined,
            useTabForNext: false,
            save: false,
            saveCallback: undefined,
            saveOnBlur: 0,
            undoRedo: true

        });
    </script>
@endsection
