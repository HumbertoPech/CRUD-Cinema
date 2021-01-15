@extends('layouts.app')
@section('title', 'Editar director: ' . $director->name)
@section('extra-js')
    <script>
        const fileInput = document.querySelector('#file-js input[type=file]');
        fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
            const fileName = document.querySelector('#file-js .file-name');
            fileName.textContent = fileInput.files[0].name;
        }
        }

        flatpickr("#birthdate", {
            altInput: true,
            altFormat: "d/F/Y",
            dateFormat: "Y-m-d",
            locale: "es",
        });
        
        window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'){e.preventDefault();return false;}}},true);
    </script>
@endsection
@section('content')

  <div class="container is-fluid is-marginless is-main">
    <div class="columns is-marginless is-centered is-mobile">
      <div class="column is-11">

        <div class="columns is-mobile">
          <div class="column">
            <h1 class="title is-3">Editar director: {{$director->name}}</h1>
          </div>
        </div>
        <hr class="is-marginless">

        @if (session('success'))
          <div class="notification is-success">
            <button class="delete" type="button"></button>
            Los datos del director se han actualizado correctamente
          </div>
        @endif
        <form class="" action="{{route('director.update', $director)}}" method="post" enctype="multipart/form-data">
          @method('PATCH')
          @include('directors.form')
          <input type="hidden" name="back_to" value="{{ old('back_to') ?? url()->previous() }}">
          <div class="buttons">
            <a href="{{ old('back_to') ?? url()->previous() }}" class="button is-light">Cancelar</a>
            <button type="submit" class="button is-info">Guardar director</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection