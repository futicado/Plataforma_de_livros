<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    public function login (){
       
        return view('login');
    }

public function submissao( Request $request){
   
     //validação
       $request->validate(
          // regras de validação 
          [ 'email' => 'required|max:30',
            'senha' => 'required|max:30'
          ],
        [
         'email.required' => 'O campo :attribute é obrigatório !!', 
         'email.min' => 'O campo :attribute é limitado a 30 caracteres !!',
         'senha.required'=> 'O campo senha é obrigatório !!'  
        ]);
        
   
        //Informações vinda do formulário 
   
       $email= $request->input('email');
       $senha= $request->input('senha');
   
}


public function uplooad(){
    return view('upload');
}

public function upload_submissao(Request $request){

    
}

}
