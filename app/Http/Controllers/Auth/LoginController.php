<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


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
    // protected $redirectTo = '/dashoboard';

        // Override redirectTo method
        protected function redirectTo()
        {
            // Check the user's role and redirect accordingly
            if (Auth::user()->role === 'admin') {
                return route('admin.dashboard');  // Redirect to admin dashboard

            } elseif (Auth::user()->role === 'student') {
                return route('student.dashboard');  // Redirect to student dashboard

            }
    
            // Default redirect path if no role matches
            return '/home';
        }
    

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
}
