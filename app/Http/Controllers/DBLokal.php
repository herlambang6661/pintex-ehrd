<?php

namespace App\Http\Controllers;

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
        $ac = DB::table('karyawan')
            ->where('CHECKTIME', [$request->tgl . ' 00:00:00', date('Y-m-d', strtotime($request->tgl . "+1 days")) . ' 00:00:00'])
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
    // ==================================== LOCAL ABSENCE ===================================================================

}
