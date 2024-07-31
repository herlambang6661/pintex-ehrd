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
                <div class="col-md-8" style="margin-top: 20px">
                    <u class="text-center">
                        <h2><b>FORMULIR SURAT KOMUNIKASI</b></h2>
                    </u>
                </div>
            </div>
            <hr style="margin-top: 5px;">
            <div class="container">
                @foreach ($getData as $key => $v)
                    <i>
                        <h6>Tanggal : {{ Carbon::parse($v->tanggal)->format('d/m/Y') }}</h6>
                        <h6>No Form : {{ $noform }}</h6>
                    </i>
                @endforeach
                <br>
                <table class="table table-sm table-bordered"
                    style="color: black; border-color: black;text-transform: uppercase; font-size:10px">
                    <thead class="text-black" style="border-color: black;">
                        <th style="border-color: black;" class="text-center">No</th>
                        <th style="border-color: black;" class="text-center">Tanggal</th>
                        <th style="border-color: black;" class="text-center">Hari</th>
                        <th style="border-color: black;" class="text-center">STB</th>
                        <th style="border-color: black;" class="text-center">Nama</th>
                        <th style="border-color: black;" class="text-center">Surat</th>
                        <th style="border-color: black;" class="text-center">Status</th>
                        <th style="border-color: black;" class="text-center">Keterangan</th>
                        <th style="border-color: black;" class="text-center">Paraf</th>
                    </thead>
                    <?php $i = 1; ?>
                    <tbody class="text-black" style="border-color: black;">
                        @foreach ($getDataItm as $key => $w)
                            <?php
                            $diff = 1 + Carbon::parse($w->tanggal)->diffInDays($w->tanggal2);
                            if ($w->tanggal == $w->tanggal2) {
                                $tgls = Carbon::parse($w->tanggal)->format('d/m/Y');
                            } else {
                                $tgls = Carbon::parse($w->tanggal)->format('d') . '-' . Carbon::parse($w->tanggal2)->format('d/m/Y');
                            }
                            ?>
                            <tr>
                                <td class="text-center">{{ $i }}</td>
                                <td class="text-center">{{ $tgls }}</td>
                                <td class="text-center">{{ $diff }}</td>
                                <td class="text-center">{{ $w->stb }}</td>
                                <td class="text-center">{{ $w->nama }}</td>
                                <td class="text-center">{{ $w->suratid }}</td>
                                <td class="text-center">{{ $w->sst }}</td>
                                <td class="text-center">{{ $w->keterangan }}</td>
                                <td class="text-center"></td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                <i>*Note : </i>
                @foreach ($getData as $key => $v)
                    {{ $v->keteranganform }}
                @endforeach
                <br>
                <br>
                <div class="row text-center">
                    <div class="col">
                        Diterima
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                        Dibuat
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
    </div>

    <script>
        window.print();
    </script>
