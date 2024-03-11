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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" /></svg>
                            Edit Legalitas
                            <div id="entitasText" style="margin-left: 5px;">Loading... <i class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                        </h2>
                        <div class="page-pretitle">
                            <ol class="breadcrumb" aria-label="breadcrumbs">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard'); }}"><i class="fa fa-home"></i> Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i> Penerimaan</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('penerimaan/legalitas') }}"><i class="fa-solid fa-file-signature"></i> Legalitas</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"><i class="fa-solid fa-file-signature"></i> Edit Legalitas</a></li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                @foreach ($getKar as $key => $p)
                <div class="row row-deck row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row row-0">
                                <div class="col-3">
                                    @if(file_exists('photo/pas/'.$p->userid.'.jpg'))
                                        <img src="{{ url('photo/pas/'.$p->userid) }}.jpg" class="w-100 h-100 object-cover card-img-start" alt="Employee">
                                    @else
                                        <iframe width="300px" height="300px" style="margin-right: 10px;margin-left: 20px; " src="https://lottie.host/embed/7ba0a25d-390d-49e4-bc83-6302d068ecf0/MI4KmGgBfI.json"></iframe>
                                        <input type="file" class="form-control" style="margin-bottom: 10px;margin-left: 10px; ">
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h3 class="card-title d-flex">
                                            Data Karyawan
                                            <b class="ms-auto">
                                                Rekening : {{ $p->bankrek }}
                                            </b>
                                        </h3>
                                        <div class="row row-1" style="margin-bottom: 10px">
                                            <div class="col">
                                                <div class="card shadow bg-info-lt">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-vcenter card-table">
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>:</td>
                                                                <td><b>{{ $p->nama }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 180px">Userid</td>
                                                                <td>:</td>
                                                                <td>{{ $p->userid }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>KTP</td>
                                                                <td>:</td>
                                                                <td>{{ $p->nik }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gender</td>
                                                                <td>:</td>
                                                                <td>{{ $p->gender }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tempat Tanggal Lahir</td>
                                                                <td>:</td>
                                                                <td>{{ $p->tempat . ", ". date('d/m/Y', strtotime($p->tgllahir)) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pendidikan</td>
                                                                <td>:</td>
                                                                <td>{{ $p->pendidikan." ". $p->jurusan }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card shadow bg-pink-lt">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm">
                                                            <tr>
                                                                <td style="width: 120px">Entitas</td>
                                                                <td>:</td>
                                                                <td>{{ $p->entitas }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nomor Map</td>
                                                                <td>:</td>
                                                                <td>{{ $p->nomap }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Agama</td>
                                                                <td>:</td>
                                                                <td>{{ $p->agama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tinggi Badan</td>
                                                                <td>:</td>
                                                                <td>{{ $p->tinggi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Berat Badan</td>
                                                                <td>:</td>
                                                                <td>{{ $p->berat }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nomor Telepon</td>
                                                                <td>:</td>
                                                                <td>{{ $p->notlp }}</td>
                                                            </tr>
                                                            {{-- <tr>
                                                                <td>Alamat</td>
                                                                <td>:</td>
                                                                <td>{{ $p->alamat }}</td>
                                                            </tr> --}}
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-1">
                                            <div class="col">
                                                <div class="card shadow bg-warning-lt">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-vcenter card-table">
                                                            <tr>
                                                                <td style="width: 180px">Status</td>
                                                                <td>:</td>
                                                                <td>{{ $p->status }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 180px">Alamat</td>
                                                                <td>:</td>
                                                                <td>{{ $p->alamat }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-xl border-success shadow rounded">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-success">
                                    <i class="fa-regular fa-address-card"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex">
                                    Basic Information
                                    <a href="#" class="btn btn-icon btn-success btn-sm ms-auto"><i class="fa-solid fa-add"></i></a>
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped table-hover table-vcenter text-nowrap border border-green">
                                        <thead>
                                            <tr>
                                                <th class="w-1"></th>
                                                <th>Tanggal</th>
                                                <th>Nama Surat</th>
                                                <th>Tgl Aktif</th>
                                                <th>STB</th>
                                                <th>Divisi</th>
                                                <th>Bagian</th>
                                                <th>Jabatan</th>
                                                <th>Grup</th>
                                                <th>Jns. Shift</th>
                                                <th>Profesi</th>
                                                <th>Libur</th>
                                                <th>½ Hari</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($basic as $bas => $b)
                                                <tr>
                                                    <td class="text-center" style="padding: 2px 2px 2px 2px">
                                                        <a href="#" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-edit"></i></a>
                                                        <a href="#" class="btn btn-sm btn-danger btn-icon"><i class="fa-solid fa-trash-can"></i></a>
                                                    </td>
                                                    <td class="text-end">{{ date('d/m/Y', strtotime($b->legalitastgl)); }}</td>
                                                    <td>{{ $b->suratket }}</td>
                                                    <td class="text-end">{{ date('d/m/Y', strtotime($b->tglmasuk)); }}</td>
                                                    <td>{{ $b->stb }}</td>
                                                    <td>{{ $b->divisi }}</td>
                                                    <td>{{ $b->bagian }}</td>
                                                    <td>{{ $b->jabatan }}</td>
                                                    <td>{{ $b->grup }}</td>
                                                    <td>{{ $b->shift }}</td>
                                                    <td>{{ $b->profesi }}</td>
                                                    <td>{{ $b->hrlibur }}</td>
                                                    <td>{{ $b->sethari }}</td>
                                                    <td>{{ $b->keterangan }}</td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row row-deck row-cards">
                            <div class="col-lg-12">
                                <div class="card card-xl border-purple shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-purple">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title d-flex">
                                            Perjanjian
                                            <a href="#" class="btn btn-icon btn-sm btn-purple ms-auto"><i class="fa-solid fa-add"></i></a>
                                        </h3>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-purple">
                                                <thead>
                                                    <tr>
                                                        <th class="w-1"></th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Surat</th>
                                                        <th>Jenis Surat</th>
                                                        <th>Awal</th>
                                                        <th>Akhir</th>
                                                        <th>Cuti</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($perjanjian as $per => $p)
                                                        <tr>
                                                            <td class="text-center" style="padding: 2px 2px 2px 2px">
                                                                <a href="#" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-edit"></i></a>
                                                                <a href="#" class="btn btn-sm btn-danger btn-icon"><i class="fa-solid fa-trash-can"></i></a>
                                                            </td>
                                                            <td class="text-end">{{ date('d/m/Y', strtotime($p->legalitastgl)); }}</td>
                                                            <td>{{ $p->nmsurat }}</td>
                                                            <td>{{ $p->suratket }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($p->tglaw)) }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($p->tglak)) }}</td>
                                                            <td>{{ $p->sacuti }}</td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-xl border-teal shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-teal">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title d-flex">
                                            Internal
                                            <a href="#" class="btn btn-teal btn-icon btn-sm ms-auto"><i class="fa-solid fa-add"></i></a>
                                        </h3>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-teal">
                                                <thead>
                                                    <tr>
                                                        <th class="w-0 text-center" style="padding: 2px 2px 2px 2px"></th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Surat</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($intern as $int => $i)
                                                        <tr>
                                                            <td class="text-center" style="padding: 2px 2px 2px 2px">
                                                                <a href="#" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-edit"></i></a>
                                                                <a href="#" class="btn btn-sm btn-danger btn-icon"><i class="fa-solid fa-trash-can"></i></a>
                                                            </td>
                                                            <td class="text-end">{{ date('d/m/Y', strtotime($i->legalitastgl)); }}</td>
                                                            <td>{{ $i->suratket }}</td>
                                                            <td>{{ $i->keterangan }}</td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-xl border-pink shadow rounded">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-pink">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex">
                                    Status
                                    <a href="#" class="btn btn-pink btn-icon btn-sm ms-auto"><i class="fa-solid fa-add"></i></a>
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-pink">
                                        <thead>
                                            <tr>
                                                <th class="w-1"></th>
                                                <th>Tanggal</th>
                                                <th>Nama Surat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($status as $stt => $s)
                                                <tr>
                                                    <td class="text-center" style="padding: 2px 2px 2px 2px">
                                                        <a href="#" class="btn btn-sm btn-info btn-icon"><i class="fa-solid fa-edit"></i></a>
                                                        <a href="#" class="btn btn-sm btn-danger btn-icon"><i class="fa-solid fa-trash-can"></i></a>
                                                    </td>
                                                    <td class="text-end">{{ date('d/m/Y', strtotime($s->legalitastgl)); }}</td>
                                                    <td>{{ $s->suratket }}</td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-blue"><i class="fa-solid fa-floppy-disk" style="margin-right: 5px"></i> Simpan</button>
                <a href="{{ url('penerimaan/legalitas') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left" style="margin-right: 5px"></i> Batal & Kembali</a>
                @endforeach
            </div>
        </div>
        @include('shared.footer')
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

    $(function() {
    });
</script>
@endsection