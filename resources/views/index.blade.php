
@extends('app')

@section('titulo', 'Página inicial')

@section('conteudo')
  <h1>Lista de Diaristas</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Telefone</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>

      @forelse ($diaristas as $diarista)
      <tr>
        <th scope="row">{{ $diarista->id }}</th>
        <td>{{ $diarista->nome_completo }}</td>
        <td>{{ \Clemdesign\PhpMask\Mask::apply($diarista->telefone, '(00) 90000-0000') }}</td>
        <td>
          <a href="{{route('diaristas.edit', $diarista)}}" class="btn btn-sm btn-primary">Editar</a>&nbsp;
          <a
            href="{{route('diaristas.delete', $diarista)}}" 
            class="btn btn-sm btn-danger"
            onclick="return confirm('Deseja mesmo apagar o registro?')"
          >Excluir</a>
        </td>
      </tr>

      @empty
      <tr>
        <th></th>
        <td>Nenhum registro cadastrado</td>
        <td></td>
        <td></td>
      </tr>

      @endforelse
    </tbody>
  </table>

  <a href="{{route('diaristas.add')}}" class="btn btn-sm btn-success">Adicionar Diarista</a>  
@endsection
