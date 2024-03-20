<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class Absensi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function absensi()
    {
        $judul = "Absensi";
        $absensi = "active";
        $list = "active";

        return view('products/03_absensi.listabsensi', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list
        ]);
    }

    public function fingerprint()
    {
        $judul = "Fingerprint";
        $absensi = "active";
        $list = "active";
        return view('products/03_absensi.fingerprint', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list
        ]);
    }

    public function getabsensi(Request $request)
    {
        $dataK = DB::table('penerimaan_karyawan')->where('status', 'like', '%Aktif%')->orderBy('nama', 'asc')->get();

        $datesArray = [];

        $startingDate = strtotime($request->tglaw);
        $endingDate = strtotime($request->tglak);

        for ($currentDate = $startingDate; $currentDate <= $endingDate; $currentDate += (86400)) {
            $date = date("d", $currentDate);
            $dateFull = date("Y-m-d", $currentDate);
            $datesArray[] = $date;
            $datesArrayFull[] = $dateFull;
        }


        echo '  
                <div class="table-responsive">
                    <table style="width:100%; font-size:12px" class="display table  table-sm table-striped table-bordered table-hover text-nowrap datatable-absensi" id="tbabsensi">
                        <thead>
                            <tr class="text-center">
                                <th>STB</th>
                                <th>NAMA</th>
                                ';
        foreach ($datesArray as $item) {
            echo '              <th style="width: 30px" class="text-center">' . $item . '</th>';
        }
        echo
        '
                            </tr>
                        </thead>
                        <tbody>
                                ';
        foreach ($dataK as $item2) {
            echo '          <tr>
                                <td><b>' . $item2->stb . '</b></td>
                                <td><b>' . $item2->nama . '</b></td>
                                ';
            foreach ($datesArrayFull as $item2) {
                echo '              <td style="width: 30px" class="text-center">' . $item2 . '</td>';
            }
            echo
            '               </tr>';
        }
        echo
        '
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>STB</th>
                                <th>NAMA</th>';
        foreach ($datesArray as $item) {
            echo '              <th style="width: 30px" class="text-center">' . $item . '</th>';
        }
        echo
        '
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <script>
                    var tb1 = $(".datatable-absensi").DataTable({
                        "processing": true, 
                        "serverSide": false, 
                        "scrollX": true,
                        "scrollCollapse": true,
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [25, 35, 40, 50, -1],
                            ["25", "35", "40", "50", "Tampilkan Semua"]
                        ],
                        "dom": `<"card-header h3" B>` +
                            `<"card-body border-bottom py-3" <"row"<"col-sm-6"l><"col-sm-6"f>> >` +
                            `<"table-responsive" <"col-sm-12"tr> >` +
                            `<"card-footer" <"row"<"col-sm-8"i><"col-sm-4"p> >>`,
                        buttons: [
                            {
                                text: `<i class="fa-solid fa-filter" style="margin-right:5px"></i>`,
                                className: "btn btn-blue w_filter",
                                attr: {
                                    "href": "#offcanvasEnd-lamaran",
                                    "data-bs-toggle": "offcanvas",
                                    "role": "button",
                                    "aria-controls": "offcanvasEnd",
                                }
                            },
                            {
                                extend: "excelHtml5",
                                autoFilter: true,
                                className: "btn btn-success",
                                text: `<i class="fa fa-file-excel text-white" style="margin-right:5px"></i>`,
                                // action: newexportaction,
                            },
                        ],
                        "language": {
                            "lengthMenu": "Menampilkan Karyawan _MENU_",
                            "zeroRecords": "Data Tidak Ditemukan",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
                            "infoEmpty": "Data Tidak Ditemukan",
                            "infoFiltered": "(Difilter dari _MAX_ total records)",
                            "processing": `<div class="container container-slim py-4"><div class="text-center"><div class="mb-3"></div><div class="text-secondary mb-3">Loading Data...</div><div class="progress progress-sm"><div class="progress-bar progress-bar-indeterminate"></div></div></div></div>`,
                            "search": `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>`,
                            "paginate": {
                                "first": `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6v12"></path><path d="M18 6l-6 6l6 6"></path></svg>`,
                                "last": `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 6l6 6l-6 6"></path><path d="M17 5v13"></path></svg>`,
                                "next": `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>`,
                                "previous": `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>`,
                            },
                        },
                        order: [[1, "asc"]]
                    });
                </script>
        ';
    }
}
