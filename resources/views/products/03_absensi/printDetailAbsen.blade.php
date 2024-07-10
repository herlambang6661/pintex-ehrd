    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>EHRD - PT PINTEX (Stand Alone).</title>
        <!-- CSS files -->
        <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/extentions/select2/css/select2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/extentions/datatables/Select-1.6.0/css/select.bulma.min.css') }}" rel="stylesheet">
        <style>
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </head>

    <?php
    
    use Carbon\Carbon;
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <style type="text/css">
        @media screen {
            div#headerPrint {
                display: none
            }
        }
    </style>
    <style type="text/css">
        @media print {
            div#headerPrint {
                display: block
            }
        }
    </style>

    <div id="headerPrint" style="margin-top:5px;margin-left:5px">
        <?php
        echo '<i>Tanggal Print : ' . date('H:i:s d/m/Y') . '</i><br><br>';
        ?>
    </div>
    <div class="card" id='PrintPre' style="border-color: white; border-style: solid;">
        <div class="card-body" style="color: black;">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ url('photo/icon/pintex.png') }}" class="" alt="PT. PINTEX" srcset=""
                        width="150px"><br>
                    {{-- <h3 style="margin-top:10px">PT PINTEX</h3> --}}
                    <p style="font-size: 8px; margin-top:0px" class="text-center">
                        Jln. Raya Cirebon-Bandung Km.12 Plumbon-Cirebon<br>
                        Phone : 62-231-321366 (HUNTING) Faximile : 62-231-321389
                    </p>
                </div>
                <?php
                foreach ($karyawan as $key => $v) {
                    $stb = $v->stb;
                    $nama = $v->nama;
                    $divisi = $v->divisi;
                    $jabatan = $v->jabatan;
                }
                ?>
                <div class="col-md-8" style="margin-top: 20px">
                    <u class="text-center">
                        <h2><b>DATA KEHADIRAN {{ $nama }}</b></h2>
                    </u>
                </div>
            </div>
            <hr style="margin-top: 5px;">
            <div class="container">
                <table class="table table-sm table-borderless"
                    style="color: black; border-color: black;text-transform: uppercase; font-size:10px">
                    <tr>
                        <td style="width: 10px">STB</td>
                        <td style="width: 5px">:</td>
                        <td>{{ $stb }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $nama }}</td>
                    </tr>
                    <tr>
                        <td>Divisi</td>
                        <td>:</td>
                        <td>{{ $divisi }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{ $jabatan }}</td>
                    </tr>
                </table>
                <table class="table table-sm table-bordered"
                    style="color: black; border-color: black;text-transform: uppercase; font-size:10px">
                    <thead class="text-black" style="border-color: black;">
                        <th style="border-color: black;" class="text-center">Tanggal</th>
                        <th style="border-color: black;" class="text-center">Hari</th>
                        <th style="border-color: black;" class="text-center">In</th>
                        <th style="border-color: black;" class="text-center">Out</th>
                        <th style="border-color: black;" class="text-center">QJAM</th>
                        <th style="border-color: black;" class="text-center">ISH</th>
                        <th style="border-color: black;" class="text-center">JK</th>
                        <th style="border-color: black;" class="text-center">ST</th>
                        <th style="border-color: black;" class="text-center">Surat Komunikasi</th>
                        <th style="border-color: black;" class="text-center">Keterangan</th>
                    </thead>
                    <?php $i = 1; ?>
                    <tbody class="text-black" style="border-color: black;">
                        @foreach ($absensi as $key => $w)
                            <tr>
                                <td class="text-center">{{ $w->tanggal }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($w->tanggal)->isoFormat('dddd') }}
                                </td>
                                <td class="text-center">
                                    {{ !empty($w->in) ? \Carbon\Carbon::parse($w->in)->format('H:i:s') : '' }}
                                </td>
                                <td class="text-center">
                                    {{ !empty($w->out) ? \Carbon\Carbon::parse($w->out)->format('H:i:s') : '' }}
                                </td>
                                <td class="text-center">{{ $w->qj }}</td>
                                <td class="text-center">{{ $w->jis }}</td>
                                <td class="text-center">{{ $w->qjnet }}</td>
                                <td class="text-center">{{ $w->sst }}</td>
                                <td class="text-center">{{ $w->suratid }}</td>
                                <td class="text-center">{{ $w->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
