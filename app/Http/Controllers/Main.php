<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Mail\Mailer as MailMailer;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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
        $a=0;
        foreach($lista as $dado ){
            if($dado->Emailliv==$email){
                $a=1;
            }
        }

        if($a == 1){
            $request->session()->put('email', $email);
            // buscar no banco as informações e comparar.
            return view('Dashboard', ['lista' => $lista]);   // enviando os dados para o view do Dashboard.

        }else{
            echo "<script>alert('Você não possui cadastro na plataforma, redirecionando... ')</script>";
            return view('cadastro');   // enviando os dados para o view do Dashboard.
        }

    }


    public function cadastro(){

        return view('cadastro');
    }

    public function verificacadastro(Request $request){

        $request->validate(
            // regras de validação
            [
                'email' => 'required|max:30',
                'senha' => 'required|max:30',
                'nome' => 'required|min:15'
            ],

            [
                'email.required' => 'O campo :attribute é obrigatório !!',
                'email.min' => 'O campo :attribute é limitado a 30 caracteres !!',
                'senha.required' => 'O campo senha é obrigatório !!',
                'nome.min' => 'Verifique o nome é muito curto!!',
                'nome.required' => 'Necessário inserir o nome!!'

            ]
        );


        $nome= $request->nome;
        $email = $request->email;
        $senha = $request->senha;

        $list=DB::insert('insert into tbusuario (Pkcodu, Nomeu, emailu, senhau) values (?, ?, ?, ?)', [null,  $nome, $email, $senha]);

        $lista = DB::select('select * from tblivro');
        // buscar no banco as informações e comparar.
        return view('Dashboard', ['lista' => $lista]);

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

    public function email(Request $request){
        $nome = $request->nome;
        $descricao =  $request->descricao;
        $mensagem = $request->mensagem;
        $pkcodliv = $request->pkcodliv;

        $email = $request->session()->get('email');

        $request->session()->put('pk',$pkcodliv);

       $data = [
            'name' => $nome,
            'descricao' => $descricao,
            'email' => $email,
            'mensagem' => $mensagem
        ];


       // $pk=$$_SESSION()->$_GET('pk');
       // $lista = DB::select("select Emailliv from tblivro where pkcodliv=$pk");

        //$email =$lista[0]->Emailliv;


       Mail::send('mail.welcomemail',['name' => $nome ,'descricao' => $descricao, 'email' => $email,  'mensagem' => $mensagem],function($m){

            $m->from('plataformadelivros@gmail.com','Plataforma de Livros');
            $m->to('jhonatam.mattoss@hotmail.com');
        });
   // return view('mail.welcomemail',['livro' => $data]);
    echo "ok";
    }

}




