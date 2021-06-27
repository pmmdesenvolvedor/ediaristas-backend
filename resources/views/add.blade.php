
@extends('app')

@section('titulo', 'Adicionar diarista')

@section('conteudo')
  <h1>Adicionar nova diarista</h1>

  <form action="{{ route('diaristas.store') }}" method="POST" enctype="multipart/form-data">
    
    @include('_form')
  
  </form>
@endsection
