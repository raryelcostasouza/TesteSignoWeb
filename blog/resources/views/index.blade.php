@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
      @endif
  <h3>Enquetes Cadastradas</h3>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Título da Enquete</td>
          <td>Status</td>
          <td colspan="3">Ações</td>
        </tr>
    </thead>
    <tbody>
        @foreach($enquetes as $enquete)
        <tr>
            <td>{{$enquete->titulo}}</td>
            
            @if (date("Y-m-d") < $enquete->data_inicio)  
                <td>Não Iniciada</td>
            @elseif (date("Y-m-d") > $enquete->data_termino)
                 <td>Encerrada</td>
            @else
                   <td>Em Andamento</td>
            @endif
            
           
            <td><a href="{{ route('votacao.edit', $enquete->id)}}" class="btn btn-success">Votar</a></td>
            <td><a href="{{ route('enquete.edit', $enquete->id)}}" class="btn btn-primary">Editar</a></td>
            <td>
                <form action="{{ route('enquete.destroy', $enquete->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection