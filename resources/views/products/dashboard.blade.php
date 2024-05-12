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
                <div class="container-xl">
                    <div class="row row-deck row-cards mb-2">
                        <div class="card card-sm">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                        <h3 class="h1">Selamat Datang di E-HRD Online, {{ Auth::user()->name }} 🎉</h3>
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

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-friends">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5" />
                                                    <path d="M17 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4" />
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
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                            <span
                                                class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z">
                                                    </path>
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
                                            <span
                                                class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Aktif
                                            </div>
                                            <div class="text-secondary">
                                                21 item
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
                                                            <strong>{{ $item->nama }}</strong> {{ $item->nmsurat }} :
                                                            <strong>{{ $item->suratket }}</strong>.
                                                        </div>
                                                        <div class="text-secondary">
                                                            <i class="fa-solid fa-calendar-days"
                                                                style="margin-right: 3px"></i>
                                                            {{ \Carbon\Carbon::parse($item->tglak)->format('d-m-Y') }}
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
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
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
                                                            <strong>{{ $itemsp->nama }}</strong> :
                                                            <strong>{{ $itemsp->keterangan }}</strong>.
                                                        </div>
                                                        <div class="text-secondary">
                                                            <i class="fa-solid fa-calendar-days"
                                                                style="margin-right: 3px"></i>
                                                            {{ \Carbon\Carbon::parse($itemsp->legalitastgl)->format('d-m-Y') }}
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
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
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
            </div>
            @include('shared.footer')
        </div>
    </div>
@endsection
