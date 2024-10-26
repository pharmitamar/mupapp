<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/dashboard';

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('auth')->only('logout');
    // }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the authenticated user
        auth()->logout();

        // Invalidate the session to avoid reuse
        $request->session()->invalidate();

        // Regenerate the session token for security
        $request->session()->regenerateToken();

        // Redirect to the login page or any other page
        return redirect('/login')->with('status', 'Successfully logged out.');
    }

    /**
     * Override the default username method.
     * 
     * @return string
     */
    
    public function username()
    {
        return 'EmailId';
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        // Attempt to authenticate using EmailId and password
        $credentials = $request->only('email', 'password');
        
        if (auth()->attempt(['EmailId' => $credentials['email'], 'password' => $credentials['password']])) {
            return true;
        }

        // Attempt to authenticate using UserName and password
        if (auth()->attempt(['UserName' => $credentials['email'], 'password' => $credentials['password']])) {
            return true;
        }

        return false;
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string', // Validates 'email' field used in the form
            'password' => 'required|string',
        ]);
    }
}
