<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $Dblocal;
    protected $weatherService;

    public function __construct(DBLokal $Dblocal, WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
        $this->Dblocal = $Dblocal;
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('login');
    }

    /**  
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        } else {
            $rememberMe = $request->remember ? true : false;
            $up = $request->only(["username", "password"]);
            if (Auth::attempt($up, $rememberMe)) {
                if ($_SERVER['SERVER_NAME'] == "127.0.0.1") {
                    try {
                        return response()->json([
                            "status" => true,
                            "redirect" => url("loaderlocal")
                            // "redirect" => url("dashboard")
                        ]);
                    } catch (\Throwable $th) {
                        return view('products.dashboard');
                    }
                } else {
                    return response()->json([
                        "status" => true,
                        "redirect" => url("dashboard")
                    ]);
                }
            } else {
                return response()->json([
                    "status" => false,
                    "header" => "Invalid credentials",
                    "errors" => ["Cek Username & Password Anda"],
                ]);
            }
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }

        $data = $request->all();
        $user = $this->create($data);

        Auth::login($user);

        return response()->json([
            "status" => true,
            "redirect" => url("dashboard")
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            $latitude = session('latitude');
            $longitude = session('longitude');
            $judul = "Dashboard";
            $countLamaran = DB::table('penerimaan_lamaran')->count();
            $countKaryawan = DB::table('penerimaan_karyawan')->where('status', 'like', '%Aktif%')->count();
            $countKomunikasi = DB::table('absensi_komunikasiitm')->count();
            $absensi = DB::table('absensi_absensi')->orderBy('tanggal', 'desc')->limit('1')->get();
            $kontrak = DB::table('penerimaan_legalitas as l')->join('penerimaan_karyawan as k', 'l.userid', '=', 'k.userid')->where('k.status', 'like', '%Aktif%')->where('l.nmsurat', 'Perjanjian Kontrak')->where('l.tglak', '>', date('Y-m-d'))->orderBy('l.tglak', 'asc')->limit('50')->get();
            $sp = DB::table('penerimaan_legalitas')->where('nmsurat', 'Surat Peringatan (SP)')->where('legalitastgl', '>=', now()->subMonths(6))->orderBy('legalitastgl', 'desc')->limit('50')->get();

            foreach ($absensi as $ab) {
                $absen = Carbon::parse($ab->tanggal)->format('d-m-Y');
            }

            if (!$latitude || !$longitude) {
                return view('products.dashboard', [
                    'active' => 'Dashboard',
                    'judul' => 'Dashboard',
                    'weatherData' => 'N/A',
                ]);
            }
            $currentWeatherData = $this->weatherService->getCurrentWeatherData($latitude, $longitude);

            return view('products.dashboard', [
                'judul' => $judul,
                'lamaran' => $countLamaran,
                'karyawan' => $countKaryawan,
                'komunikasi' => $countKomunikasi,
                'weatherData' => $currentWeatherData,
                'absen' => $absen,
                'kontrak' => $kontrak,
                'sp' => $sp,
            ]);
        } else {
            // return view('login');
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function updateLocation(Request $request)
    {
        // $request->validate([
        //     'latitude' => 'required|numeric',
        //     'longitude' => 'required|numeric',
        // ]);

        // Simpan lokasi ke session atau database
        session(['latitude' => $request->latitude]);
        session(['longitude' => $request->longitude]);

        return response()->json(['status' => 'Location updated']);
    }
}
