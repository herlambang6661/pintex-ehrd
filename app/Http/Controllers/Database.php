<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Database extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }

    //Data pengguna
    public function pengguna()
    {
        $judul = "Data Pengguna";
        $database = "active";
        $pengguna = "active";
        $users = User::where('name', '!=', 'Administrator')->get();
        $totalUsers = $users->count();

        return view('products.05_database.pengguna', [
            'judul' => $judul,
            'database' => $database,
            'pengguna' => $pengguna,
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $check = DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $arr = array('msg' => 'Something goes to wrong. Please try later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Data: ' . $request->name . ' ' . $request->username . '' . $request->password . '' . $request->role . ' telah berhasil disimpan', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $check = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'updated_at'    => now(),

            ]);

        $arr = array('msg' => 'Ada kesalahan. Silakan coba lagi nanti.', 'status' => false);

        if ($check) {
            $arr = array('msg' => 'Data berhasil diperbarui', 'status' => true);
        }

        return response()->json($arr);
    }
}
