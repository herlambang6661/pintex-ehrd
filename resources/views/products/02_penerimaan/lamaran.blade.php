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
            min-width: 25px;
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

        .small-swal {
            width: 300px !important;
            /* Sesuaikan ukuran modal */
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-text"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12h6" />
                                    <path d="M9 16h6" />
                                </svg>
                                Lamaran
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i>
                                            Penerimaan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-regular fa-paste"></i> Lamaran</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#modal-lamaran" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <i class="fa-solid fa-user-plus"></i>
                                    Tambah Lamaran
                                </a>
                                <a href="#" class="btn btn-green d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#importExcel" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <i class="fa-regular fa-file-excel"></i>
                                    Upload Excel
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#modal-lamaran" aria-label="Tambah Lamaran">
                                    <i class="fa-solid fa-user-plus"></i>
                                </a>
                                <a href="#" class="btn btn-green d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#modal-upload" aria-label="Upload Excel">
                                    <i class="fa-regular fa-file-excel"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card card-xl border-success shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-success">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <form action="#" id="form-filter-lamaran" method="get" autocomplete="off"
                                        novalidate="" class="">
                                        <table class="mt-3 ms-3 mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal Awal</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>Status Wawancara</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="date" class="form-control tglaw"
                                                            value="{{ date('Y-m-01') }}">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control tglak"
                                                            value="{{ date('Y-m-d') }}">
                                                    </td>
                                                    <td>
                                                        <select class="form-select wawancara">
                                                            <option value="0">Belum</option>
                                                            <option value="1">Sudah</option>
                                                            <option value="">Semua</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" onclick="syn();">
                                                            <i
                                                                class="fa-solid fa-magnifying-glass"style="margin-right:5px"></i>
                                                            Perbarui
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-lamaran"
                                        id="tblamaran">
                                        <tfoot>
                                            <tr>
                                                <th class="px-1 py-1 text-center"> </th>
                                                <th class="px-1 py-1 text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                </th>
                                                <th class="px-1 th py-1">Nama Kandidat</th>
                                                <th class="px-1 th py-1">Tgl Input</th>
                                                <th class="px-1 th py-1">Nik Ktp</th>
                                                <th class="px-1 th py-1">Gender</th>
                                                <th class="px-1 th py-1">Tempat & Tanggal Lahir</th>
                                                <th class="px-1 th py-1">Usia</th>
                                                <th class="px-1 th py-1">Pendidikan</th>
                                                <th class="px-1 th py-1">Jurusan</th>
                                                <th class="px-1 th py-1">Tinggi</th>
                                                <th class="px-1 th py-1">Berat</th>
                                                <th class="px-1 th py-1">No. Telepon</th>
                                                <th class="px-1 th py-1">Email</th>
                                                <th class="px-1 th py-1">Posisi Dituju</th>
                                                <th class="px-1 th py-1">Keterangan</th>
                                                <th class="px-1 th py-1">Alamat</th>
                                                <th class="px-1 th py-1">Wawancara</th>
                                            </tr>
                                        </tfoot>
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
    {{-- Modal tambah lamaran --}}
    <div class="modal modal-blur fade" id="modal-lamaran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fa-solid fa-user-plus"></i> Buat Data Lamaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formLamaran" name="formLamaran" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-body">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Entitas</label>
                            <input type="text" class="form-control border border-dark bg-secondary-lt" name="entitas"
                                id="entitas" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control border border-dark" name="nama" id="nama"
                                placeholder="Masukkan Nama Kandidat">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NIK KTP</label>
                                    <input type="text" class="form-control border border-dark" name="nik"
                                        id="nik" placeholder="Masukkan NIK KTP kandidat">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select border-dark">
                                        <option value="" hidden>-- Pilih Gender --</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tempat</label>
                                    <input type="text" class="form-control border border-dark" name="tempat"
                                        id="tempat" placeholder="Masukkan tempat tinggal kandidat">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir <small><i>(Format:
                                                YYYY-MM-DD)</i></small></label>
                                    <input name="tanggallahir" class="form-select border-dark" placeholder="YYYY-MM-DD"
                                        id="datepicker0" />
                                    {{-- <div class="input-icon mb-2">
                                                <span class="input-icon-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                                                </span>
                                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pendidikan</label>
                                    <select name="pendidikan" id="pendidikan" class="form-select border-dark">
                                        <option value="" hidden>-- Pilih Pendidikan --</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="SMK">SMK</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jurusan</label>
                                    <input type="text" class="form-control border border-dark" name="jurusan"
                                        id="jurusan" placeholder="Masukkan Jurusan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" class="form-control border border-dark" name="alamat"
                                        id="alamat" placeholder="Masukkan Alamat">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Agama</label>
                                    <select name="agama" id="agama" class="form-select border-dark">
                                        <option value="" hidden>-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label class="form-label">Tinggi</label>
                                            <input type="number" min="140" class="form-control border border-dark"
                                                name="tinggi" id="tinggi" placeholder="Tinggi badan">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Berat</label>
                                            <input type="number" min="20" class="form-control border border-dark"
                                                name="berat" id="berat" placeholder="Berat badan">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control border border-dark" name="notlp"
                                                id="notlp" placeholder="No Telp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Posisi Yang Dituju</label>
                                    <select name="posisi" id="posisi" class="form-select border-dark">
                                        <option value="" hidden>-- Pilih Posisi --</option>
                                        <option value="Akunting">Akunting</option>
                                        <option value="Administrasi">Administrasi</option>
                                        <option value="Keamanan">Keamanan</option>
                                        <option value="Keuangan">Keuangan</option>
                                        <option value="Kepala Bagian">Kepala Bagian</option>
                                        <option value="HRD">HRD</option>
                                        <option value="IT">IT</option>
                                        <option value="Operator">Operator</option>
                                        <option value="Pengemudi">Pengemudi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control border border-dark" name="email"
                                            id="email" placeholder="Email Kandidat">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input class="form-check-input" id="reff" type="checkbox">
                                <span class="form-check-label">Tambah Keterangan / Referensi Bawaan</span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <div class="col-lg-12">
                                <textarea name="keterangan" id="keterangan" cols="90" rows="2" class="form-control border border-dark"
                                    disabled></textarea>
                            </div>
                        </div>
                        <script>
                            var checkboxes = $("#reff"),
                                keterangan = $("#keterangan");
                            checkboxes.click(function() {
                                keterangan.attr("disabled", !checkboxes.is(":checked"));
                                if (this.checked) {
                                    keterangan.val("", !checkboxes.is(":checked"));
                                } else {
                                    keterangan.val("", !checkboxes.is(":checked"));
                                }
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i
                                class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                        <button type="submit" id="submitLamaran" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
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
    {{-- Modal Check --}}
    <div class="modal modal-blur fade" id="myModalCheck" tabindex="-1" role="dialog" aria-hidden="true">
        <style>
            .overlay {
                position: fixed;
                top: 0;
                z-index: 100;
                width: 100%;
                height: 100%;
                display: none;
                background: rgba(0, 0, 0, 0.6);
            }

            .overlay2 {
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
                        <h5 class="modal-title"><i class="fa-solid fa-user-check" style="margin-right: 5px"></i> Proses
                            Kandidat ke Wawancara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-pembelian-checklist"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-green" id="submitCheck">
                            <i class="fa-brands fa-whatsapp" style="margin-right: 5px"></i>
                            Proses dan Kirim WhatsApp
                        </button>
                        <button type="submit" class="btn btn-blue" id="submitChecktanpakirim">
                            <i class="fa-solid fa-paper-plane" style="margin-right: 5px"></i>
                            Proses tanpa Kirim WhatsApp
                        </button>
                        <button type="button" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal"><i
                                class="fa-solid fa-fw fa-arrow-rotate-left"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Excel --}}
    <div class="modal modal-blur fade" id="importExcel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/testkapas/import_excel" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Pilih file excel (xlsx)</label>
                            <input type="file" name="file" required="required"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('export_excel_lamaran') }}" class="btn btn-link link-secondary">Download Contoh
                            Excel</a>
                        <button type="submit" class="btn btn-primary ms-auto"><i class="fa-solid fa-cloud-arrow-up"
                                style="margin-right:5px"></i> Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Modal Filter --}}
    <div class="offcanvas offcanvas-blur offcanvas-end" tabindex="-1" id="offcanvasEnd-lamaran"
        aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasEndLabel">Saring Data Lamaran</h2>
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
                                    id="datepicker1" value="<?= date('Y-01-01') ?>" />
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
                                    id="datepicker2" value="<?= date('Y-12-31') ?>" />
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
    <div class="modal modal-blur fade" id="modal-view" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="overlay2">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Lamaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-lamaran"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                                class="fa-solid fa-arrow-rotate-left" style="margin-right:5px"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal View Foto --}}
    <div class="modal modal-blur fade" id="modal-view-foto" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="overlay2">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="javascript:void(0)" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Dokumen Kandidat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-foto"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                                class="fa-solid fa-arrow-rotate-left" style="margin-right:5px"></i> Close</button>
                    </div>
                </form>
            </div>
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

        var tableLamaran;

        function syn() {
            tableLamaran.ajax.reload();
        }

        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/

            tableLamaran = $('.datatable-lamaran').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": false, //Feature control DataTables' server-side processing mode.
                "scrollX": false,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "dom": "<'card-header h3' B>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-8'i><'col-sm-4'p> >>",
                buttons: [{
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn btn-success',
                        text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i> Download Excel',
                        action: newexportaction,
                    },
                    {
                        className: 'btn btn-dark',
                        text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                        action: function(e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    },
                    {
                        className: 'btn btn-pink',
                        text: '<i class="fa-solid fa-check-to-slot"></i> Proses Wawancara',
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
                            0: "Pilih item dan tekan tombol Proses data untuk memproses Wawancara",
                        }
                    },
                },
                "ajax": {
                    "url": "{{ route('getLamaran.index') }}",
                    "data": function(data) {
                        data._token = "{{ csrf_token() }}";
                        data.dari = $('.tglaw').val();
                        data.sampai = $('.tglak').val();
                        data.wawancara = $('.wawancara').val();
                        // console.log("mencari data dari " + data.dari + " sampai " + data.sampai);
                    }
                },
                columnDefs: [{
                        'targets': 0,
                        "orderable": false,
                        'className': 'select-checkbox',
                        'checkboxes': {
                            'selectRow': true
                        },
                    }

                ],
                select: {
                    'style': 'multi',
                    "selector": 'td:not(:nth-child(2), :nth-child(17),:nth-child(18),:nth-child(19),:nth-child(20),:nth-child(21),:nth-child(22),:nth-child(23),:nth-child(24),:nth-child(25),:nth-child(26),:nth-child(27))',
                },
                //Set column definition initialisation properties.
                "fixedColumns": {
                    left: 3,
                    right: 0,
                },
                autoWidth: true,
                columns: [{
                        data: 'select_orders',
                        name: 'select_orders',
                        className: 'cursor-pointer',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        title: 'Opsi',
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'cuspad0 text-center'
                    },
                    {
                        title: 'Nama Kandidat',
                        data: 'nama',
                        name: 'nama',
                        className: 'cuspad0 cursor-pointer'
                    },
                    {
                        title: 'Tgl Input',
                        data: 'tglinput',
                        name: 'tglinput',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'NIK KTP',
                        data: 'nik',
                        name: 'nik',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Gender',
                        data: 'gender',
                        name: 'gender',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Tempat & Tanggal Lahir',
                        data: 'ttl',
                        name: 'ttl',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Usia',
                        data: 'umur',
                        name: 'umur',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Pendidikan',
                        data: 'pendidikan',
                        name: 'pendidikan',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Jurusan',
                        data: 'jurusan',
                        name: 'jurusan',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Tinggi',
                        data: 'tinggi',
                        name: 'tinggi',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Berat',
                        data: 'berat',
                        name: 'berat',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'No. Telepon',
                        data: 'notlp',
                        name: 'notlp',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Email',
                        data: 'email',
                        name: 'email',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Posisi Dituju',
                        data: 'posisi',
                        name: 'posisi',
                        className: 'cuspad0 text-center cursor-pointer'
                    },
                    {
                        title: 'Keterangan',
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Alamat',
                        data: 'alamat',
                        name: 'alamat',
                        className: 'cuspad0'
                    },
                    {
                        title: 'Wawancara',
                        data: 'status',
                        name: 'status',
                        className: 'cuspad0 text-center cursor-pointer'
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
                    // this.api().columns([5, 8, 9, 14]).every(function() {
                    //     var column = this;
                    //     var select = $('<select><option value="">Semua</option></select>')
                    //         .appendTo($(column.footer()).empty())
                    //         .on('change', function() {
                    //             var val = $.fn.dataTable.util.escapeRegex(
                    //                 $(this).val()
                    //             );
                    //             column
                    //                 .search(val ? '^' + val + '$' : '', true, false)
                    //                 .draw();
                    //         });
                    //     column.data().unique().sort().each(function(d, j) {
                    //         select.append('<option value="' + d + '">' + d +
                    //             '</option>');
                    //     });
                    // });
                }
            });
            $('.datatable-lamaran tfoot .th').each(function() {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control form-control-sm my-0 border border-dark" placeholder="' +
                    $(this).text() + '" />'
                );
            });

            var selected = new Array();

            $('#myModalCheck').on('show.bs.modal', function(e) {
                $(".overlay").fadeIn(300);
                itemTables = [];
                // console.log(count);

                $.each(tableLamaran.rows('.selected').nodes(), function(index, rowId) {
                    var rows_selected = tableLamaran.rows('.selected').data();
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
                    url: '{{ url('checkLamaran') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: itemTables,
                        jml: itemTables.length,
                    },
                    success: function(data) {
                        $('.fetched-data-pembelian-checklist').html(
                            data); //menampilkan data ke dalam modal
                        // alert(itemTables);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });

            $('#modal-view').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                console.log(rowid);
                $(".overlay2").fadeIn(300);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: '{{ url('listLamaran') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: rowid,
                    },
                    success: function(data) {
                        $('.fetched-data-lamaran').html(data); //menampilkan data ke dalam modal
                        // alert(itemTables);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay2").fadeOut(300);
                    }, 500);
                });
            });

            $('#modal-view-foto').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                console.log(rowid);
                $(".overlay2").fadeIn(300);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: '{{ url('viewFoto') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: rowid,
                    },
                    success: function(data) {
                        $('.fetched-data-foto').html(data); //menampilkan data ke dalam modal
                        // alert(itemTables);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay2").fadeOut(300);
                    }, 500);
                });
            });
            /*------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================
            Create Data
            --------------------------------------------==============================================================================================================================================================
            --------------------------------------------==============================================================================================================================================================*/
            if ($("#formLamaran").length > 0) {
                $("#formLamaran").validate({
                    rules: {
                        entitas: {
                            required: true,
                        },
                        nama: {
                            required: true,
                        },
                        nik: {
                            required: true,
                        },
                        gender: {
                            required: true,
                        },
                        tempat: {
                            required: true,
                        },
                        tanggallahir: {
                            required: true,
                        },
                        pendidikan: {
                            required: true,
                        },
                        jurusan: {
                            required: true,
                        },
                        alamat: {
                            required: true,
                        },
                        agama: {
                            required: true,
                        },
                        tinggi: {
                            required: true,
                        },
                        berat: {
                            required: true,
                        },
                        notlp: {
                            required: true,
                        },
                        posisi: {
                            required: true,
                        },
                    },
                    messages: {
                        entitas: {
                            required: "Masukkan Entitas",
                        },
                        nama: {
                            required: "Masukkan Nama Kandidat",
                        },
                        nik: {
                            required: "Masukkan NIK KTP",
                        },
                        gender: {
                            required: "Masukkan Gender Kandidat",
                        },
                        tempat: {
                            required: "Masukkan tempat tinggal",
                        },
                        tanggallahir: {
                            required: "Masukkan tanggal lahir",
                        },
                        pendidikan: {
                            required: "Masukkan pendidikan",
                        },
                        jurusan: {
                            required: "Masukkan jurusan",
                        },
                        alamat: {
                            required: "Masukkan alamat",
                        },
                        agama: {
                            required: "Masukkan agama",
                        },
                        tinggi: {
                            required: "Masukkan tinggi",
                        },
                        berat: {
                            required: "Masukkan berat",
                        },
                        notlp: {
                            required: "Masukkan nomor telepon",
                        },
                        posisi: {
                            required: "Masukkan posisi dituju",
                        },
                    },

                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submitLamaran').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitLamaran").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataLamaran') }}",
                            type: "POST",
                            data: $('#formLamaran').serialize(),
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
                                $('#submitLamaran').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitLamaran").attr("disabled", false);
                                tableLamaran.ajax.reload();
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
                                document.getElementById("formLamaran").reset();
                                var sp = $('#selectEntitas').val();
                                $('#entitas').val(sp);
                                $('#modal-lamaran').modal('hide');
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                tableLamaran.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submitLamaran').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitLamaran").attr("disabled", false);
                            }
                        });
                    }
                })
            }


            $('#submitCheck').on('click', function(e) {
                // e.preventDefault();

                if ($("#formCheckWawancara").length > 0) {
                    $("#formCheckWawancara").validate({
                        rules: {
                            tglwawancara: {
                                required: true,
                            },
                            jamwawancara: {
                                required: true,
                            },
                            posisi: {
                                required: true,
                            },
                            catatan: {
                                required: true,
                            },
                        },
                        messages: {
                            tglwawancara: {
                                required: "Masukkan Tanggal Wawancara",
                            },
                            jamwawancara: {
                                required: "Masukkan Jam Wawancara",
                            },
                            posisi: {
                                required: "Masukkan Posisi",
                            },
                            catatan: {
                                required: "Masukkan Catatan Tambahan",
                            }
                        },
                        submitHandler: function(form) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                }
                            });
                            $('#submitCheck').html(
                                '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Memproses Data...'
                            );
                            $("#submitCheck").attr("disabled", true);
                            $.ajax({
                                url: "{{ route('proseswwn') }}",
                                type: "POST",
                                data: $('#formCheckWawancara').serialize(),
                                beforeSend: function() {
                                    console.log($('#formCheckWawancara')
                                        .serialize());
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
                                    $('#submitCheck').html(
                                        '<i class="fa-brands fa-whatsapp" style="margin-right: 5px"></i>Proses dan Kirim WhatsApp'
                                    );
                                    $("#submitCheck").attr("disabled",
                                        false);
                                    tableLamaran.ajax.reload();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 4000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal
                                                .stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: response.msg,
                                    });
                                    document.getElementById("formCheckWawancara")
                                        .reset();
                                    $('#myModalCheck').modal('hide');
                                    // window.open('printLamaran/' + response.val,
                                    //     '_blank');
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    // const obj = JSON.parse(data.responseJSON);
                                    tableLamaran.ajax.reload();
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#submitCheck').html(
                                        '<i class="fa-brands fa-whatsapp" style="margin-right: 5px"></i>Proses dan Kirim WhatsApp'
                                    );
                                    $("#submitCheck").attr("disabled",
                                        false);
                                }
                            });
                        }
                    })
                }
                // var selectedData = tableLamaran.rows({
                //     selected: true
                // }).data();
                // var selectedCandidates = [];

                // selectedData.each(function(value) {
                //     selectedCandidates.push({
                //         id: value.id,
                //         notlp: value.notlp,
                //         name: value.nama
                //     });
                // });

                // if (selectedCandidates.length > 0) {
                //     var tglwawancara = $('input[name="tglwawancara"]').val();
                //     var jamwawancara = $('input[name="jamwawancara"]').val();
                //     var posisi = $('input[name="posisi"]').val();
                //     var catatan = $('textarea[name="catatan"]').val();

                //     $.ajax({
                //         url: "{{ route('proseswwn') }}",
                //         method: 'POST',
                //         data: {
                //             _token: "{{ csrf_token() }}",
                //             candidates: selectedCandidates,
                //             tglwawancara: tglwawancara,
                //             jamwawancara: jamwawancara,
                //             posisi: posisi,
                //             catatan: catatan
                //         },
                //         success: function(response) {
                //             Swal.fire({
                //                 icon: 'success',
                //                 title: 'Berhasil!',
                //                 text: 'Proses wawancara berhasil dilakukan dan pesan WhatsApp sudah dikirim.',
                //                 position: 'top-end',
                //                 showConfirmButton: false,
                //                 timer: 3000,
                //                 customClass: {
                //                     popup: 'small-swal'
                //                 },
                //             }).then(() => {
                //                 tableLamaran.ajax.reload();
                //                 $('#myModalCheck').modal(
                //                     'hide');
                //             });
                //         },
                //         error: function(xhr, status, error) {
                //             console.error(xhr.responseText);
                //             console.error(error);
                //             console.error(status);
                //             Swal.fire({
                //                 icon: 'error',
                //                 title: 'Gagal!',
                //                 text: 'Terjadi kesalahan saat memproses wawancara.',
                //                 position: 'top-end',
                //                 showConfirmButton: false,
                //                 timer: 3000,
                //                 customClass: {
                //                     popup: 'small-swal'
                //                 },
                //             }).then(() => {
                //                 $('#submitCheck').html(
                //                     '<i class="fas fa-save" style="margin-right: 5px"></i> Proses'
                //                 ).prop('disabled',
                //                     false);
                //             });
                //         }
                //     });
                // } else {
                //     alert('Tidak ada kandidat yang dipilih.');
                // }
            });

            $('#submitChecktanpakirim').on('click', function(e) {
                // e.preventDefault();

                if ($("#formCheckWawancara").length > 0) {
                    $("#formCheckWawancara").validate({
                        rules: {
                            tglwawancara: {
                                required: true,
                            },
                            jamwawancara: {
                                required: true,
                            },
                            posisi: {
                                required: true,
                            },
                            catatan: {
                                required: true,
                            },
                        },
                        messages: {
                            tglwawancara: {
                                required: "Masukkan Tanggal Wawancara",
                            },
                            jamwawancara: {
                                required: "Masukkan Jam Wawancara",
                            },
                            posisi: {
                                required: "Masukkan Posisi",
                            },
                            catatan: {
                                required: "Masukkan Catatan Tambahan",
                            }
                        },
                        submitHandler: function(form) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                }
                            });
                            $('#submitChecktanpakirim').html(
                                '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Memproses Data...'
                            );
                            $("#submitChecktanpakirim").attr("disabled", true);
                            $.ajax({
                                url: "{{ url('storeChecklistLamaran') }}",
                                type: "POST",
                                data: $('#formCheckWawancara').serialize(),
                                beforeSend: function() {
                                    console.log($('#formCheckWawancara')
                                        .serialize());
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
                                    $('#submitChecktanpakirim').html(
                                        '<i class="fa-solid fa-paper-plane" style="margin-right: 5px"></i> Proses tanpa Kirim WhatsApp'
                                    );
                                    $("#submitChecktanpakirim").attr("disabled",
                                        false);
                                    tableLamaran.ajax.reload();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 4000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal
                                                .stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: response.msg,
                                    });
                                    document.getElementById("formCheckWawancara")
                                        .reset();
                                    $('#myModalCheck').modal('hide');
                                    // window.open('printLamaran/' + response.val,
                                    //     '_blank');
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    // const obj = JSON.parse(data.responseJSON);
                                    tableLamaran.ajax.reload();
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#submitChecktanpakirim').html(
                                        '<i class="fa-solid fa-paper-plane" style="margin-right: 5px"></i>Proses tanpa Kirim WhatsApp'
                                    );
                                    $("#submitChecktanpakirim").attr("disabled",
                                        false);
                                }
                            });
                        }
                    })
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Delete
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteLamaran', function() {
                var contract_id = $(this).data("id");
                var nama = $(this).data("nama");
                var wwc = $(this).data("wawancara");
                var token = $("meta[name='csrf-token']").attr("content");
                let r = (Math.random() + 1).toString(36).substring(2);
                if (wwc == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Hapus Data Lamaran',
                        text: 'Apakah anda yakin ingin menghapus ' + nama + ' ?',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            (async () => {
                                const {
                                    value: password
                                } = await Swal.fire({
                                    title: "Ketik tulisan dibawah untuk menghapus",
                                    html: '<div class="unselectable">' + r +
                                        '</div>',
                                    input: "text",
                                    // inputLabel: '<div class="unselectable">'+r+'</div>',
                                    inputPlaceholder: "Enter your password",
                                    showCancelButton: true,
                                    cancelButtonColor: '#3085d6',
                                    cancelButtonText: 'Batal',
                                    confirmButtonText: 'Ok',
                                    inputAttributes: {
                                        // maxlength: "10",
                                        autocapitalize: "off",
                                        autocorrect: "off"
                                    },
                                });
                                if (password == r) {
                                    $.ajax({
                                        type: "DELETE",
                                        url: "{{ route('getLamaran.store') }}" +
                                            '/' + contract_id,
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
                                            $('.datatable-lamaran').DataTable()
                                                .ajax.reload();
                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: "top-end",
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true,
                                                didOpen: (toast) => {
                                                    toast
                                                        .onmouseenter =
                                                        Swal
                                                        .stopTimer;
                                                    toast
                                                        .onmouseleave =
                                                        Swal
                                                        .resumeTimer;
                                                }
                                            });
                                            Toast.fire({
                                                icon: "success",
                                                title: "Data Lamaran : " +
                                                    nama + " Terhapus"
                                            });
                                        },
                                        error: function(data) {
                                            console.log('Error:', data
                                                .responseText);
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal!',
                                                text: 'Error: ' + data
                                                    .responseText,
                                                showConfirmButton: true,
                                            });
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Gagal",
                                        text: "Teks yang diketik tidak sama",
                                    });
                                }
                            })()
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak dapat menghapus',
                        text: 'Mohon cek apakah kandidat sudah wawancara atau belum, jika ada mohon untuk hapus proses wawancara terlebih dulu',
                        showConfirmButton: true,
                    });
                }
            });
        });
    </script>
@endsection
