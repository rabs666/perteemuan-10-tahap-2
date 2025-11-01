<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
 

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput($request->only('email'));
        }

        $user = User::with(['roleUsers' => function($query) {
            $query->where('status', 1); // 1 = active
        }, 'roleUsers.role'])
        ->where('email', $request->email)
        ->first();

        if (!$user){
            return redirect()->back()
                                ->withErrors(['email' => 'Email atau password salah.'])
                                ->withInput($request->only('email'));
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                             ->withErrors(['password' => 'Password salah.'])
                             ->withInput($request->only('email'));
        }
        $namaRole = Role::where('idrole', $user->roleUsers[0]->idrole ?? null)->first();

        // login user ke session
        Auth::login($user);

        // simpan session user
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $namaRole->nama_role ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUsers[0]->status ?? 1
        ]);

        // Redirect berdasarkan role
        $userRole = $namaRole->nama_role ?? 'user';
        
        switch ($userRole) {
            case 'Administrator':
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
            case 'Dokter':
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
            case 'Perawat':
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
            case 'Resepsionis':
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
            case 'Pemilik':
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
            default:
                return redirect()->intended('/home')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
    