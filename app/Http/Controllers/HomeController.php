<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Listing;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        return view('dashboard');
    }

    public function contacts(){
        $listings = Listing::all();
        $agel_members = Listing::where('agel', 1)->orderBy('id')->get();
        
        error_log($agel_members);
 // Cela affichera les deux variables
    
        return view('contacts', compact('agel_members','listings'));
    }
    
}
