@extends('layouts.app')
@section('title', 'Editar película: ' . $movie->name)
@section('extra-js')
    <script src="{{ asset('js/components/movie.js') }}"></script>
@endsection
@section('content')

  <div class="container is-fluid is-marginless is-main">
    <div class="columns is-marginless is-centered is-mobile">
      <div class="column is-11">

        <div class="columns is-mobile">
          <div class="column">
            <h1 class="title is-3">Editar película: {{$movie->name}}</h1>
          </div>
        </div>
        <hr class="is-marginless">

        @if (session('success'))
          <div class="notification is-success">
            <button class="delete" type="button"></button>
            La película se ha actualizado correctamente
          </div>
        @endif
        <form class="" action="{{route('movie.update', $movie)}}" method="post" enctype="multipart/form-data">
          @method('PATCH')
          @include('movies.form')
          <input type="hidden" name="back_to" value="{{ old('back_to') ?? url()->previous() }}">
          <div class="buttons">
            <a href="{{ old('back_to') ?? url()->previous() }}" class="button is-light">Cancelar</a>
            <button type="submit" class="button is-info">Guardar película</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection