@extends('layouts.app')
@section('title', 'Películas')

@section('extra-js')
<script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')

<div class="container is-fluid is-marginless is-main">


  <div class="columns is-marginless is-centered is-mobile">
    <div class="column is-11">
      <div class="columns is-mobile">
        <div class="column">
          <h1 class="title is-3">Películas</h1>
        </div>
        <div class="column is-narrow">
          <a href="{{route('movie.create')}}" class="button is-success">Crear película</a>
        </div>
      </div>

      <form class="" action="" method="get">
        <button class="button is-fullwidth is-hidden-desktop" type="button" id="show-search">Mostrar opciones de búsqueda</button>
        <div id="is-search" class="is-hidden-touch">
          <div class="columns">
            <div class="column">
              <div class="field">
                <label class="label">Nombre de la película</label>
                <div class="control">
                  <input class="input" type="text" name="name" value="{{ old('name') }}">
                </div>
              </div>
            </div>
            <div class="column">
              <div class="field">
                <label class="label">País de origen</label>
                <div class="control">
                  <input class="input" type="text" name="country" value="{{ old('country') }}">
                </div>
              </div>
            </div>
            <div class="column">
              <div class="fecha is-fullwidth">
                <label class="label">Fecha de estreno</label>
                <div class="field has-addons">
                  <input type="hidden" name="date1" id="date1" value="{{ old('date1') }}">
                  <input type="hidden" name="date2" id="date2" value="{{ old('date2') }}">
                  <div class="control is-expanded">
                    <input class="input" type="text" data-input name="date" value="{{ old('date') }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="column">
                <div class="field">
                    <label class="label">Duración</label>
                    <div class="control">
                        <input class="input timeD" type="text" name="duration" value="{{ old('duration') }}" autofocus>
                    </div>
                </div>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <div class="field">
                <label class="label">Por actor</label>
                <div class="control">
                  <input class="input" type="text" name="actorName" value="{{ old('actorName') }}">
                </div>
              </div>
            </div>
            <div class="column">
              <div class="field">
                <label class="label">Por director</label>
                <div class="control">
                  <input class="input" type="text" name="directorName" value="{{ old('directorName') }}">
                </div>
              </div>
            </div>
          </div>

          <div class="columns is-mobile">
            <div class="column">
              <div class="buttons">
                <a href="{{route('movies.index')}}" type="reset" class="button">Restablecer</a>
                <button type="submit" class="button is-info">Búsqueda</button>
              </div>
            </div>
          </div>

        </div>

        <div class="table-container">
          <table class="table is-striped is-hoverable is-fullwidth has-mobile-cards wrap-columns">
            <thead>
              <tr>
                <th>Opciones</th>
                <th class="col0"> Clave </th>
                <th class="col1"> Nombre </th>
                <th class="col2"> Sinopsis </th>
                <th class="col3"> País </th>
                <th class="col4"> Fecha de estreno </th>
                <th class="col5"> Duración </th>
                <th class="col6"> Fecha alta </th>
                <th class="col7"> Fecha última modificación </th>
                
              </tr>
            </thead>
            <tbody>

              @if ($movies->count() <= 0)
              <tr>
                <td colspan="100">No se encotraron registros</td>
              </tr>
              @else
              @foreach ($movies as $movie)
              <tr>

                <td data-label="Opciones">
                  <div class="field is-grouped">
                    <p class="control">
                      <a href="{{route('movie.show', [$movie->movieId])}}" class="button is-outlined is-small" title="Consultar">
                        <span class="icon is-small">
                          <i class="fas fa-eye" aria-hidden="true"></i>
                        </span>
                      </a>
                    </p>
                    <p class="control">
                      <a href="{{route('movie.edit', [$movie->movieId])}}" class="button is-outlined is-info is-small" title="Editar">
                        <span class="icon is-small">
                          <i class="fas fa-edit" aria-hidden="true"></i>
                        </span>
                      </a>
                    </p>
                    <p class="control">
                      <button onclick="deleteItem(event)" class="delete-item is-danger button is-outlined is-small" type="button" name="button" data-route="{{ route('movie.destroy', $movie->movieId)}}" title="Eliminar">
                        <span class="icon is-small">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </span>
                      </button>
                    </p>
                  </div>
                </td>
				<td class="col0" data-label='Clave de la película'> {{ $movie->movieId }} </td>
				<td class="col1" data-label='Nombre de la película'> {{ $movie->name }} </td>
				<td class="col2" data-label='Sinopsis de la película'> {{ empty($movie->synopsis) ? "" : $movie->synopsis }} </td>
				<td class="col3" data-label='País'> {{ empty($movie->country) ? "" : $movie->country }} </td>
				<td class="col4" data-label='Fecha de estreno'> {{ empty($movie->release) ? "" : $movie->release }} </td>
				<td class="col5" data-label='Duración'> {{empty($movie->duration)? "":$movie->duration}} </td>
				<td class="col6" data-label='Fecha de alta'> {{ $movie->created_at}} </td>
				<td class="col7" data-label='Fecha de último cambio'> {{ $movie->updated_at }} </td>
              </tr>
              @endforeach
              @endif

            </tbody>
          </table>
        </div>

        <div class="columns is-mobile">
          <div class="column">
            <strong>
              @if ($movies->total()>0) Mostrando {{ $movies->firstItem() }} - {{ $movies->lastItem() }} de @endif {{$movies->total()}} resultados
            </strong>
          </div>
          <div class="column is-narrow">
            <div class="field is-horizontal">
              <div class="field-label is-hidden-mobile">
                <label class="label">Mostrar</label>
              </div>
              <div class="field-body">
                <div class="field is-narrow">
                  <div class="control">
                    <div class="select is-fullwidth is-small">
                      <select name="pagesize" class="">
                        <option value="25" @if ($movies->perPage() == 25) selected @endif>25</option>
                        <option value="50" @if ($movies->perPage() == 50) selected @endif>50</option>
                        <option value="100" @if ($movies->perPage() == 100) selected @endif>100</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{ $movies->links() }}
      </form>
    </div>
  </div>
</div>

<form id="delete-form" action="" method="POST">
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
          @method('DELETE')
          @csrf
          <a href="#" class="card-footer-item has-text-danger" id="submit-delete">Eliminar</a>
          <a href="#" class="card-footer-item close-delete">Cancelar</a>
        </footer>
      </div>
    </div>
    <button type="button" class="modal-close is-large close-delete" aria-label="close"></button>
  </div>
</form>

@endsection
