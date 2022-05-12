@extends('Layout.layout')
@section('conteudo')
<div class="container-fluid">
   <form action="" method="POST" action="{{route('upload_submit')}}" enctype="multipart/form-data">
     @csrf
     <input type="file" name="arquivo">
      <br>
      <input type="submit" value="enviar">
    </form>
</div>
@endsection
