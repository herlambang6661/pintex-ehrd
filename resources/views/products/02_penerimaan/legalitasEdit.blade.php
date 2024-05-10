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
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                    <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                </svg>
                                Edit Legalitas
                                {{-- <div id="entitasText" style="margin-left: 5px;">Loading... <i class="fa-solid fa-spinner fa-spin-pulse"></i> </div> --}}
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i>
                                            Penerimaan</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('penerimaan/legalitas') }}"><i
                                                class="fa-solid fa-file-signature"></i> Legalitas</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-solid fa-file-signature"></i> Edit Legalitas</a></li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <form id="formLegalitas" name="formLegalitas" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="container-xl">
                        @foreach ($getKar as $key => $p)
                            <input type="hidden" name="entitas" value="PINTEX">
                            <input type="hidden" name="nama" value="{{ $p->nama }}">
                            <input type="hidden" name="userid" value="{{ $p->userid ? $p->userid : '' }}">
                            <input type="hidden" name="iduntukphl" value="{{ $iduntukphl }}">
                            <div class="row row-deck row-cards">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="row row-0">
                                            <div class="col-3">
                                                @if (file_exists('photo/pas/' . $p->userid . '.jpg'))
                                                    <img src="{{ url('photo/pas/' . $p->userid) }}.jpg"
                                                        class="w-100 h-100 object-cover card-img-start" alt="Employee">
                                                @else
                                                    <iframe width="300px" height="300px"
                                                        style="margin-right: 10px;margin-left: 20px; "
                                                        src="https://lottie.host/embed/7ba0a25d-390d-49e4-bc83-6302d068ecf0/MI4KmGgBfI.json"></iframe>
                                                    <input type="file" class="form-control"
                                                        style="margin-bottom: 10px;margin-left: 10px; ">
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
                                                                            <td>{{ $p->tempat . ', ' . date('d/m/Y', strtotime($p->tgllahir)) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pendidikan</td>
                                                                            <td>:</td>
                                                                            <td>{{ $p->pendidikan . ' ' . $p->jurusan }}
                                                                            </td>
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
                                                <div class=" ms-auto">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-stb"
                                                        class="btn btn-secondary btn-sm"><i
                                                            class="fa-solid fa-arrow-up-9-1"
                                                            style="margin-right: 5px"></i> STB Terakhir</a>
                                                    <button type="button" class="btn btn-icon btn-success btn-sm"
                                                        onclick="tambahBasic(); return false;"><i
                                                            class="fa-solid fa-add"></i></button>
                                                    <button type="button" class="btn btn-icon btn-success btn-sm"
                                                        onclick="tambahModal('basic'); return false;">
                                                        <i class="fa-solid fa-add"></i>
                                                    </button>
                                                </div>
                                            </h3>
                                            <input id="idf" value="1" type="hidden">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-sm table-bordered table-striped table-hover table-vcenter text-nowrap border border-green"
                                                    id="tb_basic">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-1"></th>
                                                            <th class="text-center">Tanggal</th>
                                                            <th class="text-center">Nama Surat</th>
                                                            <th class="text-center">Tgl Aktif</th>
                                                            <th class="text-center">STB</th>
                                                            <th class="text-center">Divisi</th>
                                                            <th class="text-center">Bagian</th>
                                                            <th class="text-center">Jabatan</th>
                                                            <th class="text-center">Grup</th>
                                                            <th class="text-center">Jns. Shift</th>
                                                            <th class="text-center">Profesi</th>
                                                            <th class="text-center">Libur</th>
                                                            <th class="text-center">½ Hari</th>
                                                            <th class="text-center">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($basic as $bas => $b)
                                                            <tr>
                                                                <td class="text-center" style="padding: 2px 2px 2px 2px">
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-info btn-icon"><i
                                                                            class="fa-solid fa-edit"></i></a>
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-danger btn-icon"><i
                                                                            class="fa-solid fa-trash-can"></i></a>
                                                                </td>
                                                                <td class="text-end">
                                                                    {{ date('d/m/Y', strtotime($b->legalitastgl)) }}</td>
                                                                <td>{{ $b->nmsurat }}</td>
                                                                <td class="text-end">
                                                                    {{ date('d/m/Y', strtotime($b->tglmasuk)) }}</td>
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
                                                        <button type="button"
                                                            class="btn btn-icon btn-sm btn-purple ms-auto"
                                                            onclick="tambahPerjanjian(); return false;"><i
                                                                class="fa-solid fa-add"></i></button>
                                                    </h3>
                                                    <input id="idp" value="1" type="hidden">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-purple"
                                                            id="tb_per">
                                                            <thead>
                                                                <tr>
                                                                    <th class="w-1"></th>
                                                                    <th class="text-center">Tanggal</th>
                                                                    <th class="text-center">Nama Surat</th>
                                                                    <th class="text-center">Jenis Surat</th>
                                                                    <th class="text-center">Awal</th>
                                                                    <th class="text-center">Akhir</th>
                                                                    <th class="text-center">Cuti</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($perjanjian as $per => $p)
                                                                    <tr>
                                                                        <td class="text-center"
                                                                            style="padding: 2px 2px 2px 2px">
                                                                            <a href="#"
                                                                                class="btn btn-sm btn-info btn-icon"><i
                                                                                    class="fa-solid fa-edit"></i></a>
                                                                            <a href="#"
                                                                                class="btn btn-sm btn-danger btn-icon"><i
                                                                                    class="fa-solid fa-trash-can"></i></a>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            {{ date('d/m/Y', strtotime($p->legalitastgl)) }}
                                                                        </td>
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
                                                        <button type="button"
                                                            class="btn btn-teal btn-icon btn-sm ms-auto"
                                                            onclick="tambahInternal(); return false;"><i
                                                                class="fa-solid fa-add"></i></button>
                                                    </h3>
                                                    <input id="idi" value="1" type="hidden">
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-teal"
                                                            id="tb_int">
                                                            <thead>
                                                                <tr>
                                                                    <th class="w-0 text-center"
                                                                        style="padding: 2px 2px 2px 2px"></th>
                                                                    <th>Tanggal</th>
                                                                    <th>Nama Surat</th>
                                                                    <th>Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($intern as $int => $i)
                                                                    <tr>
                                                                        <td class="text-center"
                                                                            style="padding: 2px 2px 2px 2px">
                                                                            <a href="#"
                                                                                class="btn btn-sm btn-info btn-icon"><i
                                                                                    class="fa-solid fa-edit"></i></a>
                                                                            <a href="#"
                                                                                class="btn btn-sm btn-danger btn-icon"><i
                                                                                    class="fa-solid fa-trash-can"></i></a>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            {{ date('d/m/Y', strtotime($i->legalitastgl)) }}
                                                                        </td>
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
                                                <button type="button" class="btn btn-pink btn-icon btn-sm ms-auto"
                                                    onclick="tambahStatus(); return false;"><i
                                                        class="fa-solid fa-add"></i></button>
                                            </h3>
                                            <input id="ids" value="1" type="hidden">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-sm table-hover table-bordered table-vcenter card-table text-nowrap border border-pink"
                                                    id="tb_stt">
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
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-info btn-icon"><i
                                                                            class="fa-solid fa-edit"></i></a>
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-danger btn-icon"><i
                                                                            class="fa-solid fa-trash-can"></i></a>
                                                                </td>
                                                                <td class="text-end">
                                                                    {{ date('d/m/Y', strtotime($s->legalitastgl)) }}</td>
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
                            <button class="btn btn-blue" id="simpanLegalitas"><i class="fa-solid fa-floppy-disk"
                                    style="margin-right: 5px"></i> Simpan</button>
                            <a href="{{ url('penerimaan/legalitas') }}" class="btn btn-secondary"><i
                                    class="fa-solid fa-arrow-left" style="margin-right: 5px"></i> Batal & Kembali</a>
                        @endforeach
                    </div>
                </form>
            </div>
            @include('shared.footer')
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal modal-blur fade" id="modal-stb" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">STB Terakhir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="fetched-data-stb"></div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary me-auto" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-large" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Large modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti
                    dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit
                    tempora totam unde.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <script type="text/javascript">
        var tglhariini = '<?php echo date('Y-m-d'); ?>';

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
            $('#modal-stb').on('show.bs.modal', function(e) {
                $(".overlay").fadeIn(300);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'POST',
                    url: '{{ url('listStb') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        $('.fetched-data-stb').html(data); //menampilkan data ke dalam modal
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });

            if ($("#formLegalitas").length > 0) {
                $("#formLegalitas").validate({

                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#simpanLegalitas').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#simpanLegalitas").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataLegalitas') }}",
                            type: "POST",
                            data: $('#formLegalitas').serialize(),
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
                                console.log(response);
                                if (response.status == true) {
                                    $('#simpanLegalitas').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                    );
                                    $("#simpanLegalitas").attr("disabled", false);
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
                                    document.getElementById("formLegalitas").reset();
                                    var sp = $('#selectEntitas').val();
                                    $('#entitas').val(sp);
                                    window.location.replace(
                                        "{{ url('penerimaan/legalitas') }}");
                                } else if (response.status == false) {
                                    console.log('Error:', response);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: response.msg,
                                        showConfirmButton: true
                                    });
                                    $('#simpanLegalitas').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                    );
                                    $("#simpanLegalitas").attr("disabled", false);
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
                                $('#simpanLegalitas').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#simpanLegalitas").attr("disabled", false);
                            }
                        });
                    }
                })
            }
        });


        function tambahModal(params) {
            $('#modal-large').modal('show');
            $(".overlay").fadeIn(300);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type: 'POST',
                url: '{{ url('listStb') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('.fetched-data-stb').html(data); //menampilkan data ke dalam modal
                }
            }).done(function() {
                setTimeout(function() {
                    $(".overlay").fadeOut(300);
                }, 500);
            });
        }

        function tambahBasic() {
            var idf = document.getElementById("idf").value;

            var tb_basic = document.getElementById("tb_basic");

            var tr = document.createElement("tr");
            tr.setAttribute("id", "btn-remove" + idf);

            // Kolom 1 Hapus
            var td = document.createElement("td");
            td.setAttribute("align", "center");
            td.setAttribute("class", "border border-green w-0");
            td.innerHTML += '<button class="btn" type="button" onclick="hapusElemen(' + idf +
                ');"><i class="fa-regular fa-trash-can"></i> </button>';
            tr.appendChild(td);

            // Kolom 2 Tanggal
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green w-0");
            td.innerHTML += '<input type="date" style="width:110px;" value="' + tglhariini + '" name="tgl[]" id="tgl_' +
                idf + '">';
            tr.appendChild(td);

            // Kolom 3 Nama Surat                            
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML +=
                '<input type="text" style="width:180px;" value="Surat Deskripsi Pekerjaan" name="namasurat[]" id="namasurat_' +
                idf + '">';
            tr.appendChild(td);

            // Kolom 4 Tgl Aktif
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += '<input type="date" style="width:110px;" value="' + tglhariini +
                '" name="tglaktif[]" id="tglaktif_' + idf + '">';
            tr.appendChild(td);

            // Kolom 5 STB
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<input type='text' name='stb[]' id='stb_" + idf +
                "' class=' inputNone' style='width:60px;text-transform: uppercase;'>";
            tr.appendChild(td);

            // Kolom 6 Divisi
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            // td.innerHTML += "<input type='text' name='divisi[]' id='divisi_" + idf + "' class='form-control  inputNone' style='text-transform: uppercase;'>";
            td.innerHTML += "<select name='divisi[]' id='divisi_" + idf + "'>" +
                "<option value='' hidden>-- Pilih Divisi --</option>" +
                "<?php foreach($p_divisi as $key => $w){ ?>" +
                "<option value='<?php echo $w->desc; ?>'><?php echo $w->desc; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 7 Bagian
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<select name='bagian[]' id='bagian_" + idf + "'>" +
                "<option value='' hidden>-- Pilih Bagian --</option>" +
                "<?php foreach($p_bagian as $key => $w){ ?>" +
                "<option value='<?php echo $w->desc; ?>'><?php echo $w->desc; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 8 Jabatan
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<select name='jabatan[]' id='jabatan_" + idf + "'>" +
                "<option value='' hidden>-- Pilih Jabatan --</option>" +
                "<?php foreach($p_jabatan as $key => $w){ ?>" +
                "<option value='<?php echo $w->desc; ?>'><?php echo $w->desc; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 9 Grup
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<select name='grup[]' id='grup_" + idf + "'>" +
                "<option value='' hidden>-- Pilih Grup --</option>" +
                "<?php foreach($p_grup as $key => $w){ ?>" +
                "<option value='<?php echo $w->desc; ?>'><?php echo $w->desc; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 10 Shift
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<select name='shift[]' id='shift_" + idf + "'>" +
                "<option value='' hidden>-- Pilih Shift --</option>" +
                "<?php foreach($p_shift as $key => $w){ ?>" +
                "<option value='<?php echo $w->desc; ?>'><?php echo $w->desc; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 11 Profesi
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<input type='text' name='profesi[]' id='profesi_" + idf +
                "' style='text-transform: uppercase;'>";
            tr.appendChild(td);

            // Kolom 12 Libur
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<select name='libur[]' id='libur_" + idf + "'>" +
                "<option value='' hidden>-- Pilih Libur --</option>" +
                "<option value='SENIN'>SENIN</option>" +
                "<option value='SELASA'>SELASA</option>" +
                "<option value='RABU'>RABU</option>" +
                "<option value='KAMIS'>KAMIS</option>" +
                "<option value='JUMAT'>JUMAT</option>" +
                "<option value='SABTU'>SABTU</option>" +
                "<option value='MINGGU'>MINGGU</option>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 13 Setengah Hari
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<select name='setengah[]' id='setengah_" + idf + "'>" +
                "<option value='' hidden>-- Pilih ½ HARI --</option>" +
                "<option value='SENIN'>SENIN</option>" +
                "<option value='SELASA'>SELASA</option>" +
                "<option value='RABU'>RABU</option>" +
                "<option value='KAMIS'>KAMIS</option>" +
                "<option value='JUMAT'>JUMAT</option>" +
                "<option value='SABTU'>SABTU</option>" +
                "<option value='MINGGU'>MINGGU</option>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 14 Ket
            var td = document.createElement("td");
            td.setAttribute("class", "border border-green");
            td.innerHTML += "<input type='text' name='keterangan[]' id='keterangan_" + idf +
                "' style='text-transform: uppercase;'>";
            tr.appendChild(td);

            tb_basic.appendChild(tr);

            idf = (idf - 1) + 2;
            document.getElementById("idf").value = idf;
            $(".element").select2({
                placeholder: "Pilih Kodeproduk"
            });
        }

        function tambahPerjanjian() {
            var idp = document.getElementById("idp").value;

            var tb_per = document.getElementById("tb_per");
            var tr = document.createElement("tr");
            tr.setAttribute("id", "remove-perjanjian" + idp);

            // Kolom 1 Hapus
            var td = document.createElement("td");
            td.setAttribute("class", "text-center border border-purple w-0");
            td.innerHTML += '<button class="btn" type="button" onclick="hapusPerjanjian(' + idp +
                ');"><i class="fa-regular fa-trash-can"></i> </button>';
            tr.appendChild(td);

            // Kolom 2 Tanggal Perjanjian
            var td = document.createElement("td");
            td.setAttribute("class", "border border-purple");
            td.innerHTML += '<input type="date" style="width:100%" value="' + tglhariini +
                '" name="tgl_perjanjian[]" id="tgl_perjanjian_' + idp + '" class="border border-white">';
            tr.appendChild(td);

            // Kolom 3 Nama Surat Perjanjian
            var td = document.createElement("td");
            td.setAttribute("class", "border border-purple");
            td.innerHTML += "<select name='nmperjanjian[]' style='width:180px;' id='nmperjanjian_" + idp +
                "' class='form-select' class='border border-white'>" +
                "<option value='' hidden>-- Pilih Perjanjian --</option>" +
                "<?php foreach($j_perjanjian as $key => $w){ ?>" +
                "<option value='<?php echo $w->nmsurat; ?>'><?php echo $w->nmsurat; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 4 Jenis Surat Perjanjian
            var td = document.createElement("td");
            td.setAttribute("class", "border border-purple");
            td.innerHTML += '<input type="text" value="" name="jenis_perjanjian[]" id="jenis_perjanjian_' + idp +
                '" class="border border-white">';
            tr.appendChild(td);

            // Kolom 5 Tanggal Awal Perjanjian
            var td = document.createElement("td");
            td.setAttribute("class", "border border-purple");
            td.innerHTML += '<input type="date" style="width:100%" value="' + tglhariini +
                '" name="awal_perjanjian[]" id="awal_perjanjian_' + idp + '" class="border border-white">';
            tr.appendChild(td);

            // Kolom 6 Tanggal Akhir Perjanjian
            var td = document.createElement("td");
            td.setAttribute("class", "border border-purple");
            td.innerHTML += '<input type="date" style="width:100%" value="' + tglhariini +
                '" name="akhir_perjanjian[]" id="akhir_perjanjian_' + idp + '" class="border border-white">';
            tr.appendChild(td);

            // Kolom 7 Cuti
            var td = document.createElement("td");
            td.setAttribute("class", "border border-purple");
            td.innerHTML += '<input type="text" value="" name="cuti[]" id="cuti_' + idp + '" class="border border-white">';
            tr.appendChild(td);

            tb_per.appendChild(tr);

            idp = (idp - 1) + 2;
            document.getElementById("idp").value = idp;
        }

        function tambahInternal() {
            var idi = document.getElementById("idi").value;

            var tb_int = document.getElementById("tb_int");
            var tr = document.createElement("tr");
            tr.setAttribute("id", "remove-internal" + idi);

            // Kolom 1 Hapus
            var td = document.createElement("td");
            td.setAttribute("class", "text-center border border-teal w-0");
            td.innerHTML += '<button class="btn" type="button" onclick="hapusInternal(' + idi +
                ');"><i class="fa-regular fa-trash-can"></i> </button>';
            tr.appendChild(td);

            // Kolom 2 Tanggal Internal
            var td = document.createElement("td");
            td.setAttribute("class", "border border-teal");
            td.innerHTML += '<input type="date" style="width:100%" value="' + tglhariini +
                '" name="tgl_internal[]" id="tgl_internal_' + idi + '" class="border border-white">';
            tr.appendChild(td);

            // Kolom 3 Nama Surat Internal
            var td = document.createElement("td");
            td.setAttribute("class", "border border-teal");
            td.innerHTML += "<select name='nminternal[]' style='width:100%;' id='nminternal_" + idi +
                "' class='form-select' class='border border-white'>" +
                "<option value='' hidden>-- Pilih Internal --</option>" +
                "<?php foreach($j_internal as $key => $w){ ?>" +
                "<option value='<?php echo $w->nmsurat; ?>'><?php echo $w->nmsurat; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            // Kolom 4 Keterangan 
            var td = document.createElement("td");
            td.setAttribute("class", "border border-teal");
            td.innerHTML += '<input type="text" style="width:100%;" name="keterangan_internal[]" id="keterangan_internal_' +
                idi + '" class="border border-white">';
            tr.appendChild(td);

            tb_int.appendChild(tr);

            idi = (idi - 1) + 2;
            document.getElementById("idi").value = idi;
        }

        function tambahStatus() {
            var ids = document.getElementById("ids").value;

            var tb_stt = document.getElementById("tb_stt");
            var tr = document.createElement("tr");
            tr.setAttribute("id", "remove-status" + ids);

            // Kolom 1 Hapus
            var td = document.createElement("td");
            td.setAttribute("class", "text-center border border-pink w-0");
            td.innerHTML += '<button class="btn" type="button" onclick="hapusStatus(' + ids +
                ');"><i class="fa-regular fa-trash-can"></i> </button>';
            tr.appendChild(td);

            // Kolom 2 Tanggal Internal
            var td = document.createElement("td");
            td.setAttribute("class", "border border-pink");
            td.innerHTML += '<input type="date" style="width:100%" value="' + tglhariini +
                '" name="tgl_status[]" id="tgl_status_' + ids + '" class="border border-white">';
            tr.appendChild(td);

            // Kolom 3 Nama Surat Internal
            var td = document.createElement("td");
            td.setAttribute("class", "border border-pink");
            td.innerHTML += "<select name='nmstatus[]' style='width:100%;' id='nmstatus_" + ids +
                "' class='form-select' class='border border-white'>" +
                "<option value='' hidden>-- Pilih Status --</option>" +
                "<?php foreach($j_status as $key => $w){ ?>" +
                "<option value='<?php echo $w->nmsurat; ?>'><?php echo $w->nmsurat; ?></option>" +
                "<?php } ?>" +
                "</select>";
            tr.appendChild(td);

            tb_stt.appendChild(tr);

            ids = (ids - 1) + 2;
            document.getElementById("ids").value = ids;
        }

        function hapusElemen(idf) {
            $("#btn-remove" + idf).remove();
        }

        function hapusPerjanjian(idp) {
            $("#remove-perjanjian" + idp).remove();
        }

        function hapusInternal(idi) {
            $("#remove-internal" + idi).remove();
        }

        function hapusStatus(ids) {
            $("#remove-status" + ids).remove();
        }
    </script>
@endsection
