<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class NAuthContro extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('home');
        }
    }
    public function logina(Request $request){
        $data = [];
        //Validate input
        $customMessages = [
            'email.required' => 'The email is required.',
            'password.min' => 'The password must be atleast 8 digits.',
        ];
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ],$customMessages);

        //If validation fails
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],400);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if(isset(Auth::user()->info))
            return response()->json(['success'=>true,'move'=>'final'],200);
            else
            return response()->json(['success'=>true,'move'=>'build'],200);
        }
        return response()->json(['error'=>'Combination Does not Exist'],400);
        
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $data)
    {
        return Validator::make($data->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
    }
    public function registera(Request $request){
        $customMessages = [
            'password.min'=>'The Password must be minimum 8 digits.',
            'email.required' => 'The email is required.',
            'email.unique' => 'The email is already registered.',
        ];
        $validator = Validator::make($request->all(),[
            'name' => 'string|required',
            'email' => 'email|unique:users,email|nullable',
            'password' => 'required|min:8'
        ],$customMessages);

        //If validation fails
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],400);
        }
        $this->validator($request);
        $user=$this->create($request);
        $this->login($request);
    }
    public function token(){
        return response()->json(['_token'=>csrf_token()],200);
    }
}
