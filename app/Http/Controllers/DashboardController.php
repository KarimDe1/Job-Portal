<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function resend(Request $request)
    {
        $user=Auth::user();
        if($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('success','Your email was verified');
        }
            
            $user->sendEmailVerificationNotification();
            
            return back()->with('success','Verfication link sent successfully');

    }

    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function verify(){

        return view('user.verify');
    }


    public function index()

    {
        return view('dashboard');
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
    public function store(Request $request)
    {
        //
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
