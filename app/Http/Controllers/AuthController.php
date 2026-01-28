<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'login_as' => 'required|in:admin,siswa'
        ]);
        //LOGIN ADMIN
        if ($request->login_as === 'admin') {
            if (!Auth::attempt([
                'username' => $request->username,
                'password' => $request->password,
            ])) {
                return back()->withErrors([
                    'username' => 'Username atau password admin salah'
                ])->withInput();
            }

            $request->session()->regenerate();
            session(['role' => 'admin']);

            return redirect()->route('admin.dashboard');
        }
        //LOGIN SISWA
         if ($request->login_as === 'siswa') {

            $siswa = Siswa::where('nisn', $request->username)->first();

            if (!$siswa || !Hash::check($request->password, $siswa->password)) {
                return back()->withErrors([
                    'username' => 'NISN atau password siswa salah'
                ])->withInput();
            }

            // SIMPAN SESSION SISWA
            session([
                'login_siswa' => true,
                'siswa_id'    => $siswa->id,
                'siswa_name'  => $siswa->nama,
                'role'        => 'siswa',
            ]);

            $request->session()->regenerate();

            return redirect()->route('siswa.input_aspirasi.index');
        }
    }
    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('login');
    }
}
