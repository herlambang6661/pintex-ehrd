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

        .cv-spinner {
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                                    <path d="M10 16h6" />
                                    <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M4 8h3" />
                                    <path d="M4 12h3" />
                                    <path d="M4 16h3" />
                                </svg>
                                Legalitas
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i>
                                            Penerimaan</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('penerimaan/legalitas') }}"><i
                                                class="fa-solid fa-file-signature"></i>
                                            Legalitas</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-solid fa-envelope-open-text"></i> Upload Massal Legalitas</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        {{-- <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <ul class="nav">
                                    <a href="#tabs-ol" class="nav-link btn bg-dark text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab" style="margin-right: 5px"
                                        aria-label="Orientasi Lapangan">
                                        <i class="fa-solid fa-person-chalkboard"></i>
                                        OL
                                    </a>
                                    <a href="#tabs-phl" class="nav-link btn bg-blue text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab" style="margin-right: 5px">
                                        <i class="fa-solid fa-people-arrows"></i>
                                        PHL
                                    </a>
                                    <a href="#tabs-karyawan"
                                        class="active nav-link btn bg-green text-white d-none d-sm-inline-block"
                                        data-bs-toggle="tab" aria-selected="true" role="tab">
                                        <i class="fa-solid fa-users-viewfinder"></i>
                                        Karyawan
                                    </a>
                                    <a href="#tabs-ol" class="btn btn-secondary d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="Orientasi Lapangan"
                                        style="margin-right: 3px">
                                        <i class="fa-solid fa-person-chalkboard"></i>
                                    </a>
                                    <a href="#tabs-phl" class="btn btn-info d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="PHL" style="margin-right: 3px">
                                        <i class="fa-solid fa-people-arrows"></i>
                                    </a>
                                    <a href="#tabs-karyawan" class="btn btn-blue d-sm-none btn-icon" data-bs-toggle="tab"
                                        aria-selected="true" role="tab" aria-label="Karyawan">
                                        <i class="fa-solid fa-users-viewfinder"></i>
                                    </a>
                                </ul>

                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="tab-content">
                            {{-- Tab Karyawan --}}
                            <div class="tab-pane fade active show" id="tabs-karyawan" role="tabpanel">
                                <div class="card card-xl border-blue shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="form-label">Pilih File yang akan di upload
                                                    <a href="{{ url('export_excel_legalitas') }}">
                                                        <i>( Download file contoh )</i>
                                                    </a>
                                                </div>
                                                <div class="input-group">
                                                    <input type="file" name="file" required="required"
                                                        class="form-control" accept=".xl*">
                                                    <button type="submit" class="btn btn-primary">Upload Excel</button>
                                                </div>
                                                <small class="form-hint">Files Supported: XLS, XLSX.</small>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <table
                                                    class="table table-sm table-striped table-bordered table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <td>No</td>
                                                            <td>Jenis</td>
                                                            <td>STB</td>
                                                            <td>NAMA</td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-karyawan"
                                        id="tblamaran">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Opsi</th>
                                                <th>Masuk</th>
                                                <th>STB</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Gender</th>
                                                <th>Sidik Jari</th>
                                                <th>Status</th>
                                                <th>No Map</th>
                                                <th>Bagian</th>
                                                <th>Grup</th>
                                                <th>Profesi</th>
                                                <th>Pendidikan</th>
                                                <th>Jurusan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table> --}}
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
            <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Wawancara</h2>
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
                    <div class="form-label">Tanggal Penginputan</div>
                    <div class="row">
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input name="dari" class="form-control border-primary" placeholder="Select a date"
                                    id="datepicker0" value="<?= date('Y-01-01') ?>" />
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-icon mb-2">
                                <input name="sampai" class="form-control border-primary" placeholder="Select a date"
                                    id="datepicker1" value="<?= date('Y-12-31') ?>" />
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
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
    {{-- Modal View --}}
    <div class="modal modal-blur fade" id="viewKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form id="formCheckWawancara" name="formCheckWawancara" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-user" style="margin-right: 5px"></i> Detail
                            Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-karyawan"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitCheck" class="btn btn-green"><i class="fas fa-save"
                                style="margin-right: 5px"></i> Proses</button>
                        <button type="button" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal"><i
                                class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</button>
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

        $(function() {
            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Create Data
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/

        });
    </script>
@endsection
