<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    public function login (){
       
        return view('login');
    }

public function submissao(){

    echo "aqui";

}

}
