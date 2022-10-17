<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // \session()->flush();
        // dd(session()->all());
        // dd(auth()->user()->id);

        // auth()->loginUsingId(3);
        // if (Gate::allows('edit-user')) {
        //     return "yes";
        // }
        // return "no";

        return view('home');
    }

    public function socialite()
    {
        return view('auth.socialite');
    }

}
