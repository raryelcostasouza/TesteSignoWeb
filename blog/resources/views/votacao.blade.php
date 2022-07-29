@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Votação
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
      <form method="post" action="{{ route('votacao.update', $enquete->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Título:</label>
              <input type="text" class="form-control" name="titulo" readonly value="{{ $enquete->titulo }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Data de Início: </label>
              <input type="text" class="form-control" name="data_inicio" readonly value="{{ $enquete->data_inicio }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Data de Término: </label>
              <input type="text" class="form-control" name="data_termino" readonly value="{{ $enquete->data_termino }}"/>
          </div>
          <table id="tbopcoes" class="table table bordered">
              <thead>
                  <tr>
                      <th colspan="2">Opção</th>
                      <th>Número de Votos</th>
                  </tr>                  
              </thead>
              <tbody>
                  @foreach ($enquete->opcoes as $opcao)
                  <tr>
                      <div class="form-group">
                      <td>
                          <input type="radio" name="voto" value="{{ $opcao->id }}">
                      </td>
                      <td>
                          {{ $opcao->opcao_resposta }}
                      </td>
                      <td>
                         {{ $opcao->num_votos }}
                      </td>
                      
                      </div>
                  </tr>
                  @endforeach
                  </tr>
              </tbody>
          </table>
          @if ((date("Y-m-d") > $enquete->data_inicio) && ((date("Y-m-d") < $enquete->data_termino)))
            <button type="submit" class="btn btn-success">Registrar Voto</button>
          @else
            <button type="submit" class="btn btn-success" disabled>Registrar Voto</button>
          @endif
      </form>
  </div>
</div>
@endsection