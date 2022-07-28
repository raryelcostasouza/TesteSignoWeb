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
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Título da Enquete</td>
          <td>Status</td>
          <td colspan="3">Ações</td>
        </tr>
    </thead>
    <tbody>
        @foreach($enquetes as $enquete)
        <tr>
            <td>{{$enquete->id}}</td>
            <td>{{$enquete->titulo}}</td>
            
            @if (date("Y-m-d") < $enquete->data_inicio)  
                <td>Não Iniciada</td>
            @elseif (date("Y-m-d") > $enquete->data_termino)
                 <td>Encerrada<td>
            @else
                   <td>Em Andamento</td>
            @endif
            
           
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