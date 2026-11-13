<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
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
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/\A[a-zA-Z0-9_.-]+\z/',
                'unique:users,username',
            ],
            'password' => [
                'bail',
                'required',
                'string',
                'min:12',
                'confirmed',
                function (string $attribute, mixed $value, Closure $fail): void {
                    if (strlen($value) > 72) {
                        $fail('The password may not exceed 72 bytes.');
                    }
                },
            ],
        ]);

        $employeeRole = Role::query()->where('name', 'employee')->firstOrFail();
        $user = $employeeRole->users()->create([
            'username' => $request->string('username')->toString(),
            'password' => $request->string('password')->toString(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect(route('dashboard', absolute: false));
    }
}
