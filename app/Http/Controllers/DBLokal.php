<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class DBLokal extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mesinfinger()
    {
        $judul = "DB Lokal";
        $absensi = "active";
        $list = "active";

        $count_user_server = DB::table('access_userinfo')->count();
        $count_user_local = DB::connection('mysql_local')->table('access_userinfo')->count();
        $count_user_access = DB::connection('odbc')->table('USERINFO')->count();

        $count_finger_server = DB::table('access_checkinout')->count();
        $count_finger_local = DB::connection('mysql_local')->table('access_checkinout')->count();
        $count_finger_access = DB::connection('odbc')->table('CHECKINOUT')->count();


        return view('products/03_absensi.mesinfinger', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list,
            'count_user_server' => $count_user_server,
            'count_user_local' => $count_user_local,
            'count_user_access' => $count_user_access,
            'count_finger_server' => $count_finger_server,
            'count_finger_local' => $count_finger_local,
            'count_finger_access' => $count_finger_access,
        ]);
    }

    // ==================================== DAFTAR FINGER ===================================================================
    public function daftarfinger()
    {
        $judul = "Daftar Finger";
        $absensi = "active";
        $list = "active";

        return view('products/03_absensi.userid', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list,
        ]);
    }

    public function syncFromAccess()
    {

        $ac = DB::connection('odbc')
            ->table('USERINFO')
            ->select('*')
            ->get();

        foreach ($ac as $key) {
            $sq = DB::table('access_userinfo')
                ->where('USERID', '=', $key->USERID)
                ->select('USERID')
                ->first();
            if ($sq) {
                // Data Ditemukan
                // DB::table('access_userinfo')
                //     ->where('USERID', $key->USERID)
                //     ->limit(1)
                //     ->update(
                //         array(
                //             'Badgenumber' => $key->Badgenumber,
                //             'SSN' => $key->SSN,
                //             'Name' => $key->Name,
                //             'Gender' => $key->Gender,
                //             'TITLE' => $key->TITLE,
                //             'PAGER' => $key->PAGER,
                //             'BIRTHDAY' => $key->BIRTHDAY,
                //             'HIREDDAY' => $key->HIREDDAY,
                //             'street' => $key->street,
                //             'CITY' => $key->CITY,
                //             'STATE' => $key->STATE,
                //             'ZIP' => $key->ZIP,
                //             'OPHONE' => $key->OPHONE,
                //             'FPHONE' => $key->FPHONE,
                //             'VERIFICATIONMETHOD' => $key->VERIFICATIONMETHOD,
                //             'DEFAULTDEPTID' => $key->DEFAULTDEPTID,
                //             'SECURITYFLAGS' => $key->SECURITYFLAGS,
                //             'ATT' => $key->ATT,
                //             'INLATE' => $key->INLATE,
                //             'OUTEARLY' => $key->OUTEARLY,
                //             'OVERTIME' => $key->OVERTIME,
                //             'SEP' => $key->SEP,
                //             'HOLIDAY' => $key->HOLIDAY,
                //             'MINZU' => $key->MINZU,
                //             'PASSWORD' => $key->PASSWORD,
                //             'LUNCHDURATION' => $key->LUNCHDURATION,
                //             'PHOTO' => $key->PHOTO,
                //             'mverifypass' => $key->mverifypass,
                //             'Notes' => $key->Notes,
                //             'privilege' => $key->privilege,
                //             'InheritDeptSch' => $key->InheritDeptSch,
                //             'InheritDeptSchClass' => $key->InheritDeptSchClass,
                //             'AutoSchPlan' => $key->AutoSchPlan,
                //             'MinAutoSchInterval' => $key->MinAutoSchInterval,
                //             'RegisterOT' => $key->RegisterOT,
                //             'InheritDeptRule' => $key->InheritDeptRule,
                //             'EMPRIVILEGE' => $key->EMPRIVILEGE,
                //             'CardNo' => $key->CardNo,
                //             'FaceGroup' => $key->FaceGroup,
                //             'AccGroup' => $key->AccGroup,
                //             'UseAccGroupTZ' => $key->UseAccGroupTZ,
                //             'VerifyCode' => $key->VerifyCode,
                //             'Expires' => $key->Expires,
                //             'ValidCount' => $key->ValidCount,
                //             'ValidTimeBegin' => $key->ValidTimeBegin,
                //             'ValidTimeEnd' => $key->ValidTimeEnd,
                //             'TimeZone1' => $key->TimeZone1,
                //             'TimeZone2' => $key->TimeZone2,
                //             'TimeZone3' => $key->TimeZone3,
                //             'IDCardNo' => $key->IDCardNo,
                //             'IDCardValidTime' => $key->IDCardValidTime,
                //             'EMail' => $key->EMail,
                //             'IDCardName' => $key->IDCardName,
                //             'IDCardBirth' => $key->IDCardBirth,
                //             'IDCardSN' => $key->IDCardSN,
                //             'IDCardDN' => $key->IDCardDN,
                //             'IDCardAddr' => $key->IDCardAddr,
                //             'IDCardNewAddr' => $key->IDCardNewAddr,
                //             'IDCardISSUER' => $key->IDCardISSUER,
                //             'IDCardGender' => $key->IDCardGender,
                //             'IDCardNation' => $key->IDCardNation,
                //             'IDCardReserve' => $key->IDCardReserve,
                //             'IDCardNotice' => $key->IDCardNotice,
                //             'IDCard_MainCard' => $key->IDCard_MainCard,
                //             'IDCard_ViceCard' => $key->IDCard_ViceCard,
                //             'FSelected' => $key->FSelected,
                //         )
                //     );
            } else {
                // Data Tidak Ditemukan, jadi Insert data baru
                DB::table('access_userinfo')
                    ->updateOrInsert(
                        [
                            'USERID' => 'USERID',
                            'Badgenumber' => 'Badgenumber',
                            'SSN' => 'SSN',
                            'Name' => 'Name',
                            'Gender' => 'Gender',
                            'TITLE' => 'TITLE',
                            'PAGER' => 'PAGER',
                            'BIRTHDAY' => 'BIRTHDAY',
                            'HIREDDAY' => 'HIREDDAY',
                            'street' => 'street',
                            'CITY' => 'CITY',
                            'STATE' => 'STATE',
                            'ZIP' => 'ZIP',
                            'OPHONE' => 'OPHONE',
                            'FPHONE' => 'FPHONE',
                            'VERIFICATIONMETHOD' => 'VERIFICATIONMETHOD',
                            'DEFAULTDEPTID' => 'DEFAULTDEPTID',
                            'SECURITYFLAGS' => 'SECURITYFLAGS',
                            'ATT' => 'ATT',
                            'INLATE' => 'INLATE',
                            'OUTEARLY' => 'OUTEARLY',
                            'OVERTIME' => 'OVERTIME',
                            'SEP' => 'SEP',
                            'HOLIDAY' => 'HOLIDAY',
                            'MINZU' => 'MINZU',
                            'PASSWORD' => 'PASSWORD',
                            'LUNCHDURATION' => 'LUNCHDURATION',
                            'PHOTO' => 'PHOTO',
                            'mverifypass' => 'mverifypass',
                            'Notes' => 'Notes',
                            'privilege' => 'privilege',
                            'InheritDeptSch' => 'InheritDeptSch',
                            'InheritDeptSchClass' => 'InheritDeptSchClass',
                            'AutoSchPlan' => 'AutoSchPlan',
                            'MinAutoSchInterval' => 'MinAutoSchInterval',
                            'RegisterOT' => 'RegisterOT',
                            'InheritDeptRule' => 'InheritDeptRule',
                            'EMPRIVILEGE' => 'EMPRIVILEGE',
                            'CardNo' => 'CardNo',
                            'FaceGroup' => 'FaceGroup',
                            'AccGroup' => 'AccGroup',
                            'UseAccGroupTZ' => 'UseAccGroupTZ',
                            'VerifyCode' => 'VerifyCode',
                            'Expires' => 'Expires',
                            'ValidCount' => 'ValidCount',
                            'ValidTimeBegin' => 'ValidTimeBegin',
                            'ValidTimeEnd' => 'ValidTimeEnd',
                            'TimeZone1' => 'TimeZone1',
                            'TimeZone2' => 'TimeZone2',
                            'TimeZone3' => 'TimeZone3',
                            'IDCardNo' => 'IDCardNo',
                            'IDCardValidTime' => 'IDCardValidTime',
                            'EMail' => 'EMail',
                            'IDCardName' => 'IDCardName',
                            'IDCardBirth' => 'IDCardBirth',
                            'IDCardSN' => 'IDCardSN',
                            'IDCardDN' => 'IDCardDN',
                            'IDCardAddr' => 'IDCardAddr',
                            'IDCardNewAddr' => 'IDCardNewAddr',
                            'IDCardISSUER' => 'IDCardISSUER',
                            'IDCardGender' => 'IDCardGender',
                            'IDCardNation' => 'IDCardNation',
                            'IDCardReserve' => 'IDCardReserve',
                            'IDCardNotice' => 'IDCardNotice',
                            'IDCard_MainCard' => 'IDCard_MainCard',
                            'IDCard_ViceCard' => 'IDCard_ViceCard',
                            'FSelected' => 'FSelected',
                        ],
                        [
                            'USERID' => $key->USERID,
                            'Badgenumber' => $key->Badgenumber,
                            'SSN' => $key->SSN,
                            'Name' => $key->Name,
                            'Gender' => $key->Gender,
                            'TITLE' => $key->TITLE,
                            'PAGER' => $key->PAGER,
                            'BIRTHDAY' => $key->BIRTHDAY,
                            'HIREDDAY' => $key->HIREDDAY,
                            'street' => $key->street,
                            'CITY' => $key->CITY,
                            'STATE' => $key->STATE,
                            'ZIP' => $key->ZIP,
                            'OPHONE' => $key->OPHONE,
                            'FPHONE' => $key->FPHONE,
                            'VERIFICATIONMETHOD' => $key->VERIFICATIONMETHOD,
                            'DEFAULTDEPTID' => $key->DEFAULTDEPTID,
                            'SECURITYFLAGS' => $key->SECURITYFLAGS,
                            'ATT' => $key->ATT,
                            'INLATE' => $key->INLATE,
                            'OUTEARLY' => $key->OUTEARLY,
                            'OVERTIME' => $key->OVERTIME,
                            'SEP' => $key->SEP,
                            'HOLIDAY' => $key->HOLIDAY,
                            'MINZU' => $key->MINZU,
                            'PASSWORD' => $key->PASSWORD,
                            'LUNCHDURATION' => $key->LUNCHDURATION,
                            'PHOTO' => $key->PHOTO,
                            'mverifypass' => $key->mverifypass,
                            'Notes' => $key->Notes,
                            'privilege' => $key->privilege,
                            'InheritDeptSch' => $key->InheritDeptSch,
                            'InheritDeptSchClass' => $key->InheritDeptSchClass,
                            'AutoSchPlan' => $key->AutoSchPlan,
                            'MinAutoSchInterval' => $key->MinAutoSchInterval,
                            'RegisterOT' => $key->RegisterOT,
                            'InheritDeptRule' => $key->InheritDeptRule,
                            'EMPRIVILEGE' => $key->EMPRIVILEGE,
                            'CardNo' => $key->CardNo,
                            'FaceGroup' => $key->FaceGroup,
                            'AccGroup' => $key->AccGroup,
                            'UseAccGroupTZ' => $key->UseAccGroupTZ,
                            'VerifyCode' => $key->VerifyCode,
                            'Expires' => $key->Expires,
                            'ValidCount' => $key->ValidCount,
                            'ValidTimeBegin' => $key->ValidTimeBegin,
                            'ValidTimeEnd' => $key->ValidTimeEnd,
                            'TimeZone1' => $key->TimeZone1,
                            'TimeZone2' => $key->TimeZone2,
                            'TimeZone3' => $key->TimeZone3,
                            'IDCardNo' => $key->IDCardNo,
                            'IDCardValidTime' => $key->IDCardValidTime,
                            'EMail' => $key->EMail,
                            'IDCardName' => $key->IDCardName,
                            'IDCardBirth' => $key->IDCardBirth,
                            'IDCardSN' => $key->IDCardSN,
                            'IDCardDN' => $key->IDCardDN,
                            'IDCardAddr' => $key->IDCardAddr,
                            'IDCardNewAddr' => $key->IDCardNewAddr,
                            'IDCardISSUER' => $key->IDCardISSUER,
                            'IDCardGender' => $key->IDCardGender,
                            'IDCardNation' => $key->IDCardNation,
                            'IDCardReserve' => $key->IDCardReserve,
                            'IDCardNotice' => $key->IDCardNotice,
                            'IDCard_MainCard' => $key->IDCard_MainCard,
                            'IDCard_ViceCard' => $key->IDCard_ViceCard,
                            'FSelected' => $key->FSelected,
                        ]
                    );
            }
        }
    }

    public function syncFromSelectedMysql(Request $request)
    {

        if (empty($request->id)) {
            return response()->json(['error' => 'Tidak ada data yang dipilih.', 'status' => 0]);
        } else {
            $jml = count($request->id);
            for ($i = 0; $i < $jml; $i++) {
                $ac = DB::connection('odbc')->table('USERINFO')
                    ->where('USERID', '=', $request->id[$i])
                    ->get();
                $sq = DB::table('access_userinfo')
                    ->where('USERID', '=', $request->id[$i])
                    ->get();

                if ($ac) {
                    // Data Ditemukan
                    foreach ($sq as $key) {
                        DB::connection('odbc')->table('USERINFO')
                            ->where('USERID', $key->USERID)
                            ->limit(1)
                            ->update(
                                array(
                                    'Badgenumber' => $key->Badgenumber,
                                    'SSN' => $key->SSN,
                                    'Name' => $key->Name,
                                    'Gender' => $key->Gender,
                                    'TITLE' => $key->TITLE,
                                    'PAGER' => $key->PAGER,
                                    'BIRTHDAY' => $key->BIRTHDAY,
                                    'HIREDDAY' => $key->HIREDDAY,
                                    'street' => $key->street,
                                    'CITY' => $key->CITY,
                                    'STATE' => $key->STATE,
                                    'ZIP' => $key->ZIP,
                                    'OPHONE' => $key->OPHONE,
                                    'FPHONE' => $key->FPHONE,
                                    'VERIFICATIONMETHOD' => $key->VERIFICATIONMETHOD,
                                    'DEFAULTDEPTID' => $key->DEFAULTDEPTID,
                                    'SECURITYFLAGS' => $key->SECURITYFLAGS,
                                    'ATT' => $key->ATT,
                                    'INLATE' => $key->INLATE,
                                    'OUTEARLY' => $key->OUTEARLY,
                                    'OVERTIME' => $key->OVERTIME,
                                    'SEP' => $key->SEP,
                                    'HOLIDAY' => $key->HOLIDAY,
                                    'MINZU' => $key->MINZU,
                                    'PASSWORD' => $key->PASSWORD,
                                    'LUNCHDURATION' => $key->LUNCHDURATION,
                                    'PHOTO' => $key->PHOTO,
                                    'mverifypass' => $key->mverifypass,
                                    'Notes' => $key->Notes,
                                    'privilege' => $key->privilege,
                                    'InheritDeptSch' => $key->InheritDeptSch,
                                    'InheritDeptSchClass' => $key->InheritDeptSchClass,
                                    'AutoSchPlan' => $key->AutoSchPlan,
                                    'MinAutoSchInterval' => $key->MinAutoSchInterval,
                                    'RegisterOT' => $key->RegisterOT,
                                    'InheritDeptRule' => $key->InheritDeptRule,
                                    'EMPRIVILEGE' => $key->EMPRIVILEGE,
                                    'CardNo' => $key->CardNo,
                                    'FaceGroup' => $key->FaceGroup,
                                    'AccGroup' => $key->AccGroup,
                                    'UseAccGroupTZ' => $key->UseAccGroupTZ,
                                    'VerifyCode' => $key->VerifyCode,
                                    'Expires' => $key->Expires,
                                    'ValidCount' => $key->ValidCount,
                                    'ValidTimeBegin' => $key->ValidTimeBegin,
                                    'ValidTimeEnd' => $key->ValidTimeEnd,
                                    'TimeZone1' => $key->TimeZone1,
                                    'TimeZone2' => $key->TimeZone2,
                                    'TimeZone3' => $key->TimeZone3,
                                    'IDCardNo' => $key->IDCardNo,
                                    'IDCardValidTime' => $key->IDCardValidTime,
                                    'EMail' => $key->EMail,
                                    'IDCardName' => $key->IDCardName,
                                    'IDCardBirth' => $key->IDCardBirth,
                                    'IDCardSN' => $key->IDCardSN,
                                    'IDCardDN' => $key->IDCardDN,
                                    'IDCardAddr' => $key->IDCardAddr,
                                    'IDCardNewAddr' => $key->IDCardNewAddr,
                                    'IDCardISSUER' => $key->IDCardISSUER,
                                    'IDCardGender' => $key->IDCardGender,
                                    'IDCardNation' => $key->IDCardNation,
                                    'IDCardReserve' => $key->IDCardReserve,
                                    'IDCardNotice' => $key->IDCardNotice,
                                    'IDCard_MainCard' => $key->IDCard_MainCard,
                                    'IDCard_ViceCard' => $key->IDCard_ViceCard,
                                    'FSelected' => $key->FSelected,
                                )
                            );
                    }
                    return response()->json(['success' => 'Berhasil di Upload.', 'status' => 1]);
                } else {
                    // Data Tidak Ditemukan, jadi Insert data baru
                    foreach ($sq as $key) {
                        DB::connection('odbc')->table('USERINFO')
                            ->updateOrInsert(
                                [
                                    'USERID' => 'USERID',
                                    'Badgenumber' => 'Badgenumber',
                                    'SSN' => 'SSN',
                                    'Name' => 'Name',
                                    'Gender' => 'Gender',
                                    'TITLE' => 'TITLE',
                                    'PAGER' => 'PAGER',
                                    'BIRTHDAY' => 'BIRTHDAY',
                                    'HIREDDAY' => 'HIREDDAY',
                                    'street' => 'street',
                                    'CITY' => 'CITY',
                                    'STATE' => 'STATE',
                                    'ZIP' => 'ZIP',
                                    'OPHONE' => 'OPHONE',
                                    'FPHONE' => 'FPHONE',
                                    'VERIFICATIONMETHOD' => 'VERIFICATIONMETHOD',
                                    'DEFAULTDEPTID' => 'DEFAULTDEPTID',
                                    'SECURITYFLAGS' => 'SECURITYFLAGS',
                                    'ATT' => 'ATT',
                                    'INLATE' => 'INLATE',
                                    'OUTEARLY' => 'OUTEARLY',
                                    'OVERTIME' => 'OVERTIME',
                                    'SEP' => 'SEP',
                                    'HOLIDAY' => 'HOLIDAY',
                                    'MINZU' => 'MINZU',
                                    'PASSWORD' => 'PASSWORD',
                                    'LUNCHDURATION' => 'LUNCHDURATION',
                                    'PHOTO' => 'PHOTO',
                                    'mverifypass' => 'mverifypass',
                                    'Notes' => 'Notes',
                                    'privilege' => 'privilege',
                                    'InheritDeptSch' => 'InheritDeptSch',
                                    'InheritDeptSchClass' => 'InheritDeptSchClass',
                                    'AutoSchPlan' => 'AutoSchPlan',
                                    'MinAutoSchInterval' => 'MinAutoSchInterval',
                                    'RegisterOT' => 'RegisterOT',
                                    'InheritDeptRule' => 'InheritDeptRule',
                                    'EMPRIVILEGE' => 'EMPRIVILEGE',
                                    'CardNo' => 'CardNo',
                                    'FaceGroup' => 'FaceGroup',
                                    'AccGroup' => 'AccGroup',
                                    'UseAccGroupTZ' => 'UseAccGroupTZ',
                                    'VerifyCode' => 'VerifyCode',
                                    'Expires' => 'Expires',
                                    'ValidCount' => 'ValidCount',
                                    'ValidTimeBegin' => 'ValidTimeBegin',
                                    'ValidTimeEnd' => 'ValidTimeEnd',
                                    'TimeZone1' => 'TimeZone1',
                                    'TimeZone2' => 'TimeZone2',
                                    'TimeZone3' => 'TimeZone3',
                                    'IDCardNo' => 'IDCardNo',
                                    'IDCardValidTime' => 'IDCardValidTime',
                                    'EMail' => 'EMail',
                                    'IDCardName' => 'IDCardName',
                                    'IDCardBirth' => 'IDCardBirth',
                                    'IDCardSN' => 'IDCardSN',
                                    'IDCardDN' => 'IDCardDN',
                                    'IDCardAddr' => 'IDCardAddr',
                                    'IDCardNewAddr' => 'IDCardNewAddr',
                                    'IDCardISSUER' => 'IDCardISSUER',
                                    'IDCardGender' => 'IDCardGender',
                                    'IDCardNation' => 'IDCardNation',
                                    'IDCardReserve' => 'IDCardReserve',
                                    'IDCardNotice' => 'IDCardNotice',
                                    'IDCard_MainCard' => 'IDCard_MainCard',
                                    'IDCard_ViceCard' => 'IDCard_ViceCard',
                                    'FSelected' => 'FSelected',
                                ],
                                [
                                    'USERID' => $key->USERID,
                                    'Badgenumber' => $key->Badgenumber,
                                    'SSN' => $key->SSN,
                                    'Name' => $key->Name,
                                    'Gender' => $key->Gender,
                                    'TITLE' => $key->TITLE,
                                    'PAGER' => $key->PAGER,
                                    'BIRTHDAY' => $key->BIRTHDAY,
                                    'HIREDDAY' => $key->HIREDDAY,
                                    'street' => $key->street,
                                    'CITY' => $key->CITY,
                                    'STATE' => $key->STATE,
                                    'ZIP' => $key->ZIP,
                                    'OPHONE' => $key->OPHONE,
                                    'FPHONE' => $key->FPHONE,
                                    'VERIFICATIONMETHOD' => $key->VERIFICATIONMETHOD,
                                    'DEFAULTDEPTID' => $key->DEFAULTDEPTID,
                                    'SECURITYFLAGS' => $key->SECURITYFLAGS,
                                    'ATT' => $key->ATT,
                                    'INLATE' => $key->INLATE,
                                    'OUTEARLY' => $key->OUTEARLY,
                                    'OVERTIME' => $key->OVERTIME,
                                    'SEP' => $key->SEP,
                                    'HOLIDAY' => $key->HOLIDAY,
                                    'MINZU' => $key->MINZU,
                                    'PASSWORD' => $key->PASSWORD,
                                    'LUNCHDURATION' => $key->LUNCHDURATION,
                                    'PHOTO' => $key->PHOTO,
                                    'mverifypass' => $key->mverifypass,
                                    'Notes' => $key->Notes,
                                    'privilege' => $key->privilege,
                                    'InheritDeptSch' => $key->InheritDeptSch,
                                    'InheritDeptSchClass' => $key->InheritDeptSchClass,
                                    'AutoSchPlan' => $key->AutoSchPlan,
                                    'MinAutoSchInterval' => $key->MinAutoSchInterval,
                                    'RegisterOT' => $key->RegisterOT,
                                    'InheritDeptRule' => $key->InheritDeptRule,
                                    'EMPRIVILEGE' => $key->EMPRIVILEGE,
                                    'CardNo' => $key->CardNo,
                                    'FaceGroup' => $key->FaceGroup,
                                    'AccGroup' => $key->AccGroup,
                                    'UseAccGroupTZ' => $key->UseAccGroupTZ,
                                    'VerifyCode' => $key->VerifyCode,
                                    'Expires' => $key->Expires,
                                    'ValidCount' => $key->ValidCount,
                                    'ValidTimeBegin' => $key->ValidTimeBegin,
                                    'ValidTimeEnd' => $key->ValidTimeEnd,
                                    'TimeZone1' => $key->TimeZone1,
                                    'TimeZone2' => $key->TimeZone2,
                                    'TimeZone3' => $key->TimeZone3,
                                    'IDCardNo' => $key->IDCardNo,
                                    'IDCardValidTime' => $key->IDCardValidTime,
                                    'EMail' => $key->EMail,
                                    'IDCardName' => $key->IDCardName,
                                    'IDCardBirth' => $key->IDCardBirth,
                                    'IDCardSN' => $key->IDCardSN,
                                    'IDCardDN' => $key->IDCardDN,
                                    'IDCardAddr' => $key->IDCardAddr,
                                    'IDCardNewAddr' => $key->IDCardNewAddr,
                                    'IDCardISSUER' => $key->IDCardISSUER,
                                    'IDCardGender' => $key->IDCardGender,
                                    'IDCardNation' => $key->IDCardNation,
                                    'IDCardReserve' => $key->IDCardReserve,
                                    'IDCardNotice' => $key->IDCardNotice,
                                    'IDCard_MainCard' => $key->IDCard_MainCard,
                                    'IDCard_ViceCard' => $key->IDCard_ViceCard,
                                    'FSelected' => $key->FSelected,
                                ]
                            );
                    }
                    return response()->json(['success' => 'Berhasil di Upload.', 'status' => 1]);
                }
            }
        }
    }
    // ==================================== DAFTAR FINGER ===================================================================

    // ==================================== RAW FINGER ======================================================================
    public function rawfinger()
    {
        $judul = "Raw Finger";
        $absensi = "active";
        $list = "active";

        return view('products/03_absensi.checkinout', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list,
        ]);
    }

    public function syncCheckinout(Request $request)
    {
        $ac = DB::connection('odbc')
            ->table('CHECKINOUT')
            ->whereBetween('CHECKTIME', [$request->start . ' 00:00:00', date('Y-m-d', strtotime($request->end . "+1 days")) . ' 00:00:00'])
            // ->where('CHECKTIME', '>=', $request->start . ' 00:00:00')
            // ->where('CHECKTIME', '<=', date('Y-m-d', strtotime($request->end . "+1 days")) . ' 00:00:00')
            ->select('*')
            ->get();
        foreach ($ac as $key) {
            $sq = DB::connection('mysql_local')
                ->table('access_checkinout')
                ->where('USERID', '=', $key->USERID)
                ->where('CHECKTIME', '=', $key->CHECKTIME)
                ->select('CHECKTIME')
                ->first();
            if ($sq) {
                // Data Ditemukan
            } else {
                // Data Tidak Ditemukan, jadi Insert data baru
                DB::connection('mysql_local')
                    ->table('access_checkinout')
                    ->updateOrInsert(
                        [
                            'USERID' => 'USERID',
                            'CHECKTIME' => 'CHECKTIME',
                            'CHECKTYPE' => 'CHECKTYPE',
                            'VERIFYCODE' => 'VERIFYCODE',
                            'SENSORID' => 'SENSORID',
                            'Memoinfo' => 'Memoinfo',
                            'WorkCode' => 'WorkCode',
                            'sn' => 'sn',
                            'UserExtFmt' => 'UserExtFmt',
                            'mask_flag' => 'mask_flag',
                            'temperature' => 'temperature',
                        ],
                        [
                            'USERID' => $key->USERID,
                            'CHECKTIME' => $key->CHECKTIME,
                            'CHECKTYPE' => $key->CHECKTYPE,
                            'VERIFYCODE' => $key->VERIFYCODE,
                            'SENSORID' => $key->SENSORID,
                            'Memoinfo' => $key->Memoinfo,
                            'WorkCode' => $key->WorkCode,
                            'sn' => $key->sn,
                            'UserExtFmt' => $key->UserExtFmt,
                            'mask_flag' => $key->mask_flag,
                            'temperature' => $key->temperature,
                        ]
                    );
            }
        }
    }
    // ==================================== RAW FINGER ======================================================================

    // ==================================== LOCAL ABSENCE ===================================================================
    public function localabsence()
    {
        $judul = "Local Absence";
        $absensi = "active";
        $list = "active";

        return view('products/03_absensi.localabsence', [
            'judul' => $judul,
            'absensi' => $absensi,
            'list' => $list,
        ]);
    }

    public function syncAbsen(Request $request)
    {
        $ac = DB::table('penerimaan_karyawan')
            ->where('status', 'like', '%Aktif%')
            ->select('*')
            ->get();
        foreach ($ac as $key) {
            $hari = date("D", strtotime($request->tgl));
            switch ($hari) {
                case 'Sun':
                    $hari_ini = "Minggu";
                    break;
                case 'Mon':
                    $hari_ini = "Senin";
                    break;
                case 'Tue':
                    $hari_ini = "Selasa";
                    break;
                case 'Wed':
                    $hari_ini = "Rabu";
                    break;
                case 'Thu':
                    $hari_ini = "Kamis";
                    break;
                case 'Fri':
                    $hari_ini = "Jumat";
                    break;
                case 'Sat':
                    $hari_ini = "Sabtu";
                    break;
                default:
                    $hari_ini = "Tidak di ketahui";
                    break;
            }
            // if ($key->hrlibur == strtoupper($hari_ini)) {
            //     $harilibur = 'L';
            // } else {
            //     $harilibur = null;
            // }

            $fromLocal = DB::connection('mysql_local')
                ->table('absensi_absensi')
                ->where('userid', '=', $key->userid)
                ->where('tanggal', '=', $request->tgl)
                // ->limit(1)
                ->first();
            if ($fromLocal) {
                // Data Ditemukan
                // Set date In
                $getIn = DB::connection('mysql_local')
                    ->table('access_checkinout')
                    ->whereBetween('CHECKTIME', [$request->tgl . ' 04:00:00', date('Y-m-d', strtotime($request->tgl . "+1 days")) . ' 00:00:00'])
                    // ->whereDate('CHECKTIME', '=', $request->tgl)
                    ->where('USERID', '=', $key->userid)
                    ->where('CHECKTYPE', '=', 'I')
                    ->select('CHECKTYPE', 'CHECKTIME')
                    ->get();
                // Set date Out
                $st = DB::connection('mysql_local')
                    ->table('access_checkinout')
                    ->where('USERID', '=', $key->userid)
                    ->where('CHECKTYPE', '=', 'O')
                    ->whereBetween('CHECKTIME', [$request->tgl . ' 07:30:00', date('Y-m-d', strtotime($request->tgl . "+1 days")) . ' 07:30:00'])
                    ->select('CHECKTYPE', 'CHECKTIME')
                    ->get();
                // send in
                foreach ($getIn as $value) {
                    ($value->CHECKTYPE == 'I') ? $in = $value->CHECKTIME : $in = null;
                    DB::connection('mysql_local')
                        ->table('absensi_absensi')
                        ->where('userid', '=', $key->userid)
                        ->where('tanggal', '=', $request->tgl)
                        ->limit(1)
                        ->update(
                            array(
                                'in' => $in,
                            )
                        );
                }
                // send out
                foreach ($st as $value) {
                    ($value->CHECKTYPE == 'O') ? $out = $value->CHECKTIME : $out = null;
                    DB::connection('mysql_local')
                        ->table('absensi_absensi')
                        ->where('userid', '=', $key->userid)
                        ->where('tanggal', '=', $request->tgl)
                        ->limit(1)
                        ->update(
                            array(
                                'out' => $out,
                            )
                        );
                }
                // set qj, jis, prediksiShift, sst
                $fn = DB::connection('mysql_local')
                    ->table('absensi_absensi')
                    ->where('userid', '=', $key->userid)
                    ->where('tanggal', '=', $request->tgl)
                    // ->select('*')
                    ->get();
                foreach ($fn as $f) {
                    $starttimestamp = strtotime($f->in);
                    $endtimestamp = strtotime($f->out);
                    $difference = abs($endtimestamp - $starttimestamp) / 3600;
                    // STATUS ABSENSI
                    if ($f->hrlibur == strtoupper($hari_ini) && $f->in == null && $f->out == null) {
                        // Libur
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'L',
                                )
                            );
                    } elseif ($f->hrlibur == strtoupper($hari_ini) && $f->in == null) {
                        // Libur tapi dinger in tdk ada
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'L',
                                )
                            );
                    } elseif ($f->hrlibur == strtoupper($hari_ini) && $f->out == null) {
                        // Libur tapi dinger out tdk ada
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'L',
                                )
                            );
                    } elseif ($f->in == null && $f->out == null) {
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'A',
                                )
                            );
                    } elseif ($f->in == null || $f->out == null) {
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'F1',
                                )
                            );
                    } elseif ($f->in != null && $f->out != null) {
                        if ($f->hrlibur == strtoupper($hari_ini) &&  $difference <= 7) {
                            // LEMBUR
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'sst' => 'L',
                                    )
                                );
                        } elseif ($difference <= 4) {
                            // IP
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'sst' => 'F2',
                                    )
                                );
                        } elseif ($difference <= 7) {
                            // PC ½ Hari
                            if ($f->sethari == strtoupper($hari_ini)) {
                                DB::connection('mysql_local')
                                    ->table('absensi_absensi')
                                    ->where(
                                        'userid',
                                        '=',
                                        $f->userid
                                    )
                                    ->where('tanggal', '=', $request->tgl)
                                    ->limit(1)
                                    ->update(
                                        array(
                                            'sst' => 'H',
                                        )
                                    );
                            } else {
                                DB::connection('mysql_local')
                                    ->table('absensi_absensi')
                                    ->where(
                                        'userid',
                                        '=',
                                        $f->userid
                                    )
                                    ->where('tanggal', '=', $request->tgl)
                                    ->limit(1)
                                    ->update(
                                        array(
                                            'sst' => '½',
                                        )
                                    );
                            }
                        } else {
                            // H
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'sst' => 'H',
                                    )
                                );
                        }
                    }
                    // PREDIKSI SHIFT
                    if (Carbon::parse($f->in)->format('H:i:s') > '04:00:00' && Carbon::parse($f->in)->format('H:i:s') < '07:30:00') {
                        // Shift 1
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '1',
                                )
                            );
                    } elseif (
                        Carbon::parse($f->in)->format('H:i:s') > '12:30:00' && Carbon::parse($f->in)->format('H:i:s') < '15:00:00'
                    ) {
                        // Shift 2
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '2',
                                )
                            );
                    } elseif (
                        Carbon::parse($f->in)->format('H:i:s') > '20:00:00' && Carbon::parse($f->in)->format('H:i:s') < '23:30:00'
                    ) {
                        // Shift 3
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '3',
                                )
                            );
                    } elseif (
                        Carbon::parse($f->in)->format('H:i:s') > '07:30:00' && Carbon::parse($f->in)->format('H:i:s') < '10:30:00'
                    ) {
                        // Shift 0
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '0',
                                )
                            );
                    }
                    // QJ, JIS & QJNET
                    if ($f->in != null && $f->out != null) {
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'qj' => $difference,
                                )
                            );

                        if ($difference > 7) {
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'jis' => 1,
                                        'qjnet' => $difference - 1,
                                    )
                                );
                        } else {
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'qjnet' => $difference,
                                    )
                                );
                        }
                    }
                }
                // return response()->json(['success' => 'Data ' . $request->tgl . ' - ', date("Y-m-d", strtotime($request->tgl . "+1 days")) . ' Berhasil di Update.', 'status' => 1]);
            } else {
                // Data Tidak Ditemukan, jadi Insert data baru
                DB::connection('mysql_local')
                    ->table('absensi_absensi')
                    ->insert(
                        [
                            'remember_token' => $request->_token,
                            'tanggal' => $request->tgl,
                            'userid' => $key->userid,
                            'stb' => $key->stb,
                            'name' => $key->nama,
                            'hrlibur' => $key->hrlibur,
                            'sethari' => $key->sethari,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]
                    );

                $gt = DB::connection('mysql_local')
                    ->table('access_checkinout')
                    ->whereBetween('CHECKTIME', [$request->tgl . ' 04:00:00', date('Y-m-d', strtotime($request->tgl . "+1 days")) . ' 00:00:00'])
                    ->where('USERID', '=', $key->userid)
                    ->where('CHECKTYPE', '=', 'I')
                    ->select('CHECKTYPE', 'CHECKTIME')
                    ->get();
                // Set date In
                foreach ($gt as $value) {
                    ($value->CHECKTYPE == 'I') ? $in = $value->CHECKTIME : $in = null;
                    DB::connection('mysql_local')
                        ->table('absensi_absensi')
                        ->where('userid', '=', $key->userid)
                        ->where('tanggal', '=', $request->tgl)
                        ->limit(1)
                        ->update(
                            array(
                                'in' => $in,
                            )
                        );
                }
                // Set date Out
                $st = DB::connection('mysql_local')
                    ->table('access_checkinout')
                    ->where('USERID', '=', $key->userid)
                    ->where('CHECKTYPE', '=', 'O')
                    ->whereBetween('CHECKTIME', [$request->tgl . ' 07:30:00', date('Y-m-d', strtotime($request->tgl . "+1 days")) . ' 07:30:00'])
                    ->select('CHECKTYPE', 'CHECKTIME')
                    ->get();
                foreach ($st as $value) {
                    ($value->CHECKTYPE == 'O') ? $out = $value->CHECKTIME : $out = null;
                    DB::connection('mysql_local')
                        ->table('absensi_absensi')
                        ->where('userid', '=', $key->userid)
                        ->where('tanggal', '=', $request->tgl)
                        ->limit(1)
                        ->update(
                            array(
                                'out' => $out,
                            )
                        );
                }
                // set qj, jis, prediksiShift, sst
                $fn = DB::connection('mysql_local')
                    ->table('absensi_absensi')
                    ->where('userid', '=', $key->userid)
                    ->where('tanggal', '=', $request->tgl)
                    // ->select('*')
                    ->get();
                foreach ($fn as $f) {
                    $starttimestamp = strtotime($f->in);
                    $endtimestamp = strtotime($f->out);
                    $difference = abs($endtimestamp - $starttimestamp) / 3600;
                    // STATUS ABSENSI
                    if ($f->hrlibur == strtoupper($hari_ini) && $f->in == null && $f->out == null) {
                        // Libur
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'L',
                                )
                            );
                    } elseif (
                        $f->hrlibur == strtoupper($hari_ini) && $f->in == null
                    ) {
                        // Libur tapi dinger in tdk ada
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'L',
                                )
                            );
                    } elseif ($f->hrlibur == strtoupper($hari_ini) && $f->out == null) {
                        // Libur tapi dinger out tdk ada
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'L',
                                )
                            );
                    } elseif ($f->in == null && $f->out == null) {
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'A',
                                )
                            );
                    } elseif ($f->in == null || $f->out == null) {
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'sst' => 'F1',
                                )
                            );
                    } elseif ($f->in != null && $f->out != null) {
                        if ($f->hrlibur == strtoupper($hari_ini) &&  $difference <= 7) {
                            // LEMBUR
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'sst' => 'L',
                                    )
                                );
                        } elseif ($difference <= 4) {
                            // IP
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'sst' => 'F2',
                                    )
                                );
                        } elseif ($difference <= 7) {
                            // PC ½ Hari
                            if ($f->sethari == strtoupper($hari_ini)) {
                                DB::connection('mysql_local')
                                    ->table('absensi_absensi')
                                    ->where(
                                        'userid',
                                        '=',
                                        $f->userid
                                    )
                                    ->where('tanggal', '=', $request->tgl)
                                    ->limit(1)
                                    ->update(
                                        array(
                                            'sst' => 'H',
                                        )
                                    );
                            } else {
                                DB::connection('mysql_local')
                                    ->table('absensi_absensi')
                                    ->where(
                                        'userid',
                                        '=',
                                        $f->userid
                                    )
                                    ->where('tanggal', '=', $request->tgl)
                                    ->limit(1)
                                    ->update(
                                        array(
                                            'sst' => '½',
                                        )
                                    );
                            }
                        } else {
                            // H
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'sst' => 'H',
                                    )
                                );
                        }
                    }
                    // PREDIKSI SHIFT
                    if (Carbon::parse($f->in)->format('H:i:s') > '04:00:00' && Carbon::parse($f->in)->format('H:i:s') < '07:30:00') {
                        // Shift 1
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '1',
                                )
                            );
                    } elseif (
                        Carbon::parse($f->in)->format('H:i:s') > '12:30:00' && Carbon::parse($f->in)->format('H:i:s') < '15:00:00'
                    ) {
                        // Shift 2
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '2',
                                )
                            );
                    } elseif (
                        Carbon::parse($f->in)->format('H:i:s') > '20:00:00' && Carbon::parse($f->in)->format('H:i:s') < '23:30:00'
                    ) {
                        // Shift 3
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '3',
                                )
                            );
                    } elseif (
                        Carbon::parse($f->in)->format('H:i:s') > '07:30:00' && Carbon::parse($f->in)->format('H:i:s') < '10:30:00'
                    ) {
                        // Shift 0
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'prediksiShift' => '0',
                                )
                            );
                    }
                    // QJ, JIS & QJNET
                    if ($f->in != null && $f->out != null) {
                        DB::connection('mysql_local')
                            ->table('absensi_absensi')
                            ->where(
                                'userid',
                                '=',
                                $f->userid
                            )
                            ->where(
                                'tanggal',
                                '=',
                                $request->tgl
                            )
                            ->limit(1)
                            ->update(
                                array(
                                    'qj' => $difference,
                                )
                            );

                        if ($difference > 7) {
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'jis' => 1,
                                        'qjnet' => $difference - 1,
                                    )
                                );
                        } else {
                            DB::connection('mysql_local')
                                ->table('absensi_absensi')
                                ->where(
                                    'userid',
                                    '=',
                                    $f->userid
                                )
                                ->where(
                                    'tanggal',
                                    '=',
                                    $request->tgl
                                )
                                ->limit(1)
                                ->update(
                                    array(
                                        'qjnet' => $difference,
                                    )
                                );
                        }
                    }
                }
                // return response()->json(['success' => 'Data ' . $request->tgl . ' - ', date("Y-m-d", strtotime($request->tgl . "+1 days")) . ' Berhasil di Update.', 'status' => 1]);
            }
        }
        // return response()->json(['success' => 'Data ' . $request->tgl . ' - ', date("Y-m-d", strtotime($request->tgl . "+1 days")) . ' Berhasil di Update.', 'status' => 1]);
    }
    // ==================================== LOCAL ABSENCE ===================================================================

}
