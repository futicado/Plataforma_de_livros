<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

       // buscar no banco as informações e comparar.
       return view('Dashboard');
}


public function dashboard(){

    $list=DB::select('select * from TBlivro ');

    return view('Dashboard');

}

public function cadastrolivro(){
    return view('CadastroLivros');
}


public function cadastrolivrosubmissao(Request $request){

    // realizar o cadastro no banco de dados
 $nome= $request->input('nomeliv');
 $ano= $request->input('ano');
 $email= $request->input('email');
 $autor= $request->input('autor');
 $isbn= $request->input('isbn');
 $genero= $request->input('genero');
 $descricao= $request->input('descricao');
 $status = $request->input('tipo');; // 1 Cadastrado para Doação  2 Cadastrado para Troca


 $usuario='1'; // usuário será buscado da tabela usuários com base no login realizado e buscado o ID do usuário na outra tabela.


 $users= DB::insert('insert into tblivro (Nomeliv, Anoliv, Emailliv, Autorliv, Isbnliv, Generoliv, Descricaoliv, FKcodusuario, Statusliv) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$nome, $ano, $email, $autor, $isbn , $genero, $descricao, $usuario, $status]);

 return redirect()->route('dashboard');  // retornando para página do Dashboard.

 }


}
