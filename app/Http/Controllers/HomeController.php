<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function offer($token) {

        $offer = Offer::where('link', env('APP_URL').'/offer/'.$token)->first();
        
        if(!$offer) return redirect(route('homepage'));
        
        return view('offer', compact('offer'));
    }
}
