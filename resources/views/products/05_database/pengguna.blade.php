@extends('layouts.app')
@section('content')
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
                            <h2 class="page-title">
                                {{ $judul }}
                            </h2>
                            <div class="text-secondary mt-1">{{ $totalUsers }} users aktif</div>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#modal-pengguna" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <i class="fa-solid fa-users-gear"></i>
                                    Tambah Pengguna
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        @foreach ($users as $user)
                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body p-4 text-center">
                                        @if ($user->role === 'admin')
                                            @if ($user->username === 'alvin')
                                                <span class="avatar avatar-xl mb-3 rounded"
                                                    style="background-image: url({{ asset('assets/static/avatars/1.jpg') }})"></span>
                                            @elseif ($user->username === 'Brian')
                                                <span class="avatar avatar-xl mb-3 rounded"
                                                    style="background-image: url({{ asset('assets/static/avatars/2.jpg') }})"></span>
                                            @elseif ($user->username === 'felixjesse')
                                                <span class="avatar avatar-xl mb-3 rounded"
                                                    style="background-image: url({{ asset('assets/static/avatars/3.jpg') }})"></span>
                                            @else
                                                <span class="avatar avatar-xl mb-3 rounded"
                                                    style="background-image: url('{{ asset('photo/pas/' . $user->userid . '.jpg') }}')"></span>
                                            @endif
                                        @else
                                            <span class="avatar avatar-xl mb-3 rounded"
                                                style="background-image: url('{{ asset('photo/pas/' . $user->userid . '.jpg') }}')"></span>
                                        @endif

                                        <h3 class="m-0 mb-1"><a href="#">{{ $user->name }}</a></h3>
                                        <h3 class="m-0 mb-1"><a href="#">{{ $user->username }}</a></h3>
                                        <div class="mt-3">
                                            <span class="badge bg-purple-lt">{{ $user->role }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <a href="#" class="card-btn edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editmodal" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}" data-username="{{ $user->username }}"
                                            data-role="{{ $user->role }}" data-password="{{ $user->password }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-bookmark-edit" width="44"
                                                height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 17l-6 4v-14a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v4" />
                                                <path
                                                    d="M18.42 15.61a2.1 2.1 0 1 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                            </svg>
                                        </a>

                                        <a href="#" class="card-btn deletePengguna" data-toggle="tooltip"
                                            data-nama="{{ $user->name }}" data-id="{{ $user->id }}"
                                            data-original-title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash-x" width="44" height="44"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7h16" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                <path d="M10 12l4 4m0 -4l-4 4" />
                                            </svg>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @include('shared.footer')
        </div>
    </div>

    {{-- Modal tambah lamaran --}}
    <div class="modal modal-blur fade" id="modal-pengguna" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fa-solid fa-users-gear"></i></i> Buat Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPengguna" name="formPengguna" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-body">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control border border-dark" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control border border-dark" name="username" id="username"
                                placeholder="Masukkan username">
                        </div>
                        <div class="mb-3">
                            <label class="col-3 col-form-label ">Role</label>
                            <div class="col border border-dark">
                                <select class="form-select" name="role">
                                    <option>--- Pilih Role ---</option>
                                    <option value="admin">ADMIN</option>
                                    <option value="hrd">HRD</option>
                                    <option value="operator">OPERATOR</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control border border-dark" name="password"
                                id="password" placeholder="Masukkan Password">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i
                                class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                        <button type="submit" id="submitedPengguna" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}

    {{-- Modal edit lamaran --}}
    <div class="modal modal-blur fade" id="editmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fa-solid fa-users-gear"></i></i> Buat Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="javascript:void(0)">
                    @csrf
                    <div class="modal-body">
                        <div class="fetched-edit-pengguna"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal edit --}}

    <script class="text/javascript">
        $(function() {
            var tablePengguna = $('#tablePengguna').DataTable({
                // Definisikan sumber data
                ajax: {
                    url: "{{ url('data/pengguna') }}",
                    type: "GET",
                    dataSrc: ""
                },
                // Definisikan kolom tabel
                columns: [{
                        data: "id",
                        title: "ID"
                    },
                    {
                        data: "name",
                        title: "Nama"
                    },
                    {
                        data: "username",
                        title: "Username"
                    },
                    {
                        data: "role",
                        title: "Role"
                    },

                ],

            });


            if ($("#formPengguna").length > 0) {
                $("#formPengguna").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        username: {
                            required: true,
                        },
                        role: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                    },
                    messages: {
                        name: {
                            required: "Masukkan Nama",
                        },
                        username: {
                            required: "Masukkan Username",
                        },
                        role: {
                            required: "Masukkan Role",
                        },
                        password: {
                            required: "Masukkan Password",
                        },
                    },
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submitedPengguna').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitedPengguna").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('store/pengguna') }}",
                            type: "POST",
                            data: $('#formPengguna').serialize(),
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
                                Swal.close();
                                $('#submitedPengguna').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitedPengguna").attr("disabled", false);
                                tablePengguna.ajax.reload();
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: response.msg,
                                });
                                document.getElementById("formPengguna").reset();
                                var sp = $('#selectPengguna').val();
                                $('#pengguna').val(sp);
                                // Delay untuk memungkinkan animasi Lottie selesai
                                setTimeout(function() {
                                        window.location.reload();
                                    },
                                    2000
                                ); // Ganti angka sesuai kebutuhan, ini milidetik (ms)
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                Swal.close();
                                tablePengguna.ajax.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submitedPengguna').html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                );
                                $("#submitedPengguna").attr("disabled", false);
                            }
                        });
                    }
                });
            }

            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var username = $(this).data('username');
                var role = $(this).data('role');
                var password = $(this).data('password');

                $('#editmodal .fetched-edit-pengguna').html(`
                <div class="card-stamp card-stamp-lg">
            <div class="card-stamp-icon bg-primary">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
                </div>
            <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control border border-dark" name="name" id="editname" value="${name}">
                </div>
            <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control border border-dark" name="username" id="editusername" value="${username}">
            </div>
            <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role" id="editrole">
                <option value="admin" ${role === 'admin' ? 'selected' : ''}>ADMIN</option>
                <option value="hrd" ${role === 'hrd' ? 'selected' : ''}>HRD</option>
                <option value="operator" ${role === 'operator' ? 'selected' : ''}>OPERATOR</option>
            </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control border border-dark" name="password" id="editpassword" value="${password}">
            </div>
            <div class="modal-footer">
            <button type="button" id="submitPengguna" class="btn btn-success" data-bs-dismiss="modal" data-id="${id}">
                <i class="fa-solid fa-pen-nib" style="margin-right:5px"></i> Update
            </button>
            </div>
            `);
            });

            $(document).on('click', '#submitPengguna', function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var csrfToken = $('form').find('input[name="_token"]').val();
                var formData = {
                    '_token': csrfToken,
                    'id': id,
                    'name': $('#editname').val(),
                    'username': $('#editusername').val(),
                    'role': $('#editrole').val(),
                    'password': $('#editpassword').val()
                };

                $.ajax({
                    url: '/update/pengguna',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: response.msg,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#editmodal').modal('hide');
                                    tablePengguna.ajax.reload();
                                    window.location
                                        .reload(); // Refresh halaman setelah dialog ditutup
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.msg,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengirim data. Silakan coba lagi.',
                        });
                    }
                });
            });

            //delete
            $('body').on('click', '.deletePengguna', function() {
                var contract_id = $(this).data("id");
                var name = $(this).data("name");
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    icon: 'warning',
                    title: 'Hapus Data Pengguna',
                    text: 'Apakah anda yakin ingin menghapus ?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('getPengguna.store') }}" + '/' + contract_id,
                            data: {
                                "_token": "{{ csrf_token() }}",
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
                                // Memunculkan pesan sukses
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal
                                            .resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: "Data Pengguna Terhapus"
                                });
                                // Memuat ulang halaman setelah 3 detik
                                setTimeout(function() {
                                    window.location.reload();
                                }, 3000);
                            },
                            error: function(data) {
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
    </script>
@endsection
