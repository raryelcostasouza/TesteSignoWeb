@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Editar Dados de Enquete
  </div>
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
      <form method="post" action="{{ route('enquete.update', $enquete->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Título:</label>
              <input type="text" class="form-control" name="titulo" value="{{ $enquete->titulo }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Data de Início: </label>
              <input type="text" class="form-control" name="data_inicio" value="{{ $enquete->data_inicio }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Data de Término: </label>
              <input type="text" class="form-control" name="data_termino" value="{{ $enquete->data_termino }}"/>
          </div>
          <table id="tbopcoes" class="table table bordered">
              <thead>
                  <tr>
                      <th>Opção</th>
                      <th><a id="btnAddOption" href="#" class="btn btn-primary">+</a></th>
                  </tr>                  
              </thead>
              <tbody>
                  @php 
                    $i = 0;
                  @endphp
                  @foreach ($enquete->opcoes as $opcao)
                  <tr>
                      <div class="form-group">
                      <td>
                          {{$i+1 }}
                      </td>
                      <td>
                          <input type="text" name="opcao_resposta[]" value="{{ $opcao->opcao_resposta }}" required>
                      </td>
                      @if ($i > 2)
                        <td><a id="hey" href="#" class="btn btn-danger remove btnRemove"><i class="fas fa-times"></i>Remover</a></td>
                      @endif
                      </div>
                  </tr>
                  @php
                    $i++;
                  @endphp
                  @endforeach
                  </tr>
              </tbody>
          </table>
          <button type="submit" class="btn btn-primary">Atualizar Dados</button>
      </form>
  </div>
</div>
@endsection