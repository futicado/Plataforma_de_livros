<div
    style="background-image: url('../storage/app/img/livros.jpg');  background-size: cover;  background-repeat: no-repeat; height: 100%;">
    <div class="d-flex justify-content-center">

{{-- Erros   Erros no formulário. --}}
@if ($errors->any())

<center> 
           @foreach ($errors->all() as $mensagem_erro)
           <div class="alert alert-info ">
                <p>{{ $mensagem_erro }}</p>
            </div>
        @endforeach
    </center>
@endif
        <center>
            <form class="form-control" method="post" action="{{ Route('submissao') }}">
                @csrf
                <div class="container-sm">
                    <img class="mb-4" src='../storage/app/img/logo.png' alt="" width="170" height="120">
                    <h1 class="h3 mb-3 fw-normal">Plaforma de Livros</h1>

                    <div class="form-floating">
                        <label for="floatingInput">Email&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                        <input type="email" class="form-control" id="floatingInput" name="email"
                            placeholder="name@example.com" value="{{ old('email') }}">
                    </div>
                    <br>
                    <div class="form-floating">
                        <label for="floatingPassword">Password</label>
                        <input type="password" class="form-control" id="floatingPassword" name="senha"
                            placeholder="Password" value="{{ old('senha') }}">
                    </div>
                    <br>
                    <center><button type="submit">Entrar</button></center>
                    <br>
                    <br>
                </div>
                <p class="mt-5 mb-3 text-muted">© 2022</p>
            </form>
    </div>
    </center>
</div>


