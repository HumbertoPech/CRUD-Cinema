@extends('layouts.app')
@section('title', $movie->name)
@section('extra-js')
<script src="{{ asset('js/show.js') }}"></script>
@endsection
@section('content')

<div class="container is-fluid is-marginless is-main">


  <div class="columns is-marginless is-centered is-mobile">
    <div class="column is-11">

      <div class="columns is-mobile">
        <div class="column">
          <h1 class="title is-3">Película: {{$movie->name}}</h1>
        </div>
      </div>
      <hr class="is-marginless">

      <div class="columns">
        <div class="column">
          <div class="buttons">
            <a href="{{route('movies.index')}}" class="button">Regresar</a>
            <a href="{{route('movie.edit', $movie->movieId)}}" class="button is-info">Editar película</a>
            <form id="delete-form" action="{{ route('movie.destroy', $movie) }}" method="POST">
              @method('DELETE')
              @csrf
              <button id="button-delete" type="button" class="button is-danger">Eliminar película</button>
            </form>
          </div>
        </div>
      </div>
      <table class="table is-bordered is-striped is-hoverable is-fullwidth">
        <tbody>
          <tr>
            <td rowspan="6" width="250px" height="400px">
              @if (!empty($image))
              <figure class="image">
                <img src="{{$image}}" style="object-fit: contain;width: 250px;height: 400px;" alt="{{$movie->name}}">
              </figure>
              @endif
            </td>
            <th>
              Nombre de la película
            </th>
            <th>
              Fecha de estreno
            </th>
            <th>
              Duración
            </th>
          </tr>
          <tr>
            <td>
              {{$movie->name}}
            </td>
            <td>
              {{$movie->release}}
            </td>
            <td>
              {{$movie->duration}}
            </td>
          </tr>
          <tr>
            <th colspan="3">
              Sinopsis
            </th>
          </tr>
          <tr>
            <td rowspan="3" colspan="3">
              {{$movie->synopsis}}
            </td>
          </tr>

        </tbody>


      </table>
      <hr>
      <h5 class="title is-5">Actores</h5>
      <table class="table is-fullwidth  is-bordered">
        <tbody id="seller-tbody">
          @forelse ($movie->actors as $actor)
          <tr>
            <th>
              Nombre
            </th>
            <td>
              {{$actor->name}}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="100" id="seller-is-empty">No hay actores</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <h5 class="title is-5">Directores</h5>
      <table class="table is-fullwidth  is-bordered">
        <tbody id="seller-tbody">
          @forelse ($movie->directors as $director)
          <tr>
            <th>
              Nombre
            </th>
            <td>
              {{$director->name}}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="100" id="seller-is-empty">No hay directores</td>
          </tr>
          @endforelse
        </tbody>
      </table>

    </div>
  </div>
</div>
</div>

<div class="modal" id="delete-modal">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          Eliminar
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          ¿Seguro que deseas eliminar este registro?
        </div>
      </div>
      <footer class="card-footer">
        <a href="#" class="card-footer-item has-text-danger" id="submit-delete">Eliminar</a>
        <a href="#" class="card-footer-item close-delete">Cancelar</a>
      </footer>
    </div>
  </div>
  <button type="button" class="modal-close is-large close-delete" aria-label="close"></button>
</div>
@endsection