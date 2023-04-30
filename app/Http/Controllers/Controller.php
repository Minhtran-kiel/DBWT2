<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function show_menu(){
        return view('menu');
    }

    public function show_philosophie(){
        return view('philosophie');
    }

    public function show_career(){
        return view('career');
    }
}
