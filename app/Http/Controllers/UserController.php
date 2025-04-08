<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields=$request->validate([
            'name'=>'required|min:3',
            'email'=>['required','email', Rule::unique('users','email')],
            'password'=>'required|confirmed|min:6'
            
        ]);
        //Hash Password
        $formFields['password']=bcrypt($formFields['password']);
        //create user
        $user=User::create($formFields);
        //login
        Auth::login($user);

        return redirect('/')->with('message','User Created and Logged in Successfully');
    }
    public function logout(Request $request)
    {
        auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','You have been Logged Out!!');
    }

    //show login form
    public function login(Request $request)
    {
        return view('users.login');
    }
    //authenticate user
    public function authenticate(Request $request)
    {
        $formFields=$request->validate([
            'email'=>['required','email'],
            'password'=>'required'
        ]);
        if (auth::attempt($formFields)) {
            
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now Logged In');
        }
        return back()->withErrors(['email'=>'Invalid Credentials']);
    }
    /**
     * Display the specified resource.  
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
