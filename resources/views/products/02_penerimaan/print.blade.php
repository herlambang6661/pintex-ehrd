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
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        @media print {
            .pagebreak {
                page-break-before: always;
            }

            /* page-break-after works, as well */
        }
    </style>
</head>

<?php
date_default_timezone_set('Asia/Jakarta');
echo '<i>Tanggal Print : ' . date('H:i:s d-m-Y') . '</i>';
?>
<div class="card" id='PrintPre' style="border-color: white; border-style: solid; margin:10px,10px,10px,10px;">
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
            <div class="col-md-8" style="margin-top: 30px">
                <u class="text-center">
                    <h2><b>PENILAIAN WAWANCARA</b></h2>
                </u>
            </div>
        </div>
        <hr style="margin-top: 5px;">
        <i>
            <h6>Tanggal : </h6>
            <h6>No Form : {{ $noform }}</h6>
        </i>
        <br>
        <table class="table table-sm table-bordered text-nowrap"
            style="color: black; border-color: black;text-transform: uppercase; font-size:11px">
            <thead class="text-black" style="border-color: black;">
                <th style="border-color: black;" class="text-center">No</th>
                <th style="border-color: black;" class="text-center">Nama</th>
                <th style="border-color: black;" class="text-center">Pendidikan</th>
                <th style="border-color: black;" class="text-center">Telp</th>
                <th style="border-color: black;" class="text-center">Tinggi</th>
                <th style="border-color: black;" class="text-center">Berat</th>
                <th style="border-color: black;" class="text-center">Buta Warna</th>
                <th style="border-color: black;" class="text-center">Jalan</th>
                <th style="border-color: black;" class="text-center">Mata</th>
                <th style="border-color: black;" class="text-center">Keterangan</th>
            </thead>
            <?php $i = 1; ?>
            @foreach ($getData as $key => $w)
                <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td class="text-center">{{ $w->nama }}</td>
                    <td class="text-center">{{ $w->pendidikan . ' ' . $w->jurusan }}</td>
                    <td class="text-center">{{ $w->notlp }}</td>
                    <td class="text-center">{{ $w->tinggi }}</td>
                    <td class="text-center">{{ $w->berat }}</td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                </tr>
                <?php $i++; ?>
            @endforeach
            <tr>
                <td class="text-center text-white" style="color: white">{{ $i }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center text-white" style="color: white">{{ $i }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <i>*Note : </i>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="row text-center">
            <div class="col">
                HRD,
            </div>
            <div class="col">
            </div>
            <div class="col">
                User,
            </div>
        </div>
        <br><br><br><br><br>
        <div class="row text-center">
            <div class="col">
                ( ............................................. )
            </div>
            <div class="col">
            </div>
            <div class="col">
                ( ............................................. )
            </div>
        </div>

    </div>
</div>

<div class="pagebreak"> </div> {{-- Ganti Page --}}

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
            <div class="col-md-8" style="margin-top: 30px">
                <u class="text-center">
                    <h2><b>DAFTAR KEHADIRAN WAWANCARA</b></h2>
                </u>
            </div>
        </div>
        <hr style="margin-top: 5px;">
        <div class="container">
            <i>
                <h6>Tanggal : </h6>
                <h6>No Form : {{ $noform }}</h6>
            </i>
            <br>
            <table class="table table-sm table-bordered text-nowrap"
                style="color: black; border-color: black;text-transform: uppercase; font-size:11px">
                <thead class="text-black" style="border-color: black;">
                    <th style="border-color: black;" class="text-center">No</th>
                    <th style="border-color: black;" class="text-center">Nama</th>
                    <th style="border-color: black;" class="text-center">Paraf</th>
                </thead>
                <?php $i = 1; ?>
                @foreach ($getData as $key => $w)
                    <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td class="text-center">{{ $w->nama }}</td>
                        <td class="text-center"></td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                <tr>
                    <td class="text-center text-white" style="color: white">{{ $i }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center text-white" style="color: white">{{ $i }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center text-white" style="color: white">{{ $i }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <i>*Note : </i>
            <br>
            <br>
            <br>
            <br>
            <br>
            {{-- <div class="row text-center">
                <div class="col">
                    HRD,
                </div>
                <div class="col">
                </div>
                <div class="col">
                    User,
                </div>
            </div>
            <br><br><br><br><br>
            <div class="row text-center">
                <div class="col">
                    ( ............................................. )
                </div>
                <div class="col">
                </div>
                <div class="col">
                    ( ............................................. )
                </div>
            </div> --}}
        </div>

    </div>
</div>

<script>
    window.print();
</script>
