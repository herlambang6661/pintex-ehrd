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
    </style>

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
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"><i
                                                class="fa-regular fa-paste"></i> Lowongan Pekerjaan</a></li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="/penerimaan/tambahlowongan" class="btn btn-primary d-none d-sm-inline-block">
                                    <i class="fa-solid fa-user-plus"></i>
                                    Tambah Lowongan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Card with Carousel for displaying job images -->
                {{-- <div class="card mt-4">
                    <div class="card-body">
                        <div id="jobCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/static/avatars/5.jpeg') }}" class="d-block w-100"
                                        style="max-height: 400px; object-fit: cover;" alt="Job Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/static/avatars/4.jpeg') }}" class="d-block w-100"
                                        style="max-height: 400px; object-fit: cover;" alt="Job Image 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/static/avatars/3.jpeg') }}" class="d-block w-100"
                                        style="max-height: 400px; object-fit: cover;" alt="Job Image 2">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#jobCarousel" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#jobCarousel" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div> --}}

                <!-- Row for job information cards -->
                <div class="row mt-4">
                    @forelse($loker as $l)
                        <!-- Card 1 -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h2 class="mb-0">{{ $l->posisi }}</h2>
                                    <div class="d-flex align-items-center">
                                        <form action="{{ route('updateRelease', $l->id) }}" method="POST" class="me-2">
                                            @csrf
                                            <button class="btn" type="submit">
                                                @if ($l->release == 1)
                                                    Active <span class="badge bg-blue ms-2"><i
                                                            class="fa-solid fa-check"></i></span>
                                                @else
                                                    InActive <span class="badge bg-red ms-2"><i
                                                            class="fa-solid fa-xmark"></i></span>
                                                @endif
                                            </button>
                                        </form>
                                        <form id="delete-form-{{ $l->id }}"
                                            action="{{ route('lowongan.destroy', $l->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal-{{ $l->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-2">Pendidikan: {{ $l->pendidikan }}</h4>
                                        <h4 class="mb-2">Entitas : {{ $l->entitas }}</h4>
                                        <p class="mb-2">
                                            Tanggal :
                                            {{ $l->unlimited == 1 ? 'Tidak ada batas tanggal' : date('d/m/Y', strtotime($l->tgl_buka)) . ' s/d ' . date('d/m/Y', strtotime($l->tgl_tutup)) }}
                                        </p>
                                        {{ $l->sio == 0 ? '' : '- Sertifikat SIO Forklift Dibutuhkan' }}
                                    </div>
                                    <div style="max-width: 100px; max-height: 100px; margin-left: 15px;">
                                        <img src="{{ Storage::url($l->image) }}" class="img-fluid rounded"
                                            style="object-fit: cover; width: 100%; height: 100%;" alt="Job Image 1">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="{{ route('penerimaan.editlowongan', $l->id) }}" class="text-primary">
                                                Edit loker
                                                <i class="ms-2 fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                        <div class="col text-center">
                                            <a href="#" class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-show{{ $l->id }}">
                                                Lihat loker
                                                <i class="ms-2 fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <h3>No data available</h3>
                        </div>
                    @endforelse
                    {{ $loker->links() }}
                </div>

            </div>

            @include('shared.footer')
        </div>
    </div>

    {{-- modal view --}}
    @foreach ($loker as $l)
        <div class="modal" id="modal-show{{ $l->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <!-- Details -->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="mb-4 d-flex justify-content-between">
                                                <div>
                                                    <span class="badge rounded-pill bg-info mb-2">
                                                        <span class="mdi mdi-account-hard-hat"></span>
                                                        {{ $l->posisi }}
                                                    </span>
                                                    <span class="badge rounded-pill bg-warning mb-2">
                                                        <span class="mdi mdi-clipboard-text-clock"></span>
                                                        {{ $l->unlimited == 1 ? 'Tidak ada batas tanggal' : date('d/m/Y', strtotime($l->tgl_buka)) . ' s/d ' . date('d/m/Y', strtotime($l->tgl_tutup)) }}
                                                    </span>
                                                    <span class="mb-2 badge rounded-pill bg-success">
                                                        <span class="mdi mdi-school"></span>
                                                        {{ $l->pendidikan }}
                                                    </span>
                                                </div>
                                                {{-- <div class=" badge rounded-pill bg-primary">
                                            <span class="mdi mdi-factory"></span>
                                            PT {{ $l->entitas }}
                                        </div> --}}
                                            </div>
                                            <div class="mb-5 p-4">
                                                {!! $l->deskripsi !!}
                                            </div>
                                            <div
                                                style="max-width: 100px; max-height: 100px; margin-left: 15px; margin-bottom: 15px;">
                                                <img src="{{ Storage::url($l->image) }}" class="img-fluid rounded"
                                                    style="object-fit: cover; width: 100%; height: 100%;"
                                                    alt="Job Image 1">
                                            </div>
                                            @if ($l->unlimited != 1)
                                                <div class="mb-0 d-flex justify-content-between">
                                                    <div>
                                                        <span class="me-3 badge rounded-pill bg-danger">
                                                            <span class="mdi mdi-timer-alert-outline"></span>
                                                            Ditutup
                                                            {{ \Carbon\Carbon::parse($l->tgl_tutup)->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal destroy --}}
        <!-- Modal -->
        <div class="modal" id="confirmDeleteModal-{{ $l->id }}" tabindex="-1"
            aria-labelledby="confirmDeleteModalLabel-{{ $l->id }}" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v2m0 4v.01" />
                            <path
                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                        <h3>Apakah Anda Yakin Ingin Mengapus Lowongan ini {{ $l->posisi }}?</h3>
                        <div class="text-secondary">Anda akan menghapus posisi ini dengan permanen.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <button class="btn w-100" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger w-100"
                                        onclick="document.getElementById('delete-form-{{ $l->id }}').submit()">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal view --}}
    <script>
        const fotoInput = document.querySelector('input[type="file"]');
        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreviewContainer = document.createElement('div');
                    imgPreviewContainer.classList.add('img-preview-container');

                    const imgPreview = document.createElement('img');
                    imgPreview.src = e.target.result;
                    imgPreview.classList.add('img-preview');

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = 'X';
                    removeBtn.classList.add('remove-img-btn');
                    removeBtn.addEventListener('click', function() {
                        imgPreviewContainer.remove();
                        fotoInput.value = '';
                    });

                    imgPreviewContainer.appendChild(imgPreview);
                    imgPreviewContainer.appendChild(removeBtn);

                    const oldPreviewContainer = document.querySelector('.img-preview-container');
                    if (oldPreviewContainer) {
                        oldPreviewContainer.remove();
                    }

                    fotoInput.parentElement.appendChild(imgPreviewContainer);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    {{-- sweetalert destroy --}}
@endsection
