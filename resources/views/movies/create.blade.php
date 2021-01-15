@extends('layouts.app')
@section('title', 'Crear película')
@section('extra-js')
<script src="{{ asset('js/components/movie.js') }}"></script>
@endsection
@section('content')

<div class="container is-fluid is-marginless  is-main">
  <div class="columns is-marginless is-centered is-mobile">
    <div class="column is-11">
      <div class="columns is-mobile">
        <div class="column">
          <h1 class="title is-3">Crear película</h1>
        </div>
      </div>
      <hr class="is-marginless">
      <form class="createForm" action="{{route('movie.store')}}" method="post" enctype="multipart/form-data">
        @include('movies.form')
        <div class="field">
          <div class="control">
            <a href="{{ route('movies.index') }}" class="button is-light">Cancelar</a>
            <button type="submit" class="submitButton button is-success">Crear película</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection