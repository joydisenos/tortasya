<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Legal;

class HomeController extends Controller
{
   
    public function index()
    {
        return view('home');
    }

    public function nosotros($pagina = null)
    {
        if($pagina == null)
        {
            $legal = Legal::where('slug' , 'nosotros')->first();
        }else{
            $legal = Legal::where('slug' , $pagina)->first();
        }

        return view('legales' , compact('legal'));
    }
}
