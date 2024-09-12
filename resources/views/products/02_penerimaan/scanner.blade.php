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

    <?php
    
    use Carbon\Carbon;
    date_default_timezone_set('Asia/Jakarta');
    ?>
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                    class="icon icon-tabler icon-tabler-users" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                                Edit Data {{ $getKaryawan->nama }}
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('dashboard') }}"><i class="fa-solid fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#"><i class="fa-solid fa-users"></i>Penerimaan</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('penerimaan/karyawan') }}"><i class="fa fa-user"></i> Karyawan</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#"><i class="fa fa-user-pen"></i> Edit Data</a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $link = url('photo/pas/' . $getKaryawan->userid); ?>
            <?php $ktp = url('photo/ktp/' . $getKaryawan->userid); ?>
            <?php $tgkeluar = !empty($u->tglkeluar) ? Carbon::parse($u->tglkeluar)->format('d/m/Y') : ''; ?>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="card card-xl border-blue shadow rounded">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-blue">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="shadow" style="padding: 0px 0px 0px 0px">
                                                <div class="col-lg-12">
                                                    <a data-fslightbox="gallery" href="{{ $link }}.jpg">
                                                        <div class="img-responsive rounded-3 border"
                                                            style="background-image: url({{ $link }}.jpg)">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="shadow" style="padding: 0px 0px 0px 0px">
                                                <div class="col-lg-12">
                                                    <a data-fslightbox="gallery" href="{{ $ktp }}.jpg">
                                                        <div class="img-responsive rounded-3 border"
                                                            style="background-image: url({{ $ktp }}.jpg)">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="card shadow bg-info-lt mb-3">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-vcenter card-table table-sm">
                                                    <tr>
                                                        <td>Userid</td>
                                                        <td>:</td>
                                                        <td>{{ $getKaryawan->userid }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Masuk</td>
                                                        <td>:</td>
                                                        <td>{{ Carbon::parse($getKaryawan->tglmasuk)->format('d/m/Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Aktif</td>
                                                        <td>:</td>
                                                        <td>{{ Carbon::parse($getKaryawan->tglaktif)->format('d/m/Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Keluar</td>
                                                        <td>:</td>
                                                        <td>{{ $tgkeluar }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        @if ($message = Session::get('successEdit'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <div class="d-flex">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                </div>
                                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                            </div>
                                        @endif
                                        <form action="{{ route('penerimaan/karyawaneditdata') }}" method="post">
                                            @csrf
                                            <div class="card shadow bg-green-lt ">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label">No. Map</label>
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $getKaryawan->id }}" />
                                                                    <input type="hidden" name="userid"
                                                                        value="{{ $getKaryawan->userid }}" />
                                                                    <input type="text" class="form-control"
                                                                        name="nomap" placeholder=""
                                                                        value="{{ $getKaryawan->nomap }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Rekening</label>
                                                                    <input type="text" class="form-control"
                                                                        name="rekening" placeholder=""
                                                                        value="{{ $getKaryawan->bankrek }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">KTP</label>
                                                            <input type="text" class="form-control" name="nik"
                                                                placeholder="" value="{{ $getKaryawan->nik }}"
                                                                style="border-color:black" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama</label>
                                                            <input type="text" class="form-control" name="nama"
                                                                placeholder="" value="{{ $getKaryawan->nama }}"
                                                                style="border-color:black" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label">Gender</label>
                                                                    <select name="gender" id="gender"
                                                                        class="form-select border-dark">
                                                                        <option value="{{ $getKaryawan->gender }}" hidden>
                                                                            --
                                                                            {{ $getKaryawan->gender }} --</option>
                                                                        <option value="PRIA">Pria</option>
                                                                        <option value="WANITA">Wanita</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Agama</label>
                                                                    <select name="agama" id="agama"
                                                                        class="form-select border-dark">
                                                                        <option value="{{ $getKaryawan->agama }}" hidden>
                                                                            --
                                                                            {{ $getKaryawan->agama }} --</option>
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
                                                        <div class="mb-3">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label">Tinggi</label>
                                                                    <input type="text" class="form-control"
                                                                        name="tinggi" placeholder=""
                                                                        value="{{ $getKaryawan->tinggi }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Berat</label>
                                                                    <input type="text" class="form-control"
                                                                        name="berat" placeholder=""
                                                                        value="{{ $getKaryawan->berat }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tempat, Tanggal Lahir</label>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input type="text" class="form-control"
                                                                        name="tempat" placeholder=""
                                                                        value="{{ $getKaryawan->tempat }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" class="form-control"
                                                                        name="tgllahir" placeholder=""
                                                                        value="{{ $getKaryawan->tgllahir }}"
                                                                        style="border-color:black" id="datepicker3" />
                                                                    <script>
                                                                        window.Litepicker && (new Litepicker({
                                                                            element: document.getElementById("datepicker3"),
                                                                            buttonText: {
                                                                                previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                                                                                nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                                                                            },
                                                                        }));
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Alamat</label>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <textarea name="alamat" class="form-control border border-dark" id="alamat" cols="30" rows="10">{{ $getKaryawan->alamat }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Pendidikan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="pendidikan" placeholder=""
                                                                        value="{{ $getKaryawan->pendidikan }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Jurusan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="jurusan" placeholder=""
                                                                        value="{{ $getKaryawan->jurusan }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Telepon</label>
                                                                    <input type="text" class="form-control"
                                                                        name="notlp" placeholder=""
                                                                        value="{{ $getKaryawan->notlp }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Serikat</label>
                                                                    <input type="text" class="form-control"
                                                                        name="serikat" placeholder=""
                                                                        value="{{ $getKaryawan->serikat }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Email</label>
                                                                    <input type="text" class="form-control"
                                                                        name="email" placeholder=""
                                                                        value="{{ $getKaryawan->email }}"
                                                                        style="border-color:black" />
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-green">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-lg-4">
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <div class="d-flex">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                </div>
                                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                            </div>
                                        @endif
                                        <div class="card shadow bg-red-lt">
                                            <div class="card-body">
                                                <form action="{{ route('image.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="userid"
                                                        value="{{ $getKaryawan->userid }}.jpg">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputImage">Upload Pas
                                                            Photo</label>
                                                        <input type="file" name="image" id="inputImage"
                                                            class="form-control @error('image') is-invalid @enderror">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-pink">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="card shadow bg-info-lt">
                                            <div class="card-body">
                                                <form action="{{ route('image.storeKTP') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="userid"
                                                        value="{{ $getKaryawan->userid }}.jpg">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputImage">Upload Photo
                                                            KTP</label>
                                                        <input type="file" name="image" id="inputImage"
                                                            class="form-control @error('image') is-invalid @enderror">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-info">Upload</button>
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
                    <div class="form-label">Status Karyawan</div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <select name="fstatus" id="fstatus" class="form-select border-primary">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Resign">Resign</option>
                                    <option value="Habis">Habis Kontrak</option>
                                    <option value="PHK">PHK</option>
                                    <option value="*">Semua</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-label">Bagian</div>
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
                        <button type="button" class="btn btn-primary w-100" onclick="syn()" id="btn-filter">Filter
                            Data</button> <br>
                        <button type="button" class="btn btn-link w-100" id="btn-reset-items">Reset to
                            defaults</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Kamera --}}
    <div class="modal modal-blur fade" id="kamera" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form name="formCheckWawancara" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-camera" style="margin-right: 5px"></i> Upload Foto
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data-karyawan"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitCheck" class="btn btn-green"><i class="fas fa-save"
                                style="margin-right: 5px"></i> Simpan</button>
                        <button type="button" class="btn btn-link link-secondary ms-auto" data-bs-dismiss="modal"><i
                                class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal View --}}
@endsection
