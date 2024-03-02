<link href="{{ asset('assets/extentions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/extentions/sweetalert2/sweetalert2.min.js') }}" defer></script>
{{-- <script src="{{ asset('assets/extentions/sweetalert2.js') }}" defer></script> --}}

<style>
    .alert-fade {
        transition: opacity 0.5s ease-out;
    }

    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>
<!-- End Alert -->

<!-- Alerts Unutuk menampilkan pemberitahuan sukses/gagal -->
@if (session()->get('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session()->get('error') }}",
                showConfirmButton: true,
            });
        });
    </script>
@endif

@if (session()->get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session()->get('success') }}",
                showConfirmButton: true
            });
        });
    </script>
@endif

@if (count($errors) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessages = @json($errors->all());

            for (var i = 0; i < errorMessages.length; i++) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessages[i],
                    showConfirmButton: true
                });
            }
        });
    </script>
@endif

<script>
    function confirmDelete(type, item, id) {
        Swal.fire({
            title: 'Hapus Data '+type,
            text: 'Apakah anda yakin ingin menghapus '+item+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            // if (result.isConfirmed) {
            //     // Submit the corresponding form
            //     document.getElementById(id).click();
                
            // }

            $.ajax({
                url: "index.php/DB/Login/cekLogin",
                type: "POST",
                data: {
                    "id": id,
                },
                beforeSend: function() {
                    let timerInterval
                    Swal.fire({
                        title: 'Mohon Menunggu...',
                        html: '<center><lottie-player src="https://assets9.lottiefiles.com/private_files/lf30_al2qt2jz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang Mengambil Data</h1>',
                        // html: 'Sedang Mengambil Data',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal
                                .getHtmlContainer()
                                .querySelector('b')
                            timerInterval = setInterval(
                                () => {
                                    b.textContent = Swal
                                        .getTimerLeft()
                                }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    });
                },
                success: function(response) {
                    if (response == "success") {
                        Swal.fire({
                                icon: 'success',
                                title: 'Username & Password Cocok',
                                text: 'Anda akan di arahkan ke Halaman Dashboard',
                                timer: 1000,
                                showCancelButton: false,
                                allowOutsideClick: false,
                                showConfirmButton: false
                            })
                            .then(function() {
                                window.location.href =
                                    "index.php/EK/Dashboard";
                            });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menghapus',
                            text: 'Username & Password tidak cocok',
                            allowOutsideClick: false,
                        });
                    }
                    console.log(response);
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps!',
                        text: 'server error! Please Contact Administrator',
                        allowOutsideClick: false,
                    });
                    console.log(response);
                }
            });
        });
    }
</script>

