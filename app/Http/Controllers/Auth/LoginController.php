<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

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

    public function username()
    {
        return 'name';
    }

    protected function showLoginForm()
{
    if (auth()->check()) {
        return redirect('/dashboard'); // যেকোনো route যেখানে তুমি পাঠাতে চাও
    }

        $usernames = User::query()->select('name')->orderBy('name')->get();
        return view('auth.login', compact('usernames'));
}

    protected function redirectTo()
    {
        $user = auth()->user();
        if ($user && ( ($user->role ?? null) === 'Kitchen Staff' || (method_exists($user,'hasRole') && $user->hasRole('Kitchen Staff')) )) {
            return '/kitchen';
        }
        if ($user && ( ($user->role ?? null) === 'Manager' || (method_exists($user,'hasRole') && $user->hasRole('Manager')) )) {
            return '/manager';
        }
        if ($user && ( ($user->role ?? null) === 'Cashier' || (method_exists($user,'hasRole') && $user->hasRole('Cashier')) )) {
            return '/cashier';
        }
        return '/dashboard';
    }

    protected function authenticated(Request $request, $user)
    {
        try {
            if (($user->role ?? null) && method_exists($user, 'hasRole') && method_exists($user, 'assignRole')) {
                if (! $user->hasRole($user->role)) {
                    $user->assignRole($user->role);
                }
            }
        } catch (\Throwable $e) {}
    }

}
