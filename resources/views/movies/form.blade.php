@csrf
<h2 class="subtitle">Datos</h2>
<div class="columns is-centered is-multiline">

  <div class="column is-5">
    <div class="field">
      <label class="label">Nombre <span class="has-text-danger">*</span></label>
      <div class="control">
        <input class="input" type="text" name="movieName" value="{{ old('movieName') ?? $movie->name }}" required autofocus>
      </div>
      @if ($errors->has('movieName'))
      <p class="help is-danger">
        {{ $errors->first('movieName') }}
      </p>
      @endif
    </div>
  </div>
  <div class="column is-3">
    <div class="field">
      <label class="label">Fecha de lanzamiento</label>
      <div class="control">
        <input class="input fecha" type="text" id='release' data-input name="release" value="{{ old('release') ?? $movie->release }}" autofocus>
      </div>
      @if ($errors->has('country'))
      <p class="help is-danger">
        {{ $errors->first('country') }}
      </p>
      @endif
    </div>
  </div>
  <div class="column is-3">
    <div class="field">
      <label class="label">País</label>
      <div class="control">
        <input class="input" type="text" name="country" value="{{ old('country') ?? $movie->country }}" autofocus>
      </div>
      @if ($errors->has('country'))
      <p class="help is-danger">
        {{ $errors->first('country') }}
      </p>
      @endif
    </div>
  </div>
  <div class="column is-4">
    <div class="field">
        <label class="label">Actuan</label>
        <div class="control">
            <div class="is-fullwidth">
                @php
                    $hasActors = [];
                    if( !empty($movie->actors) ) {
                        $hasActors = $movie->actors->pluck('actorId')->toArray();
                    }
                @endphp
                <select id='actorsMovies' name="actors[]" multiple>
                @foreach ($actors as $actor)
                    <option value="{{$actor->actorId}}" @if (in_array($actor->actorId, $hasActors)) selected @endif>{{$actor->name}}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
  </div>
  <div class="column is-4">
    <div class="field">
        <label class="label">Dirigen</label>
        <div class="control">
            <div class="is-fullwidth">
                @php
                    $hasDirectors = [];
                    if( !empty($movie->directors) ) {
                        $hasDirectors = $movie->directors->pluck('directorId')->toArray();
                    }
                @endphp
                <select id='directorsMovies' name="directors[]" multiple>
                @foreach ($directors as $director)
                    <option value="{{$director->directorId}}" @if (in_array($director->directorId, $hasDirectors)) selected @endif>{{$director->name}}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
  </div>
  <div class="column is-3">
    <div class="field">
      <label class="label">Duración</label>
      <div class="control">
        <input class="input" type="text" id='duration' name="duration" value="{{ old('duration') ?? $movie->duration }}" autofocus>
      </div>
      @if ($errors->has('duration'))
      <p class="help is-danger">
        {{ $errors->first('duration') }}
      </p>
      @endif
    </div>
  </div>
  <div class="column is-11">
    <div class="field">
      <label class="label">Sinopsis</label>
      <div class="control">
        <textarea class="textarea" rows="3" name="synopsis" autofocus>{{ old('synopsis') ?? $movie->synopsis }}</textarea>
      </div>
      @if ($errors->has('synopsis'))
      <p class="help is-danger">
        {{ $errors->first('synopsis') }}
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
      <label class="label">Imagen de portada</label>
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
