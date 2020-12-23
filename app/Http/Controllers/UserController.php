<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (Auth::check()) {
                return $next($request);
            }
            else {
                abort(403);
            }
        })->only("showList");
        //$this->middleware("AuthUser")->only(["showList", 'index']);
        //$this->middleware("AuthUser")->except(["showList", 'index']);
//        $this->middleware("AuthUser");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showList(Request $request)
    {
      //  $data = $request->cookie();



        //dd($user);

        return view("list");
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("login.create");
    }
    public function Auth(LoginFormRequest $request)
    {
        $file = $request->file('upload');
     // $file = $request->upload;
      //dd($request->file('upload')->getClientOriginalName);
       // $request->file("upload")->storeAs(public_path(""), $request->file('upload')->getClientOriginalName());
      //  $request->file("upload")->storePubliclyAs("", $request->file('upload')->getClientOriginalName());
        $credentials = $request->only('email', 'password');

      //  dd(111);
//        if (Auth::guard('admin')->attempt($credentials)) {
//           dd($request);
//        }

//        DB::enableQueryLog();
//        dd(DB::getQueryLog());
        if (Auth::attempt($credentials, true)) {

           // $request->session()->push('user.'.rand(1,100).'.developers', 'adsfasdfas');

//            dd(session()->all());
//
//            $request->session()->regenerate();
//            $request->session()->put('key', 'value');
//            DB::table("sessions")->insert(
//                [
//                    'payload'=>1,
//                    'last_activity'=> 2323,
//                    'user_id'=>222,
//                    'ip_address'=>"asdfasdfasd",
//                    'user_agent'=>"asdfasd",
//
//                ]);
            //$request->session()->flash('status', 'Task was successful!');
           //$request->session()->push('login', true);

            return redirect()->route("list");
        }
//        else {
//            Session::flash("errorUP", "Password or Email is incorrect!.");
//            return view("login");
//        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 1111;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $username = $request->old('email');
        return view("login", compact(['username']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterFormRequest $request)
    {
        $lg = new User();
        $lg->fill($request->all());
        $lg->password = Hash::make($request->password);
        $lg->save();
        Session::flash("success", "Add member successfully");
        return view("login");
    }
}
