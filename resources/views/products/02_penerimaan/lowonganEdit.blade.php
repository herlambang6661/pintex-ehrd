@extends('layouts.app')
@section('content')
    <style>
        .img-preview-container {
            position: relative;
            display: inline-block;
            margin-top: 10px;
        }

        .img-preview {
            width: 250px;
            height: auto;
            display: block;
        }

        .remove-img-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            cursor: pointer;
            font-size: 12px;
            line-height: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
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
            font-size: 10px;
        }
    </style>
    {{-- CALL TINYMCE --}}
    <x-head.tinymce-config />

    <div class="page">
        <!-- Sidebar -->
        @include('shared.sidebar')
        <!-- Navbar -->
        @include('shared.navbar')

        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                    class="icon icon-tabler icon-tabler-clipboard-text" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12h6" />
                                    <path d="M9 16h6" />
                                </svg>
                                Lowongan
                                <div id="entitasText" style="margin-left: 5px;">Loading... <i
                                        class="fa-solid fa-spinner fa-spin-pulse"></i> </div>
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                                            Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-user-pen"></i>
                                            Penerimaan</a></li>
                                    <li class="breadcrumb-item"><a href="#"><i class="fa-regular fa-paste"></i>
                                            Lowongan Pekerjaan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-regular fa-paste"></i> Tambah Lowongan Pekerjaan</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row mt-4">
                    <form action="{{ route('lowongan.update', $lwn->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Lowongan Pekerjaan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Entitas</label>
                                                <input type="text" name="entitas" id="entitas"
                                                    class="form-control bg-secondary-lt cursor-not-allowed" readonly
                                                    value="{{ old('entitas', $lwn->entitas) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Buka</label>
                                                <input type="date" name="tglbuka" id="tglbuka" class="form-control"
                                                    value="{{ old('tglbuka', $lwn->tgl_buka) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Tutup</label>
                                                <input type="date" name="tgltutup" id="tgltutup" class="form-control"
                                                    value="{{ old('tgltutup', $lwn->tgl_tutup) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" style="color: white">Tdk Ada Batas
                                                    Pendaftaran</label>
                                                <div>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="tdkadatgl" id="tdkadatgl"
                                                            class="form-check-input" value="1"
                                                            {{ old('tdkadatgl', $lwn->unlimited) ? 'checked' : '' }}>
                                                        <span class="form-check-label">Tdk Ada Batas Tanggal</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lowongan Untuk</label>
                                                <input type="text" name="lowongan" id="lowongan" class="form-control"
                                                    placeholder="Operator Produksi, Helper Gudang"
                                                    value="{{ old('lowongan', $lwn->posisi) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Pendidikan Minimal</label>
                                                <input type="text" name="pendidikan" id="pendidikan"
                                                    class="form-control" placeholder="SD, SMP, SMA, D3, S1"
                                                    value="{{ old('pendidikan', $lwn->pendidikan) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-md-6">
                                            <div class="form-label">Foto</div>
                                            <input type="file" class="form-control" name="image" id="imageInput"
                                                onchange="previewImage(event)" accept="image/*" />
                                            @if ($lwn->image)
                                                <img src="{{ asset('storage/' . $lwn->image) }}" alt="Current Image"
                                                    id="currentImage" class="img-preview"
                                                    style="max-width: 150px; max-height: 150px;">
                                                <button type="button" class="remove-img-btn"
                                                    onclick="removeImage()">X</button>
                                            @endif
                                            <div class="img-preview-container" id="imgPreviewContainer"
                                                style="display: none;">
                                                <img id="imgPreview" class="img-preview"
                                                    style="max-width: 150px; max-height: 150px;" />
                                                <button type="button" class="remove-img-btn"
                                                    onclick="removeImage()">X</button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Dokumen Tambahan</label>
                                                <div>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="simA" id="simA"
                                                            class="form-check-input" value="1"
                                                            {{ old('simA', $lwn->sima) ? 'checked' : '' }}>
                                                        <span class="form-check-label">SIM A</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="simB" id="simB"
                                                            class="form-check-input" value="1"
                                                            {{ old('simB', $lwn->simb) ? 'checked' : '' }}>
                                                        <span class="form-check-label">SIM B</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="simB2" id="simB2"
                                                            class="form-check-input" value="1"
                                                            {{ old('simB2', $lwn->simb2) ? 'checked' : '' }}>
                                                        <span class="form-check-label">SIM B2 Umum</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input type="checkbox" name="sio" id="sio"
                                                            class="form-check-input" value="1"
                                                            {{ old('sio', $lwn->sio) ? 'checked' : '' }}>
                                                        <span class="form-check-label">Sertifikat SIO Forklift</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">Requirement Pekerjaan</label>
                                                <div class="border-success shadow rounded">
                                                    <textarea id="myeditorinstance" name="requirement" class="form-control" rows="6">{{ old('requirement', $lwn->deskripsi) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                                        <i class="fa-solid fa-user-plus"></i>
                                        Update
                                    </button>
                                    <a href="{{ route('penerimaan.lowongan') }}" type="button"
                                        class="btn btn-success d-none d-sm-inline-block">
                                        <i class="fa-solid fa-backward"></i>
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            @include('shared.footer')
        </div>
    </div>
    <script>
        // const someCheckbox = document.getElementById('someID');
        document.getElementById('tdkadatgl').addEventListener('change', e => {
            if (e.target.checked === true) {
                console.log("Checkbox is checked - boolean value: ", e.target.checked)
                document.getElementById('tglbuka').disabled = true;
                document.getElementById('tglbuka').classList.add("cursor-not-allowed");
                document.getElementById('tgltutup').disabled = true;
                document.getElementById('tgltutup').classList.add("cursor-not-allowed");
                document.getElementById('tdkadatgl').value = "1";
            }
            if (e.target.checked === false) {
                console.log("Checkbox is not checked - boolean value: ", e.target.checked)
                document.getElementById('tglbuka').disabled = false;
                document.getElementById('tglbuka').classList.remove("cursor-not-allowed");
                document.getElementById('tgltutup').disabled = false;
                document.getElementById('tgltutup').classList.remove("cursor-not-allowed");
                document.getElementById('tdkadatgl').value = "0";
            }
        });

        function previewImage(event) {
            const imgPreviewContainer = document.getElementById('imgPreviewContainer');
            const imgPreview = document.getElementById('imgPreview');
            imgPreviewContainer.style.display = 'block';
            imgPreview.src = URL.createObjectURL(event.target.files[0]);
        }

        function removeImage() {
            const imgPreviewContainer = document.getElementById('imgPreviewContainer');
            const imgPreview = document.getElementById('imgPreview');
            const currentImage = document.getElementById('currentImage');

            imgPreviewContainer.style.display = 'none';

            document.getElementById('imageInput').value = '';

            if (currentImage) {
                currentImage.style.display = 'none';
            }
        }
    </script>
@endsection
