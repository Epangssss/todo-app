<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login'); // Menampilkan halaman login
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentikasi dengan memeriksa email dan password
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            $user = Auth::user();

            // Jika role pengguna adalah admin, arahkan ke dashboard admin
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard'); // Pastikan ada route admin.dashboard
            }

            // Jika role pengguna bukan admin, arahkan ke dashboard user
            return redirect()->route('user.dashboard'); // Pastikan ada route user.dashboard
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout dan invalidasi sesi
        Auth::guard('web')->logout();

        // Hapus data sesi dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama setelah logout
        return redirect('/');
    }
}
