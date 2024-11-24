<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\requests\RegistrationFormRequest;

use App\Http\requests\SeekerLoginRequest;
use illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createSeeker()
    {
        return view('user.Seeker-register');
    }


    public function createEmployer()
    {
        return view('user.employer');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    const JOB_SEEKER = 'seeker';
    const JOB_POSTER = 'employer';
    public function storeSeeker(RegistrationFormRequest $request)
    {
        
        User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=> bcrypt(request('password')),
            'user_type'=>self::JOB_SEEKER

        ]);
        return redirect()->route('login')->with('successMessage','Your account has been created successfully');
    }

    public function storeEmployer(RegistrationFormRequest $request)
    {
        
        User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=> bcrypt(request('password')),
            'user_type'=>self::JOB_POSTER,
            'user_trial'=>now()->addWeek()

        ]);
        return redirect()->route('login')->with('successMessage','Your account has been created successfully');
    }




    public function login()
    {
        return view('user.login');
    }


        public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        // If authentication fails, you may want to redirect back with an error message
        return redirect()->back()->withInput($request->only('email'));
    }


    public function logout(){

        Auth::logout();
        return redirect()->route('login');
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
