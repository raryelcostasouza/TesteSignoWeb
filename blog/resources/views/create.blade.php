<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Adicionar Enquete
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
      <form method="post" action="{{ route('enquete.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Título:</label>
              <input type="text" class="form-control" name="titulo"/>
          </div>
          <div class="form-group">
              <label for="cases">Data de Início:</label>
              <input type="text" class="form-control" name="data_inicio"/>
          </div>
          <div class="form-group">
              <label for="cases">Data de Término:</label>
              <input type="text" class="form-control" name="data_termino"/>
          </div>
          <table id="tbopcoes" class="table table bordered">
              <thead>
                  <tr>
                      <th>Opção</th>
                      <th><a id="btnAddOption" href="#" class="btn btn-primary">+</a></th>
                  </tr>                  
              </thead>
              <tbody>
                  @for ($i =0; $i <= 2; $i++)
                  <tr>
                      <div class="form-group">
                      <td>
                          {{$i+1 }}
                      </td>
                      <td>
                          <input type="text" name="opcao_resposta[]" required>
                      </td>
                      </div>
                  </tr>
                  @endfor
                  </tr>
              </tbody>
          </table>
          <button type="submit" class="btn btn-primary">Adicionar Enquete</button>
      </form>
  </div>
</div>
@endsection
