<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>EHRD - PT PINTEX (Stand Alone).</title>
        <!-- CSS files -->
        <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet"/>
        <link href="{{ url('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet"/>
        <link href="{{ url('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet"/>
        <link href="{{ url('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet"/>
        <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet"/>
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
        </style>
    </head>

<?php
setlocale(LC_TIME, 'id_ID.utf8');
echo "<i>Tanggal Print : " . date('H:i:s d-m-Y')."</i>";
?>
<div class="card" id='PrintPre' style="border-color: white; border-style: solid;">
    <div class="card-body" style="color: black;">
        <div class="row">
            <div class="col-md-4 text-center">
                {{-- <img src="assets/pintex.png" class="" alt="PT. PINTEX" srcset="" width="150px"><br> --}}
                <h3 style="margin-top:10px">PT PINTEX</h3>
                <p style="font-size: 8px; margin-top:0px" class="text-center">
                    Jln. Raya Cirebon-Bandung Km.12 Plumbon-Cirebon<br>
                    Phone : 62-231-321366 (HUNTING) Faximile : 62-231-321389
                </p>
            </div>
            <div class="col-md-8" style="margin-top: 30px">
                <u class="text-center">
                    <h2><b>Daftar Kandidat</b></h2>
                </u>
            </div>
        </div>
        <hr>
        <i>
            <h6>Tanggal : </h6>
            <h6>No Form : </h6>
        </i>
        <br>
        <table class="table table-sm " border="3"
            style="font-size: 14px; height: 2px; color: black; border-color: black;text-transform: uppercase;">
            <thead class="text-black" style="border-color: black;">
                    <th style="border-color: black;">No</th>
                    <th style="border-color: black;">NIK</th>
                    <th style="border-color: black;">Nama</th>
                    <th style="border-color: black;">Pendidikan</th>
                    <th style="border-color: black;">Jurusan</th>
                    <th style="border-color: black;">Tinggi</th>
                    <th style="border-color: black;">Berat</th>
                    <th style="border-color: black;">Telp</th>
                    <th style="border-color: black;">Keterangan</th>
            </thead>
            
        </table>
        <i>*Note : </i>
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
                ( .................................................. )
            </div>
            <div class="col">
            </div>
            <div class="col">
                ( .................................................. )
            </div>
        </div>
    </div>
</div>

<script>
window.print();
</script>