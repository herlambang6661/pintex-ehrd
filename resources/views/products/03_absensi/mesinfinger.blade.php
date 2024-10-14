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

        .unselectable {
            -webkit-user-select: none;
            -webkit-touch-callout: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #cc0000;
            font-weight: bolder;
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-red" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint-scan">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 11a3 3 0 0 1 6 0c0 1.657 .612 3.082 1 4" />
                                    <path d="M12 11v1.75c-.001 1.11 .661 2.206 1 3.25" />
                                    <path d="M9 14.25c.068 .58 .358 1.186 .5 1.75" />
                                    <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                    <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                    <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                </svg>
                                Mesin Fingerprint
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fas fa-fingerprint"></i> Mesin Fingerprint <i
                                                class="text-red">(Restricted Area)</i></a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        {{-- <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <div class=" d-none d-sm-inline-block">
                                        <input type="date" name="" id="" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class=" d-none d-sm-inline-block">
                                        <input type="date" name="" id="" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <a href="{{ url('absensi/fingerprint') }}" class="btn btn-primary d-none d-sm-inline-block">
                                        <i class="fa-solid fa-fingerprint"></i>
                                        Perbarui
                                    </a>
                                    <a href="{{ url('absensi/absensi') }}" class="btn btn-secondary d-none d-sm-inline-block">
                                        <i class="fa-solid fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                    <a href="#" class="btn btn-danger d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-lamaran" aria-label="Tambah Lamaran">
                                        <i class="fa-solid fa-person-running"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-upload" aria-label="Upload Excel">
                                        <i class="fa-solid fa-user-slash"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-upload" aria-label="Upload Excel">
                                        <i class="fa-solid fa-fingerprint"></i>
                                    </a>
                                </div>
                            </div> --}}
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card card-xl shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-dark">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                {{-- <table style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;" class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap datatable-karyawan" id="tblamaran">
                                        <thead>
                                            <tr>
                                                <th>USERID</th>
                                                <th>NAME</th>
                                                <th>BADGENUMBER</th>
                                                <th>SSN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($playlist as $dt)
                                                <tr>
                                                    <td>{{ $dt->USERID }}</td>
                                                    <td>{{ $dt->Name }}</td>
                                                    <td>{{ $dt->Badgenumber }}</td>
                                                    <td>{{ $dt->CHECKTIME }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> --}}
                                <div class="card-body">
                                    <div class="row row-deck row-cards">
                                        <div class="col-md-6 col-xl-3 col-12">
                                            <div class="card card-sm bg-red-lt">
                                                <a href="{{ url('lokal/daftarfinger') }}"
                                                    style="text-decoration: none !important;color: inherit;">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <span class="bg-red text-white avatar">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-edit">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                                                        <path
                                                                            d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="font-weight-medium">
                                                                    Daftar Fingerprint
                                                                </div>
                                                                <div class="text-secondary small lh-base">
                                                                    Opsi untuk mendaftarkan karyawan ke mesin finger
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-3 col-12">
                                            <div class="card card-sm bg-success-lt">
                                                <a href="{{ url('lokal/rawfinger') }}"
                                                    style="text-decoration: none !important;color: inherit;">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <span class="bg-success text-white avatar">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                                                                        <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" />
                                                                        <path d="M12 11v2a14 14 0 0 0 2.5 8" />
                                                                        <path d="M8 15a18 18 0 0 0 1.8 6" />
                                                                        <path
                                                                            d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="font-weight-medium">
                                                                    Raw Fingerprint
                                                                </div>
                                                                <div class="text-secondary small lh-base">
                                                                    Opsi untuk menarik data dari database mesin finger
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-3 col-12">
                                            <div class="card card-sm bg-warning-lt">
                                                <a href="{{ url('lokal/localabsence') }}"
                                                    style="text-decoration: none !important;color: inherit;">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <span class="bg-warning text-white avatar">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-cell-signal-off">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M20 20h-15.269a.731 .731 0 0 1 -.517 -1.249l7.265 -7.264m2 -2l5.272 -5.272a.731 .731 0 0 1 1.249 .517v11.269" />
                                                                        <path d="M3 3l18 18" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="font-weight-medium">
                                                                    Kelola Absen Lokal
                                                                </div>
                                                                <div class="text-secondary small lh-base">
                                                                    Opsi untuk Mengelola absensi di Lokal sebelum upload ke
                                                                    Cloud
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-3 col-12">
                                            <div class="card card-sm bg-primary-lt">

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-small"
                                                    style="text-decoration: none !important;color: inherit;">
                                                    {{-- <a href="#" id="btnUploadFixed" style="text-decoration: none !important;color: inherit;"> --}}
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <span class="bg-primary text-white avatar">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-upload">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                                                        <path d="M9 15l3 -3l3 3" />
                                                                        <path d="M12 12l0 9" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="font-weight-medium">
                                                                    Upload Fixed Fingerprint
                                                                </div>
                                                                <div class="text-secondary small lh-base">
                                                                    Melanjutkan ke proses selanjutnya setelah kelola absensi
                                                                    lokal sudah selesai.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table table-vcenter card-table">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Access</th>
                                                                <th>Local</th>
                                                                <th>Server</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Userinfo</td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_user_access, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_user_local, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_user_server, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Fingerprint</td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_finger_access, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_finger_local, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_finger_server, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Absensi</td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_absen_access, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_absen_local, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-secondary">
                                                                    {{ number_format($count_absen_server, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
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
            </div>
            <div class="modal modal-blur fade" id="modal-small" tabindex="-1" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-title">Upload Data?</div>
                            <div>Pilih Tanggal Upload.</div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <select id="tglUploadFixed" class="form-select">
                                        <option value="<?= date('m') ?>" selected="selected">-- <?= date('F') ?> --
                                        </option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <select id="tahunUploadFixed" class="form-select">
                                        <?php
                                        $already_selected_value = date('Y');
                                        $earliest_year = 2022;
                                        foreach (range(date('Y'), $earliest_year) as $x) {
                                            print '<option value="' . $x . '"' . ($x === $already_selected_value ? ' selected="selected"' : '') . '>' . $x . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link link-secondary me-auto"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-blue" data-bs-dismiss="modal"
                                id="btnUploadFixed">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('shared.footer')
            <script>
                $('#btnUploadFixed').click(function() {
                    var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        icon: 'question',
                        title: 'Upload Data Absen Fix',
                        text: 'Apakah anda yakin ingin Upload data absen  yang sudah fix dari Lokal ke Cloud ? Proses akan membutuhkan waktu yang cukup lama, mohon bersabar.',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: ' Ya',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ url('UploadFixedAbsen') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'tglUploadFixed': $('#tglUploadFixed').val(),
                                    'tahunUploadFixed': $('#tahunUploadFixed').val(),
                                },
                                beforeSend: function() {
                                    Swal.fire({
                                        title: 'Mohon Menunggu',
                                        html: '<center><lottie-player src="https://lottie.host/f6ad03a7-1560-4082-8f73-eba358540a2a/jwBLWkLRwZ.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang Sinkronisasi data, Proses mungkin membutuhkan beberapa menit. Proses akan membutuhkan waktu yang cukup lama, mohon bersabar.<br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    });
                                },
                                success: function(data) {
                                    console.log(data);
                                    // tableAbsensi.ajax.reload();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal.stopTimer;
                                            toast.onmouseleave = Swal.resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: "Berhasil Upload ke Cloud"
                                    });
                                },
                                error: function(data) {
                                    console.log(data);
                                    console.log('Error:', data.error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Error: ' + data.responseText,
                                        showConfirmButton: true,
                                    });
                                    // tableAbsensi.ajax.reload();
                                }
                            });
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection
