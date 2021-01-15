@extends('layouts.app')

@section('title', 'Inicio')


@section('content')

<section class="hero is-info is-bold">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">
          <span class="icon is-medium">
            <i class="fas fa-home"></i>
          </span>
          Inicio
        </h1>
      </div>
    </div>
  </section>

<div class="container is-fluid is-marginless">
  <div class="columns is-marginless is-centered is-mobile">
    <div class="column is-four-fifths-desktop">
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <div class="tile is-child box notification is-light-grey">
            <p class="title">Catálogos</p>
            <div class="content">
              <ul>
                <li><a href="{!! route('movies.index') !!}">Películas</a></li>
                <li><a href="{!! route('actors.index') !!}">Actores</a></li>
                <li><a href="{!! route('directors.index') !!}">Directores</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection