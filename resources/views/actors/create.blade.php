@extends('layouts.app')
@section('title', 'Crear actor')
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

<div class="container is-fluid is-marginless  is-main">
  <div class="columns is-marginless is-centered is-mobile">
    <div class="column is-11">
      <div class="columns is-mobile">
        <div class="column">
          <h1 class="title is-3">Crear actor</h1>
        </div>
      </div>
      <hr class="is-marginless">
      <form class="createForm" action="{{route('actor.store')}}" method="post" enctype="multipart/form-data">
        @include('actors.form')
        <div class="field">
          <div class="control">
            <a href="{{ route('actors.index') }}" class="button is-light">Cancelar</a>
            <button type="submit" class="submitButton button is-success">Crear actor</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection