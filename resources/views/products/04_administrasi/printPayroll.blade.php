    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>EHRD - PT PINTEX (Stand Alone).</title>
        <!-- CSS files -->
        {{-- <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" media='screen,print' />
        <link href="{{ url('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet"
            media='screen,print' />
        <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" media='screen,print' />
        <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet"
            media='screen,print' /> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"media='screen,print'>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"
            media='screen,print'></script>
        <style>
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }

            @media print {

                .col-sm-1,
                .col-sm-2,
                .col-sm-3,
                .col-sm-4,
                .col-sm-5,
                .col-sm-6,
                .col-sm-7,
                .col-sm-8,
                .col-sm-9,
                .col-sm-10,
                .col-sm-11,
                .col-sm-12 {
                    float: left;
                }

                .col-sm-12 {
                    width: 100%;
                }

                .col-sm-11 {
                    width: 91.66666666666666%;
                }

                .col-sm-10 {
                    width: 83.33333333333334%;
                }

                .col-sm-9 {
                    width: 75%;
                }

                .col-sm-8 {
                    width: 66.66666666666666%;
                }

                .col-sm-7 {
                    width: 58.333333333333336%;
                }

                .col-sm-6 {
                    width: 50%;
                }

                .col-sm-5 {
                    width: 41.66666666666667%;
                }

                .col-sm-4 {
                    width: 33.33333333333333%;
                }

                .col-sm-3 {
                    width: 25%;
                }

                .col-sm-2 {
                    width: 16.666666666666664%;
                }

                .col-sm-1 {
                    width: 8.333333333333332%;
                }
            }

            .border-dotted {

                border-style: dashed;
                border-color: black;
            }
        </style>
    </head>

    <?php
    use Carbon\Carbon;
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <div id="headerPrint" style="margin-top:5px;">
        <?php
        // echo '<i>Tanggal Print : ' . date('H:i:s d/m/Y') . '</i><br><br>';
        ?>
    </div>
    <div class="row">
        @foreach ($getPayroll as $key)
            <?php
            $totBpjs = $key->pot_bpjs_jkk + $key->pot_bpjs_jkm + $key->pot_bpjs_jp + $key->pot_bpjs_jht + $key->pot_bpjs_ks + $key->pot_bpjs_ksAdd;
            
            $pembulatan = $key->gapok + $key->prestasi + $key->tjabat + ($key->pot_bpjs_jht + $key->pot_bpjs_jp + $key->pot_bpjs_ks) + ($key->potongan_absen + $key->potongan_infaq + $key->potongan_koperasi + $key->potongan_pinjaman + $key->potongan_absen_rp);
            $pembulatan = ceil($pembulatan);
            if (substr($pembulatan, -3) > 499) {
                $resPem = round($pembulatan, -2);
            } else {
                $resPem = round($pembulatan, -2) + 100;
            }
            ?>
            <div class="col-6 border-bottom" style="margin-bottom: 25px;">
                <table class="table table-sm table-borderless lh-1" style="color: black; font-size:10px;">
                    <thead class="text-black" style="">
                        <th class="border-top border-bottom border-dark text-center" colspan="4">
                            Slip Gaji per : {{ Carbon::parse($key->dari)->format('d M Y') }} s.d.
                            {{ Carbon::parse($key->sampai)->format('d M Y') }}
                        </th>
                    </thead>
                    <tbody class="text-black">
                        <tr>
                            <td>STB - Nama</td>
                            <td class="text-center">:</td>
                            <td class="text-left" colspan="2">{{ $key->stb . ' - ' . $key->nama }}</td>
                        </tr>
                        <tr>
                            <td>Bagian</td>
                            <td class="text-center">:</td>
                            <td class="text-left" colspan="2">{{ $key->bagian }}</td>
                            <td class="text-center"></td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td class="text-center">:</td>
                            <td style="text-align: left" colspan="2">{{ number_format($key->gapok) }}</td>
                        </tr>
                        <tr>
                            <td>Tunj. Jabatan</td>
                            <td class="text-center">:</td>
                            <td class="text-right" colspan="2">
                                {{ empty($key->tjabat) ? '' : number_format($key->tjabat) }}</td>
                        </tr>
                        <tr>
                            <td>Prestasi</td>
                            <td class="text-center">:</td>
                            <td class="text-right" colspan="2">
                                {{ empty($key->prestasi) ? '' : number_format($key->prestasi) }}</td>
                        </tr>
                        <tr>
                            <td>Infaq</td>
                            <td class="text-center">:</td>
                            <td class="text-right" colspan="2">{{ number_format($key->potongan_infaq) }}</td>
                        </tr>
                        <tr>
                            <td>Pot. Bpjs</td>
                            <td class="text-center">:</td>
                            <td class="text-right">
                                {{ empty($totBpjs) ? '' : number_format($totBpjs) }}
                            </td>

                            </td>
                            <td class="text-center" rowspan="4">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td style="text-align: end;">Sakit</td>
                                        <td>:</td>
                                        <td>{{ $key->S }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: end;">Izin</td>
                                        <td>:</td>
                                        <td>{{ $key->I }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: end;">Alpa</td>
                                        <td>:</td>
                                        <td>{{ $key->A }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Pot. Absensi</td>
                            <td class="text-center">:</td>
                            <td class="text-right">
                                {{ empty($key->potongan_absen_rp) ? '' : number_format($key->potongan_absen_rp) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Pot. Koperasi</td>
                            <td class="text-center">:</td>
                            <td class="text-right">
                                {{ empty($key->potongan_koperasi) ? '' : number_format($key->potongan_koperasi) }}</td>
                        </tr>
                        <tr>
                            <td>Pot. Pinjaman</td>
                            <td class="text-center">:</td>
                            <td class="text-right">
                                {{ empty($key->potongan_pinjaman) ? '' : number_format($key->potongan_pinjaman) }}</td>
                        </tr>
                        <tr>
                            <td class="border-top">Pembulatan</td>
                            <td class="text-center border-top">:</td>
                            <td class="text-right border-top">{{ empty($resPem) ? '' : number_format($resPem) }}</td>
                            <td class="text-center">BCA {{ $key->bankrek }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
        <div class="col">
        </div>
    </div>

    <script>
        window.print();
    </script>
