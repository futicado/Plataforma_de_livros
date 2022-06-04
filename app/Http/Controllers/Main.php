<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;

class Main extends Controller
{
    public function login()
    {

        return view('login');
    }

    public function submissao(Request $request)
    {

        //validação
        $request->validate(
            // regras de validação
            [
                'email' => 'required|max:30',
                'senha' => 'required|max:30'
            ],
            [
                'email.required' => 'O campo :attribute é obrigatório !!',
                'email.min' => 'O campo :attribute é limitado a 30 caracteres !!',
                'senha.required' => 'O campo senha é obrigatório !!'
            ]
        );

        //Informações vinda do formulário

        $email = $request->input('email');
        $senha = $request->input('senha');

        $lista = DB::select('select * from tblivro');
        // buscar no banco as informações e comparar.
        return view('Dashboard', ['lista' => $lista]);   // enviando os dados para o view do Dashboard.
    }

    public function dashboard()
    {

        $lista = DB::select('select * from tblivro');
        // buscar no banco as informações e comparar.
        return view('Dashboard', ['lista' => $lista]);
    }

    public function cadastrolivro()
    {
        return view('CadastroLivros');
    }


    public function cadastrolivrosubmissao(Request $request)
    {


        // validando o tipo de imagem que está sendo inserida no banco de imagem.
        $validapath = $request->validate(
            [
                'path' => 'mimes:jpg,bmp,png',
                'path' => 'required|image|max:200|min:100',
                'path' => 'dimensions:min_width=248,min_height=225'
            ],
            [
                'path' => 'Verifique o tipo de imagem',
                'path' => 'Verifique o tamanho da imagem',
                'path' => 'Verifique o as dimensões da imagem'
            ]
        );


        // recebendo a imagem para inserir no banco e mover para o servidor.
        $path = $request->file('path')->store('public/img');


        // realizar o cadastro no banco de dados
        $nome = $request->input('nomeliv');
        $ano = $request->input('ano');
        $email = $request->input('email');
        $autor = $request->input('autor');
        $isbn = $request->input('isbn');
        $genero = $request->input('genero');
        $descricao = $request->input('descricao');
        $status = $request->input('tipo');; // 1 Cadastrado para Doação  2 Cadastrado para Troca


        $usuario = '1'; // usuário será buscado da tabela usuários com base no login realizado e buscado o ID do usuário na outra tabela.

        $users = DB::insert('insert into tblivro (Nomeliv, Anoliv, Emailliv, Autorliv, Isbnliv, Generoliv, Descricaoliv, FKcodusuario, Statusliv, Pathliv) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$nome, $ano, $email, $autor, $isbn, $genero, $descricao, $usuario, $status, $path]);

        $lista = DB::select('select * from tblivro');

        // buscar no banco as informações e comparar.
        return redirect()->route('dashboard', ['lista' => $lista]);
    }

    public function email(){



            Mail::send('Mail.welcomemail', function ($message) {
               $message->to('jhonatam.mattoss@hotmail.com')->cc('jhonatam.mattoss@hotmail.com');
            });

       /* $lista = DB::select('select * from tblivro');
        // buscar no banco as informações e comparar.
        return redirect()->route('dashboard', ['lista' => $lista]);*/

    }

}




