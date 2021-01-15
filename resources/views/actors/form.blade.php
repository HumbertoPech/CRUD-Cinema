@csrf
<h2 class="subtitle">Datos</h2>
<div class="columns is-centered is-multiline">

  <div class="column is-5">
    <div class="field">
      <label class="label">Nombre <span class="has-text-danger">*</span></label>
      <div class="control">
        <input class="input" type="text" name="actorName" value="{{ old('actorName') ?? $actor->name }}" required autofocus>
      </div>
      @if ($errors->has('actorName'))
      <p class="help is-danger">
        {{ $errors->first('actorName') }}
      </p>
      @endif
    </div>
  </div>
  <div class="column is-3">
    <div class="field">
      <label class="label">Fecha de nacimiento</label>
      <div class="control">
        <input class="input fecha" type="text" id='birthdate' data-input name="birthdate" value="{{ old('birthdate') ?? $actor->birthdate }}" autofocus>
      </div>
      @if ($errors->has('birthdate'))
      <p class="help is-danger">
        {{ $errors->first('birthdate') }}
      </p>
      @endif
    </div>
  </div>
  <div class="column is-3">
    <div class="field">
      <label class="label">País</label>
      <div class="control">
        <input class="input" type="text" name="country" value="{{ old('country') ?? $actor->country }}" autofocus>
      </div>
      @if ($errors->has('country'))
      <p class="help is-danger">
        {{ $errors->first('country') }}
      </p>
      @endif
    </div>
  </div>
  <div class="column is-11">
    <div class="field">
      <label class="label">Biografía</label>
      <div class="control">
        <textarea class="textarea" rows="3" name="biography" autofocus>{{ old('biography') ?? $actor->biography }}</textarea>
      </div>
      @if ($errors->has('biography'))
      <p class="help is-danger">
        {{ $errors->first('biography') }}
      </p>
      @endif
    </div>
  </div>
</div>

<hr>

<h2 class="subtitle">Imagen</h2>
<div class="columns is-centered is-multiline">
  <div class="column is-11">
    <div class="field">
      <label class="label">Foto de perfil</label>
    </div>
    <div id="file-js" class="file has-name">
      <label class="file-label">
        <input class="file-input" type="file" id='imageRoute' name="imageRoute">
        <span class="file-cta">
          <span class="file-icon">
            <i class="fas fa-upload"></i>
          </span>
          <span class="file-label">
            Selecionar archivo…
          </span>
        </span>
        <span class="file-name">
          @if (!empty($movie->imageRoute))
            {{$movie->imageRoute}}
          @else
            Archivo no seleccionado
          @endif
        </span>
      </label>
    </div>
    @if ($errors->has('imageRoute'))
      <p class="help is-danger">
        {{ $errors->first('imageRoute') }}
      </p>
    @endif
  </div>

  <div class="column is-5">
    @if (!empty($image))
      <figure class="image">
        <img src="{{$image}}">
      </figure>
    @endif
  </div>
</div>
