@extends('layouts.app')
@section('content')

        <style>
            td.cuspad0 {
                padding-top: 1px;
                padding-bottom: 1px;
                padding-right: 13px;
                padding-left: 13px;
            }
            td.cuspad1 {
                text-transform: uppercase;
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 12h6" /><path d="M9 16h6" /></svg>
                                    Lamaran
                                </h2>
                                <div class="page-pretitle">
                                    <ol class="breadcrumb" aria-label="breadcrumbs">
                                        <li class="breadcrumb-item"><a href="{{ url('dashboard'); }}"><i class="fa fa-home"></i> Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i> Penerimaan</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a href="#"><i class="fa-regular fa-paste"></i> Lamaran</a></li>
                                    </ol>
                                </div>
                            </div>
                            
                            <!-- Page title actions -->
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-lamaran" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <i class="fa-solid fa-user-plus"></i>
                                        Tambah Lamaran
                                    </a>
                                    <a href="#" class="btn btn-green d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-upload" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <i class="fa-regular fa-file-excel"></i>
                                        Upload Excel
                                    </a>
                                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-lamaran" aria-label="Tambah Lamaran">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                    <a href="#" class="btn btn-green d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-upload" aria-label="Upload Excel">
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
                            <div class="card shadow">
                                <div class="card-body">
                                    <form method="POST" class="form" id="add-form" enctype="multipart/form-data" accept-charset="utf-8" onkeydown="return event.key != 'Enter';" data-select2-id="add-form">
                                        @csrf
                                        <div class="row">
                                            <div class="control-group col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Permintaan</label>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kepala Bagian</label>
                                                    <select name="kabag" id="kabag" class="form-select elementkabag border-primary" data-select2-id="kabag" tabindex="-1" aria-hidden="true">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group col-lg-9">
                                                <div class="card card-active">
                                                    <div class="card-stamp card-stamp-lg">
                                                        <div class="card-stamp-icon bg-primary text-white">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-replace" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 21l-6 -6" /><path d="M3.291 8a7 7 0 0 1 5.077 -4.806a7.021 7.021 0 0 1 8.242 4.403" /><path d="M17 4v4h-4" /><path d="M16.705 12a7 7 0 0 1 -5.074 4.798a7.021 7.021 0 0 1 -8.241 -4.403" /><path d="M3 16v-4h4" /></svg>
                                                        </div>
                                                    </div>
                                                    <div class="card-body shadow">
                                                        <h3 class="card-title">Repeat Order</h3>
                                                        <div class="control-group col-lg-3">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="repeatOr" onblur="carikodeseri();" onkeyup="" style="border-color: black;" placeholder="Masukkan Kodeseri/Barang">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="col">
                                                            <div id="hasil_cari"></div>
                                                            <div id="tunggu"></div>
                                                            <span id="success-msg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group after-add-more">
                                            <button class="btn btn-success" type="button" onclick="tambahItem(); return false;">
                                                <i class="fa-solid fa-cart-plus" style="margin-right: 5px"></i>
                                                Tambah Item
                                            </button>
                                        </div>
                                        <hr>
                                        <input id="idf" value="1" type="hidden">
                                        <div style="overflow-x:auto;overflow-x: scroll;">
                                            <div style="width: 2000px">
                                                <table id="detail_transaksi" class="control-group text-nowrap" border="0" style="width: 100%;text-align:center;font-weight: bold;">
                                                    <thead>
                                                        <tr>
                                                            <td style="border-left-color:#FFFFFF;border-top-color:#FFFFFF;border-bottom-color:#FFFFFF;width: 50px"></td>
                                                            <td class="bg-primary text-white" style="width: 200px">Jenis</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Kodeproduk</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Nama Barang</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Deskripsi</td>
                                                            <td class="bg-primary text-white" style="width: 200px">katalog</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Part</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Mesin</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Qty</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Satuan</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Pemesan</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Unit</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Peruntukan</td>
                                                            <td class="bg-primary text-white" style="width: 200px">Sample</td>
                                                            <th style="border-right-color:#FFFFFF;border-top-color:#FFFFFF;border-bottom-color:#FFFFFF;">Urgent</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="control-group col-lg-8">
                                                <div id="ketTamb">
                                                    <div class="mb-3">
                                                        <label class="form-label">Keterangan Tambahan</label>
                                                        <textarea name="keteranganform" class="form-control" id="keteranganform"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group col-lg-4">
                                                <script>
                                                    var loadFile = function(event) {
                                                        var output = document.getElementById('blah');
                                                        output.src = URL.createObjectURL(event.target
                                                            .files[0]);
                                                        output.onload = function() {
                                                            URL.revokeObjectURL(output
                                                                .src) // free memory
                                                        }
                                                    };
                                                </script>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Unggah Gambar</label>
                                                    <input type="file" name="gambarKeterangan" id="gambarKeterangan" class="form-control-file" accept=".jpg, .jpeg, .png, .gif" onchange="loadFile(event)">
                                                </div>
                                                <img id="blah" src="#" alt="Preview" width="300px">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="float-xl-right">
                                            <button type="submit" class="btn btn-primary" id="submitPermintaan"><i class="fa-regular fa-floppy-disk" style="margin-right: 5px"></i> Simpan Permintaan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.footer')
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-lamaran" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="fa-solid fa-user-plus"></i> Buat Data Lamaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formCotton" name="formCotton" method="post" action="javascript:void(0)">
                        @csrf
                            <div class="modal-body">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Entitas <i><small class="text-muted">(<i>jika Entitas belum terdaftar, <a href="{{ url('daftar/entitas') }}">tambah entitas</a> disini</i>)</small></i></label>
                                    <div class="form-group">
                                        <input type="text" value="1065" class="form-select border border-dark" name="noimp" id="noimp" placeholder="Masukkan Nomor Import">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" value="23088" class="form-control border border-dark" name="nocont" id="nocont" placeholder="Masukkan Nomor Kontrak">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">NIK KTP</label>
                                            <input type="text" value="1065" class="form-control border border-dark" name="noimp" id="noimp" placeholder="Masukkan Nomor Import">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Gender</label>
                                            <select name="pendidikan" id="pendidikan" class="form-select border-dark">
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
                                            <input type="text" value="13088" class="form-control border border-dark" name="invoice" id="invoice" placeholder="Masukkan Invoice">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <div class="input-icon mb-2">
                                                <input name="tanggal" class="form-control border-dark" placeholder="Select a date" id="datepicker-icon" value="<?= date('Y-m-d'); ?>"/>
                                                <span class="input-icon-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                                                </span>
                                            </div>
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
                                            <input type="text" class="form-control border border-dark" name="blno" id="blno" placeholder="Masukkan B/L Nomor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" class="form-control border border-dark" name="eta" id="eta">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Agama</label>
                                            <select name="pendidikan" id="pendidikan" class="form-select border-dark">
                                                <option value="" hidden>-- Pilih Agama --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="SMA">SMA</option>
                                                <option value="SMK">SMK</option>
                                                <option value="D3">D3</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
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
                                                    <div class="input-group mb-2">
                                                        <input type="number" value="100" min="1" class="form-control border border-dark" name="qty_ton" id="qty_ton" placeholder="Qty Dalam Ton">
                                                        <span class="input-group-text border border-dark">
                                                            cm
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Berat</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" value="445" min="1" class="form-control border border-dark" name="qty_bales" id="qty_bales" placeholder="Qty Dalam Bales">
                                                        <span class="input-group-text border border-dark">
                                                            kg
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="text" value="4" min="1" class="form-control border border-dark" name="qty_cont" id="qty_cont" placeholder="Qty Container">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Posisi Yang Dituju</label>
                                            <div class="form-group">
                                                <input type="text" value="112" min="1" class="form-control border border-dark" name="banyakbales" id="banyakbales" placeholder="Masukkan Banyak Bales dalam 1 Container">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <div class="form-group">
                                                <input type="email" value="112" min="1" class="form-control border border-dark" name="banyakbales" id="banyakbales" placeholder="Masukkan Banyak Bales dalam 1 Container">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <div class="col-lg-8">
                                        <textarea name="" id="" cols="90" rows="2" class="form-control border border-dark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                                <button type="submit" id="submitCotton" class="btn btn-primary ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                                    Simpan
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function () {
                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon'),
                    buttonText: {
                        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                }));
            });
            // @formatter:on
        </script>
@endsection
