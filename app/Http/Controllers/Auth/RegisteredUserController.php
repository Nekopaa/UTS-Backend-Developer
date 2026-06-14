<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    private const ADMIN_SECRET_CODE = 'PRIMA';

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'],
            'company_code' => ['required_if:role,admin', 'nullable', 'string'],
        ]);

        if ($request->role === 'admin' && $request->company_code !== self::ADMIN_SECRET_CODE) {
            throw ValidationException::withMessages([
                'company_code' => 'Kode perusahaan tidak valid.',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Jika admin, kode perusahaan sudah tervalidasi dengan rules (harus PRIMA)
        // Tidak ada penyimpanan kode perusahaan di tabel users.


        event(new Registered($user));

        Auth::login($user);

        return redirect()->route($request->role === 'admin' ? 'admin.dashboard' : 'dashboard');
    }
}
