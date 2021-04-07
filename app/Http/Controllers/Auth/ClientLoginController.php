<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;



class ClientLoginController extends Controller

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



    protected $guard = 'client';



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

    }



    public function showLoginForm()

    {

        return view('ui.login.register');

    }



    public function login(Request $request)

    {

        if (auth()->guard('client')->attempt(['email' => $request->email, 'password' => $request->password])) {

            dd(auth()->guard('client')->user());

        }


        return back()->withErrors(['email' => 'Email or password are wrong.']);

    }

}
