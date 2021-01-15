@extends('layouts.app')
@section('title', $director->name)
@section('extra-js')
  <script src="{{ asset('js/show.js') }}"></script>
@endsection
@section('content')

  <div class="container is-fluid is-marginless is-main">


    <div class="columns is-marginless is-centered is-mobile">
      <div class="column is-11">

        <div class="columns is-mobile">
            <div class="column">
            <h1 class="title is-3">Director: {{$director->name}}</h1>
            </div>
        </div>
        <hr class="is-marginless">

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <a href="{{route('directors.index')}}" class="button">Regresar</a>
                    <a href="{{route('director.edit', $director->directorId)}}" class="button is-info">Editar director</a>
                    <form id="delete-form" action="{{ route('director.destroy', $director) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button id="button-delete" type="button" class="button is-danger">Eliminar director</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table is-bordered is-striped is-hoverable is-fullwidth">
            <tbody>
                <tr>
                    <td rowspan="6" width="250px" height="250px"> 
                    @if (!empty($image))
                    <figure class="image" >
                        <img src="{{$image}}" style="object-fit: contain;width: 250px;height: 250px;" alt="{{$director->name}}">
                    </figure>
                    @endif
                    </td>
                    <th>
                        Nombre del Director
                    </th>
                    <th>
                        Fecha de nacimiento
                    </th>
                    <th>
                        País de origen
                    </th>
                </tr>
                <tr>
                    <td>
                        {{$director->name}}
                    </td>
                    <td>
                        {{$director->birthdate}}
                    </td>
                    <td>
                        {{$director->country}}
                    </td>
                </tr>
                <tr>
                    <th colspan="3">
                        Biografía
                    </th>
                </tr>
                <tr>
                    <td rowspan="3" colspan="3">
                        {{$director->Biography}}
                    </td>
                </tr>

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
