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
                                    <div id="entitasText" style="margin-left: 5px;">Loading... <i class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
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
                                    <a href="#" class="btn btn-green d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#importExcel" data-bs-backdrop="static" data-bs-keyboard="false">
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
                            <div class="col-12">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <table style="width:100%; text-transform:uppercase;font-family: 'Trebuchet MS', Helvetica, sans-serif;"
                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-lamaran">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Gender</th>
                                                <th>Tempat Tanggal Lahir</th>
                                                <th>Pendidikan</th>
                                                <th>Jurusan</th>
                                                <th>Tinggi</th>
                                                <th>Berat</th>
                                                <th>No Telp</th>
                                                <th>Email</th>
                                                <th>Posisi Dituju</th>
                                                <th>Ket</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
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
                                    <label class="form-label">Entitas</label>
                                    <input type="text" class="form-control border border-dark" name="entitas" id="entitas" placeholder="Entitas" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control border border-dark" name="nama" id="nama" placeholder="Masukkan Nama Kandidat">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">NIK KTP</label>
                                            <input type="text" class="form-control border border-dark" name="nik" id="nik" placeholder="Masukkan NIK KTP kandidat">
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
                                            <input type="text" class="form-control border border-dark" name="tempat" id="tempat" placeholder="Masukkan tempat tinggal kandidat">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <div class="input-icon mb-2">
                                                <input name="tanggallahir" class="form-control border-dark" placeholder="Select a date" id="datepicker-icon"/>
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
                                            <input type="text" class="form-control border border-dark" name="jurusan" id="jurusan" placeholder="Masukkan Jurusan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" class="form-control border border-dark" name="alamat" id="alamat" placeholder="Masukkan Alamat">
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
                                                    <div class="input-group mb-2">
                                                        <input type="number" min="140" class="form-control border border-dark" name="tinggi" id="tinggi" placeholder="Tinggi badan">
                                                        <span class="input-group-text border border-dark">
                                                            cm
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Berat</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" min="20" class="form-control border border-dark" name="berat" id="berat" placeholder="Berat badan">
                                                        <span class="input-group-text border border-dark">
                                                            kg
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="text" class="form-control border border-dark" name="notlp" id="notlp" placeholder="No Telp">
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
                                                <input type="email" class="form-control border border-dark" name="email" id="email" placeholder="Email Kandidat">
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
                                        <textarea name="keterangan" id="keterangan" cols="90" rows="2" class="form-control border border-dark" disabled></textarea>
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
        <!-- Import Excel -->
        <div class="modal modal-blur fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="file" name="file" required="required" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cloud-arrow-up" style="margin-right:5px"></i> Import</button>
                        </div>
                    </div>
                </form>
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
            
            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            var tableRayon = $('.datatable-lamaran').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "scrollX": true,
                "scrollCollapse": true,
                "pagingType": 'full_numbers',
                "dom": "<'card-header h3' B>" +
                    "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                    "<'table-responsive' <'col-sm-12'tr> >" +
                    "<'card-footer' <'row'<'col-sm-5'i><'col-sm-7'p> >>",
                buttons: [
                    {
                        text: '<i class="fa-solid fa-filter" style="margin-right:5px"></i>Filter',
                        className: 'btn btn-warning',
                        attr: {
                            'href': '#offcanvasEnd-rayon',
                            'data-bs-toggle': 'offcanvas',
                            'role': 'button',
                            'aria-controls': 'offcanvasEnd',

                        }
                    },
                    {
                        extend: 'copyHtml5',
                        className: 'btn btn-teal',
                        text: '<i class="fa fa-copy text-white" style="margin-right:5px"></i> Copy',
                        action: newexportaction,
                    }, 
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        className: 'btn btn-success',
                        text: '<i class="fa fa-file-excel text-white" style="margin-right:5px"></i> Excel',
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
                ajax: "{{ route('getLamaran.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'cuspad0'},
                    {data: 'NOCONTRACT', name: 'NOCONTRACT', className:'cuspad0'},
                    {data: 'TERIMA', name: 'TERIMA', className:'cuspad0'},
                    {data: 'NOFORM', name: 'NOFORM', className:'cuspad0'},
                    {data: 'NOIMP', name: 'NOIMP', className:'cuspad0'},
                    {data: 'KODEBALE_RAYON', name: 'KODEBALE_RAYON', className:'cuspad0'},
                    {data: 'ENTITAS', name: 'ENTITAS', className:'cuspad0'},
                    {data: 'SUPPLIER', name: 'SUPPLIER', className:'cuspad0'},
                    {data: 'QTY_BALES', name: 'QTY_BALES', className:'cuspad0'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className:'cuspad0'},
                ],
                
            });
        </script>
@endsection
