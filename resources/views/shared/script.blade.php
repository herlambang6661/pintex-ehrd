<!-- Libs JS -->
<script src="{{ asset('assets/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062') }}" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('assets/dist/js/tabler.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/js/demo.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/litepicker/dist/litepicker.js') }}" defer></script>
<script src="{{ asset('assets/dist/libs/fslightbox/index.js?1684106062') }}" defer></script>

<script src="{{ asset('assets/extentions/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/extentions/jquery.validate.min.js') }}"></script>

<link href="{{ asset('assets/extentions/xeditable/jquery-editable.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/extentions/xeditable/jquery-editable-poshytip.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/extentions/datatables/datatables.min.js') }}"></script>
<link href="{{ asset('assets/extentions/datatables/DataTables-1.13.4/css/dataTables.bootstrap5.css') }}"
    rel="stylesheet">
<link href="{{ asset('assets/extentions/datatables/Buttons-2.3.4/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/extentions/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/DataTables-1.13.4/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.bootstrap5.min.js') }}"></script>

<script src="{{ asset('assets/extentions/datatables/Select-1.6.0/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Select-1.6.0/js/select.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/FixedColumns-4.2.1/js/dataTables.fixedColumns.min.js') }}">
</script>

<script src="{{ asset('assets/extentions/select2/js/select2.full.min.js') }}" defer></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="{{ asset('assets/extentions/richtext/jquery.richtext.min.js') }}"></script>
<script src="{{ asset('assets/extentions/jquery.mask.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $('#entitasText').html($('#selectEntitas').val());
        $('#entitas').val($('#selectEntitas').val());
        $('#selectEntitas').on('keydown keyup load change hover', function() {
            var sp = this.value;
            console.log("Entitas Terpilih: " + sp);
            $('#entitasText').html(sp);
            $('#entitas').val(sp);
        });
    });
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('datepicker0'),
            buttonText: {
                previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
        window.Litepicker && (new Litepicker({
            element: document.getElementById('datepicker1'),
            buttonText: {
                previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
        window.Litepicker && (new Litepicker({
            element: document.getElementById('datepicker2'),
            buttonText: {
                previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
    });
    // @formatter:on

    $(document).ready(function() {
        $('.formattahun').mask('0000');
    });

    // JS Pencarian Start
    $("#myInput").keyup(function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            alert('AA');
        }
    });
    // JS Pencarian End
</script>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(sendLocationToServer);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function sendLocationToServer(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        fetch('/update-location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    latitude,
                    longitude
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        document.addEventListener('DOMContentLoaded', getLocation);

    }

    // function updateTime() {
    //     const now = new Date();

    //     const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    //     const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
    //         'Oktober', 'November', 'Desember'
    //     ];

    //     const dayName = days[now.getDay()];
    //     const day = now.getDate();
    //     const month = months[now.getMonth()];
    //     const year = now.getFullYear();
    //     const hour = String(now.getHours()).padStart(2, '0');
    //     const minute = String(now.getMinutes()).padStart(2, '0');
    //     const second = String(now.getSeconds()).padStart(2, '0');

    //     const formattedTime = `${dayName}, ${day} ${month} ${year}, ${hour}:${minute}:${second} WIB`;
    //     document.getElementById('CRMDateRange').value = formattedTime;
    // }

    // setInterval(updateTime, 1000);

    // updateTime();
</script>
