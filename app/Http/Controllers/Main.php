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
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Else_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class Main extends Controller
{
    public function login() {return view('login');}
    public function cadastro(){return view('cadastro'); }
    public function cadastrolivro() {return view('CadastroLivros');}
    public function sair(Request $request){ $request->session()->forget('email');  return view('login'); }

    public function dashboard() {
        if(session()->get('email')== null ){

        }else{
         $lista = DB::select('select * from tblivro');
         // buscar no banco as informações e comparar.
         return view('Dashboard', ['lista' => $lista]);
        }

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
        $request->session()->put('email', $email); // criando a variavel da sessão
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

         $lista = DB::select("select Emailliv from tblivro where pkcodliv=$pkcodliv");

         $a=$lista[0]->Emailliv;

          $GLOBALS["j"]=$a;

          Mail::send('mail.welcomemail',['name' => $nome ,'descricao' => $descricao, 'email' => $email,  'mensagem' => $mensagem],function($m,){

            $m->from('plataformadelivros@gmail.com','Plataforma de Livros');
            $m->to($GLOBALS['j']);

        });

        echo "<script>alert('E-mail enviado com sucesso !!!');</script>";

        return redirect()->action('Main@dashboard')->with('mensagem','E-mail enviado com sucesso!' );

        //return redirect()->route('dashboard', ['lista' => $lista]);

    }

    public function submissao(Request $request){

        //validação
        $request->validate(
                // regras de validação
                [   'email' => 'required|max:30',
                    'senha' => 'required|max:30'
                ],
                [   'email.required' => 'O campo :attribute é obrigatório !!',
                    'email.min' => 'O campo :attribute é limitado a 30 caracteres !!',
                    'senha.required' => 'O campo senha é obrigatório !!'
                ]
            );

            //Informações vinda do formulário

            $email = $request->input('email');
            $senha = $request->input('senha');

        $listau = DB::select('select * from tbusuario');
        $lista = DB::select('select * from tblivro');
            $a=0;

            foreach($listau as $dado ){
                if($dado->emailu==$email && $dado->senhau=$senha){
                    $a=1;
                }
            }

            if($a == 1){
                $request->session()->put('email', $email); // criando a variavel da sessão
                return view('Dashboard', ['lista' => $lista]);   // enviando os dados para o view do Dashboard.
            }else{
                echo "<script>alert('Você não possui cadastro na plataforma, redirecionando... ')</script>";
                return redirect()->route('cadastro');// enviando os dados para o view do Dashboard.
            }


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
            try {
            $list=DB::insert('insert into tbusuario (Nomeu, emailu, senhau) values (?, ?, ?)', [$nome, $email, $senha]);
            }catch(\Illuminate\Database\QueryException $ex){

                echo "<script> alert('E-mail já esta sendo utilizado por outro usuário !!!');</script>";
                return view('cadastro');// enviando os dados para o view do Dashboard.
            }

            $lista = DB::select('select * from tblivro');
            // buscar no banco as informações e comparar.
            return view('Dashboard', ['lista' => $lista]);

    }

    public function excluir(Request $request, $id){

        $lista = DB::select("select Emailliv from tblivro where pkcodliv=$id");

        $emailCadastro=$lista[0]->Emailliv;

        $email=$request->session()->get('email');

        if($emailCadastro==$email){
            DB::delete("delete From tblivro where pkcodliv=$id");
            echo "<script>alert('Anuncio do livro excluído com sucesso !!!');</script>";
            $lista = DB::select('select * from tblivro');
            return redirect()->action('Main@dashboard')->with('mensagem','Anúncio do livro deletado!' );

        }else{
             echo "<script>alert('Anuncio do livro não pode ser excluído, pois pertence a outro usuário !!!');</script>";
             $lista = DB::select('select * from tblivro');
             return redirect()->action('Main@dashboard')->with('mensagem','Anúncio pertence a outro usuário e não pode ser deletado!' );
            }

    }





 }





