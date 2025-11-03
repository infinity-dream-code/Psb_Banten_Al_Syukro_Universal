<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\DataPeserta;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use App\Models\MasterRole;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

  public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    $user = User::where('username', $credentials['username'])
        ->where('plain_password', $credentials['password'])
        ->first();

    if (!$user) {
        return back()->with('login_error', 'Username atau password salah.');
    }

    Auth::login($user);
    $request->session()->regenerate();

    if ($user->role === 'admin') {
        return redirect()->intended('pages/display/home');
    }

    if ($user->role === 'peserta') {
        $peserta = DataPeserta::where('id_user', $user->id)->first();

        if ($peserta) {
            $jwtKey = "53c2f9aace5478a11815c65fcdb1a3dc29b60c3e102489384e3c1701f4355fa4";
            $payload = ["nomor_pendaftaran" => $peserta->no_pendaftaran];
            $tokenCek = JWT::encode($payload, $jwtKey, 'HS256');

            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json'
                ])->post("10.99.23.111/WS_PSB/WS_PSB_MASTER/index.php", [
                    "token"  => $tokenCek,
                    "method" => "CekTagihan"
                ]);

                $result = $response->json();

                if (isset($result['status']) && $result['status'] == 200 && isset($result['data'][0])) {
                    $statusBayar = $result['data'][0]['StatusBayar'] ?? "0";
                    $tanggalBayar = $result['data'][0]['TanggalBayar'] ?? null;
                    $peserta->status_paid = ($statusBayar == "1") ? 1 : 0;
                    if ($tanggalBayar) {
                        $peserta->tgl_bayar_daftar = $tanggalBayar;
                    }
                    $peserta->save();
                }
            } catch (\Exception $e) {
            }

            if ($peserta->status_paid == 0) {
                $payload = ["nomor_pendaftaran" => $peserta->no_pendaftaran];
                $token = JWT::encode($payload, $jwtKey, 'HS256');
                $link = url("PmbMstPendaftarans/success_enroll/{$token}");

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/ServiceLogin')->with([
                    'need_payment' => true,
                    'redirect_link' => $link
                ]);
            }
        }

        return redirect()->intended('pages/dashboard');
    }

   $role = MasterRole::where('nama_role', $user->role)->first();

if ($role) {
    $slugRole = Str::slug($role->nama_role, '-');
    return redirect()->intended('pages/display/home/' . $slugRole);
}


    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/ServiceLogin')->with('error', 'Role tidak dikenali.');
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/ServiceLogin')->with('success', 'Anda berhasil logout.');
    }
}
