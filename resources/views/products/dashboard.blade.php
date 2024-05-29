@extends('layouts.app')
@section('content')
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
                            <div class="page-pretitle">
                                Selamat Datang
                            </div>
                            <h2 class="page-title">
                                Halaman Dashboard
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                @if (Auth::user()->role != 'operator')
                    <div class="container-xl">
                        <div class="row row-deck row-cards mb-2">
                            <div class="card card-sm">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-users-group" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/1ce72efc-e80e-45cc-95e4-039ab16464ce/5gd18ywFpr.json"
                                                width="300px" height="300px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h1">Selamat Datang di E-HRD Online, {{ Auth::user()->name }} 🎉
                                            </h3>
                                            <div class="markdown text-secondary">
                                                Aplikasi E-HRD ini adalah aplikasi untuk Mengelola Recruitment sampai dengan
                                                Payroll di <b>PT. Plumbon International Textile.</b>
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-friends">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path
                                                            d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5" />
                                                        <path d="M17 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path
                                                            d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Recruitment
                                                </div>
                                                <div class="text-secondary">
                                                    {{ number_format($lamaran, 0, ',', '.') }} kandidat
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-green text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-star">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h.5" />
                                                        <path
                                                            d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Karyawan Aktif
                                                </div>
                                                <div class="text-secondary">
                                                    {{ number_format($karyawan, 0, ',', '.') }} orang
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-twitter text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-message-share">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M8 9h8" />
                                                        <path d="M8 13h6" />
                                                        <path
                                                            d="M13 18l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6" />
                                                        <path d="M16 22l5 -5" />
                                                        <path d="M21 21.5v-4.5h-4.5" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Surat Komunikasi
                                                </div>
                                                <div class="text-secondary">
                                                    {{ number_format($komunikasi, 0, ',', '.') }} surat
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-facebook text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                        <path d="M16 3l0 4" />
                                                        <path d="M8 3l0 4" />
                                                        <path d="M4 11l16 0" />
                                                        <path d="M8 15h2v2h-2z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Tanggal Absensi Terakhir
                                                </div>
                                                <div class="text-secondary">
                                                    {{ $absen }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-deck row-cards">
                            <div class="col-sm-12 col-lg-6">
                                <div class="card bg-blue-lt" style="height: 28rem">
                                    <div class="card-header border-0">
                                        <div class="card-title"><i class="fa-solid fa-file-signature"></i> Kontrak Akan
                                            Berakhir</div>
                                    </div>
                                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                        <div class="divide-y">
                                            @foreach ($kontrak as $item)
                                                <div>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span class="avatar"
                                                                style="background-image: url({{ url('photo/pas/' . $item->userid) }}.jpg)"></span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="text-truncate">
                                                                <a
                                                                    href="penerimaan/legalitas/edit/{{ $item->userid }}"><strong>{{ $item->nama }}</strong></a>
                                                                {{ $item->nmsurat }} :
                                                                <strong>{{ $item->suratket }}</strong>.
                                                            </div>
                                                            <div class="text-secondary">
                                                                <i class="fa-solid fa-calendar-days"
                                                                    style="margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($item->tglak)->isoFormat('D MMMM Y') }}
                                                                <i class="fa-solid fa-circle-right"
                                                                    style="margin-left: 10px;margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($item->tglak)->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="badge bg-primary"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="text-truncate" style="text-align: right;">
                                                            Lihat Semuanya
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M5 12l14 0" />
                                                                <path d="M13 18l6 -6" />
                                                                <path d="M13 6l6 6" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6">
                                <div class="card bg-red-lt" style="height: 28rem">
                                    <div class="card-header border-0">
                                        <div class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Surat
                                            Peringatan</div>
                                    </div>
                                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                        <div class="divide-y">
                                            @foreach ($sp as $itemsp)
                                                <div>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span class="avatar"
                                                                style="background-image: url({{ url('photo/pas/' . $itemsp->userid) }}.jpg)"></span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="text-truncate">
                                                                <a
                                                                    href="penerimaan/legalitas/edit/{{ $item->userid }}"><strong>{{ $itemsp->nama }}</strong></a>
                                                                :
                                                                <strong>{{ $itemsp->keterangan }}</strong>.
                                                            </div>
                                                            <div class="text-secondary">
                                                                <i class="fa-solid fa-calendar-days"
                                                                    style="margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($itemsp->legalitastgl)->isoFormat('D MMMM Y') }}
                                                                <i class="fa-solid fa-circle-right"
                                                                    style="margin-left: 10px;margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($itemsp->legalitastgl)->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="badge bg-primary"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="text-truncate" style="text-align: right;">
                                                            Lihat Semuanya
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M5 12l14 0" />
                                                                <path d="M13 18l6 -6" />
                                                                <path d="M13 6l6 6" />
                                                            </svg>
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
                @else
                    <div class="container-xl">
                        <div class="row row-deck row-cards mb-2">
                            <div class="card card-sm">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-users-group" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/1ce72efc-e80e-45cc-95e4-039ab16464ce/5gd18ywFpr.json"
                                                width="300px" height="300px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h1">Selamat Datang di E-HRD Online, {{ Auth::user()->name }} 🎉
                                            </h3>
                                            <div class="markdown text-secondary">
                                                Aplikasi E-HRD ini adalah aplikasi untuk Mengelola Recruitment sampai dengan
                                                Payrolldi <b>PT. Plumbon International Textile.</b>
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @include('shared.footer')
        </div>
    </div>
@endsection
