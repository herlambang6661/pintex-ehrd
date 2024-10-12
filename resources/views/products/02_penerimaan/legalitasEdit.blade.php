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
                {{-- <form id="formLegalitas" name="formLegalitas" method="post" action="javascript:void(0)"> --}}
                @csrf
                <div class="container-xl">
                    @foreach ($getKar as $key => $p)
                        <?php
                        $useridkar = $p->userid;
                        ?>
                        <input type="hidden" name="entitas" value="PINTEX">
                        <input type="hidden" name="nama" value="{{ $p->nama }}">
                        <input type="hidden" name="userid" value="{{ $p->userid ? $p->userid : '' }}">
                        <input type="hidden" name="iduntukphl" value="{{ $iduntukphl }}">
                        <script>
                            // let customDate = new Date(2222, 3, 8);
                            // let strDate = customDate.toLocaleDateString();
                            // let format = strDate
                            //     .replace("04", "MM")
                            //     .replace("4", "M")
                            //     .replace("08", "dd")
                            //     .replace("8", "d")
                            //     .replace("2222", "yyyy")
                            //     .replace("22", "yy");
                            // alert(format);
                        </script>
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
                                                    class="w-100 h-100 object-cover card-img-start"
                                                    src="https://lottie.host/embed/7ba0a25d-390d-49e4-bc83-6302d068ecf0/MI4KmGgBfI.json"></iframe>
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
                                                                        <td style="width: 120px">Email</td>
                                                                        <td>:</td>
                                                                        <td>{{ $p->email }}</td>
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
                                                                        <td>
                                                                            <a href="https://wa.me/62{{ (int) $p->notlp }}"
                                                                                target="_blank" rel="noopener noreferrer">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                                        fill="none" />
                                                                                    <path
                                                                                        d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                                                                    <path
                                                                                        d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                                                                </svg>
                                                                                {{ $p->notlp }}
                                                                            </a>
                                                                        </td>
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
                                                    class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-up-9-1"
                                                        style="margin-right: 5px"></i> STB Terakhir</a>
                                                <button type="button"
                                                    class="btn btn-icon btn-success btn-sm btn-addModal"
                                                    style="cursor:pointer;" data-id="{{ $useridkar }}"
                                                    data-idtipe="basic" data-tipe="Basic Information">
                                                    <i class="fa-solid fa-add"></i>
                                                </button>
                                            </div>
                                        </h3>
                                        <input id="idf" value="1" type="hidden">
                                        <div id="tableBasic"></div>
                                        <div class="col-sm-12 col-md-12 placeholder-basic" style="display:none">
                                            <div class="ph-item">
                                                <div class="ph-col-12">
                                                    <div class="ph-row">
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        class="btn btn-icon btn-purple btn-sm ms-auto btn-addModal"
                                                        data-id="{{ $useridkar }}" data-idtipe="perjanjian"
                                                        data-tipe="Perjanjian">
                                                        <i class="fa-solid fa-add"></i>
                                                    </button>
                                                </h3>
                                                <input id="idp" value="1" type="hidden">
                                                <div id="tablePerjanjian"></div>
                                                <div class="col-sm-12 col-md-12 placeholder-perjanjian"
                                                    style="display:none">
                                                    <div class="ph-item">
                                                        <div class="ph-col-12">
                                                            <div class="ph-row">
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                        class="btn btn-icon btn-teal btn-sm ms-auto btn-addModal"
                                                        data-id="{{ $useridkar }}" data-idtipe="intern"
                                                        data-tipe="Internal">
                                                        <i class="fa-solid fa-add"></i>
                                                    </button>
                                                </h3>
                                                <input id="idi" value="1" type="hidden">
                                                <div id="tableInternal"></div>
                                                <div class="col-sm-12 col-md-12 placeholder-internal"
                                                    style="display:none">
                                                    <div class="ph-item">
                                                        <div class="ph-col-12">
                                                            <div class="ph-row">
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
                                                                <div class="ph-col-12"></div>
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
                                            <button type="button"
                                                class="btn btn-icon btn-pink btn-sm ms-auto btn-addModal"
                                                data-id="{{ $useridkar }}" data-idtipe="status" data-tipe="Status">
                                                <i class="fa-solid fa-add"></i>
                                            </button>
                                        </h3>
                                        <input id="ids" value="1" type="hidden">
                                        <div id="tableStatus"></div>
                                        <div class="col-sm-12 col-md-12 placeholder-status" style="display:none">
                                            <div class="ph-item">
                                                <div class="ph-col-12">
                                                    <div class="ph-row">
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-xl border-dark shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-dark">
                                            <i class="fa-regular fa-address-card"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title d-flex">
                                            Cuti Dispensasi
                                            <div class=" ms-auto">
                                                <button type="button" class="btn btn-icon btn-dark btn-sm btn-addModal"
                                                    data-id="{{ $useridkar }}" data-idtipe="cuti"
                                                    data-tipe="Cuti Dispensasi">
                                                    <i class="fa-solid fa-add"></i>
                                                </button>
                                            </div>
                                        </h3>
                                        <input id="idf" value="1" type="hidden">
                                        <div id="tableCuti"></div>
                                        <div class="col-sm-12 col-md-12 placeholder-cuti" style="display:none">
                                            <div class="ph-item">
                                                <div class="ph-col-12">
                                                    <div class="ph-row">
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                        <div class="ph-col-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- <button class="btn btn-blue" id="simpanLegalitas"><i class="fa-solid fa-floppy-disk"
                                    style="margin-right: 5px"></i> Simpan</button> --}}
                        <a href="{{ url('penerimaan/legalitas') }}" class="btn btn-secondary"><i
                                class="fa-solid fa-arrow-left" style="margin-right: 5px"></i> Kembali</a>
                    @endforeach
                </div>
                {{-- </form> --}}
            </div>
            @include('shared.footer')
        </div>
    </div>
    {{-- Start Modal --}}
    {{-- === Modal STB === --}}
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
    {{-- === Modal STB === --}}
    {{-- === Modal Add === --}}
    <div class="modal modal-blur fade" id="modal-add-legalitas" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formLegalitas" name="formLegalitas" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title modal-judul-legalitas"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-isi-legalitas">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="simpanLegalitas">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- === Modal Add === --}}
    {{-- === Modal Edit === --}}
    <div class="modal modal-blur fade" id="modal-edit-legalitas" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formEditLegalitas" name="formEditLegalitas" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title modal-judul-edit-legalitas"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-isi-edit-legalitas">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="simpanEditLegalitas">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- === Modal Edit === --}}
    {{-- End Modal --}}
    <script type="text/javascript">
        var tglhariini = '<?php echo date('Y-m-d'); ?>';

        $(function() {
            tampil_table();

            /*------------------------------------------
            --------------------------------------------
            Modal Look STB
            --------------------------------------------
            --------------------------------------------*/
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

            /*------------------------------------------
            --------------------------------------------
            Submit Form
            --------------------------------------------
            --------------------------------------------*/
            if ($("#formLegalitas").length > 0) {
                var tipeinput = $('#suratjns').val();
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
                                    title: 'Menyimpan ' + tipeinput,
                                    html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menyimpan data</h1>',
                                    showConfirmButton: false,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                })
                            },
                            success: function(response) {
                                tampil_table()
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
                                    $('#modal-add-legalitas').modal('hide');
                                    $('.modal-isi-legalitas').html('');
                                    // window.location.replace("{{ url('penerimaan/legalitas') }}");
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
            if ($("#formEditLegalitas").length > 0) {

                var tipeinput = $('#suratjnsEdit').val();
                $("#formEditLegalitas").validate({
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#simpanEditLegalitas').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#simpanEditLegalitas").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataEditLegalitas') }}",
                            type: "POST",
                            data: $('#formEditLegalitas').serialize(),
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
                                tampil_table()
                                console.log('Completed.');
                                console.log(response);
                                if (response.status == true) {
                                    $('#simpanEditLegalitas').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Update Data'
                                    );
                                    $("#simpanEditLegalitas").attr("disabled", false);
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
                                    document.getElementById("formEditLegalitas").reset();
                                    var sp = $('#selectEntitas').val();
                                    $('#entitas').val(sp);
                                    $('#modal-edit-legalitas').modal('hide');
                                    $('.modal-isi-edit-legalitas').html('');
                                    // window.location.replace("{{ url('penerimaan/legalitas') }}");
                                } else if (response.status == false) {
                                    console.log('Error:', response);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: response.msg,
                                        showConfirmButton: true
                                    });
                                    $('#simpanEditLegalitas').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Update Data'
                                    );
                                    $("#simpanEditLegalitas").attr("disabled", false);
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
                                $('#simpanEditLegalitas').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Update Data'
                                );
                                $("#simpanEditLegalitas").attr("disabled", false);
                            }
                        });
                    }
                })
            }
            /*------------------------------------------
            --------------------------------------------
            Modal Add
            --------------------------------------------
            --------------------------------------------*/
            $('.btn-addModal').click(function() {
                $(".overlay").fadeIn(300);
                $('.modal-isi-legalitas').html('');
                var id = $(this).data("id");
                var tipe = $(this).data("tipe");
                var idtipe = $(this).data("idtipe");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('addModal') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "idtipe": idtipe,
                        "entitas": 'PINTEX',
                    },
                    success: function(res) {
                        $('.modal-judul-legalitas').html(
                            '<div class="badge bg-primary" style="margin-right:10px"></div> Tambah ' +
                            tipe + " Baru");
                        $('.modal-isi-legalitas').html(res);
                        // show modal
                        $('#modal-add-legalitas').modal('show');

                    },
                    error: function(request, status, error) {
                        console.log("ajax call went wrong:" + request.responseText);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });

            /*------------------------------------------
            --------------------------------------------
            Modal Edit
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.btn-edit', function() {
                $('.modal-isi-edit-legalitas').html('');
                $(".overlay").fadeIn(300);

                var id = $(this).data("id");
                var userid = $(this).data("userid");
                var tipe = $(this).data("tipe");
                var idtipe = $(this).data("idtipe");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('editModal') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "userid": userid,
                        "idtipe": idtipe,
                        "entitas": 'PINTEX',
                    },
                    success: function(res) {
                        $('.modal-judul-edit-legalitas').html(
                            '<div class="badge bg-primary" style="margin-right:10px"></div> Edit ' +
                            tipe);
                        $('.modal-isi-edit-legalitas').html(res);
                        // show modal
                        $('#modal-edit-legalitas').modal('show');

                    },
                    error: function(request, status, error) {
                        console.log("ajax call went wrong:" + request.responseText);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $(".overlay").fadeOut(300);
                    }, 500);
                });
            });
            /*------------------------------------------
            --------------------------------------------
            Modal Delete
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.btn-delete', function() {
                var contract_id = $(this).data("id");
                var userid = $(this).data("userid");
                var nama = $(this).data("nama");
                var tipe = $(this).data("tipe");
                var token = $("meta[name='csrf-token']").attr("content");
                var userURL = $(this).data('url');
                if (userURL == "basicdelete") {
                    sendURL = "{{ url('basicdelete') }}";
                } else if (userURL == "statusdelete") {
                    sendURL = "{{ url('statusdelete') }}";
                } else if (userURL == "internaldelete") {
                    sendURL = "{{ url('internaldelete') }}";
                } else if (userURL == "perjanjiandelete") {
                    sendURL = "{{ url('perjanjiandelete') }}";
                }
                console.log(userURL);
                Swal.fire({
                    icon: 'warning',
                    title: 'Hapus Data ' + tipe,
                    text: 'Apakah anda yakin ingin menghapus ' + nama + ' ?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: sendURL,
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': contract_id,
                                'userid': userid,
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
                                tampil_table()
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
                                tampil_table()
                                console.log('Error:', data.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Error: ' + data.responseText,
                                    showConfirmButton: true,
                                });
                            }
                        });
                    }
                });
            });
        });

        function tampil_table() {
            $(".placeholder-basic").fadeIn(200);
            $(".placeholder-perjanjian").fadeIn(200);
            $(".placeholder-status").fadeIn(200);
            $(".placeholder-internal").fadeIn(200);
            $(".placeholder-cuti").fadeIn(200);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('getTableBasic') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'userid': "{{ $useridkar }}",
                },
                success: function(data) {
                    $(".placeholder-basic").fadeOut(200);
                    $('#tableBasic').html(data);
                }
            });
            $.ajax({
                url: "{{ url('getTablePerjanjian') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'userid': "{{ $useridkar }}",
                },
                success: function(data) {
                    $(".placeholder-perjanjian").fadeOut(200);
                    $('#tablePerjanjian').html(data);
                }
            });
            $.ajax({
                url: "{{ url('getTableStatus') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'userid': "{{ $useridkar }}",
                },
                success: function(data) {
                    $(".placeholder-status").fadeOut(200);
                    $('#tableStatus').html(data);
                }
            });
            $.ajax({
                url: "{{ url('getTableInternal') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'userid': "{{ $useridkar }}",
                },
                success: function(data) {
                    $(".placeholder-internal").fadeOut(200);
                    $('#tableInternal').html(data);
                }
            });
            $.ajax({
                url: "{{ url('getTableCuti') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'userid': "{{ $useridkar }}",
                },
                success: function(data) {
                    $(".placeholder-cuti").fadeOut(200);
                    $('#tableCuti').html(data);
                }
            });
        }
    </script>
@endsection
