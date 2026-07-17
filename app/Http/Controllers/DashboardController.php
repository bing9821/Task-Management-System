<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hour = now()->hour;

        if ($hour >= 5 && $hour < 12){
            $greeting = 'Good morning';
        }
        elseif ($hour >= 12 && $hour <18) {
            $greeting ='Good afternoon' ;
        }
        elseif ($hour >= 18 && $hour <24){
            $greeting = 'Good evening';
        }
        else {
            $greeting = 'Good night';
        }

        return view('dashboard',[
            'greeting' => $greeting,
        ]);
    }
}
