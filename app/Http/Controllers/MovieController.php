<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Actor;
use App\Models\FilmDirector;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public $movie;
    public $pagesize = 25;


    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movie = new Movie();
        if ($request->has('pagesize')) {
            $this->pagesize = $request->input('pagesize');
        }
        $data = $movie->search($request->input());
        $movies = $data['query']->paginate($this->pagesize);
        $request->flashOnly($data['toFlash']);
        return view('movies.index', [
            'movies' => $movies->appends($request->except('page'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie = new Movie();
        return view('movies.create', [
            'movie' => $movie,
            'actors' => Actor::all(),
            'directors' => FilmDirector::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $movie = new Movie();
        $data = $request->validated();
        $movie = $movie->create([
            'name' => $data['movieName'],
            'synopsis' => $data['synopsis'],
            'country' => $data['country'],
            'release' => $data['release'],
            'duration' => $data['duration'],
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        if(!empty($data['imageRoute'])) {
            $file = $data['imageRoute'];
            $extension = $file->getClientOriginalExtension();
            $filename  = 'portada.' . $extension;
            $movie->imageRoute = $filename;
            $file->storeAs('movies/'.$movie->movieId, $filename, 'public');
            $movie->save();
        }

        if(!empty($data['actors'])) {
            $movie->actors()->sync($data['actors']);
        }

        if(!empty($data['directors'])) {
            $movie->directors()->sync($data['directors']);
        }

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        $path = 'movies/default.png';
        if(!empty($movie->imageRoute)) {
            $path = 'movies/'.$movie->movieId.'/'.$movie->imageRoute;
        }
        $src = "";
        if(Storage::disk('public')->exists($path)) {
            $contents = Storage::disk('public')->get($path);
            $contents = base64_encode($contents);
            $src = 'data: '.mime_content_type('../storage/app/public/'.$path).';base64,'.$contents;
        }
        return view('movies.show', [
            'movie' => $movie,
            'image' => $src
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $path = 'movies/default.png';
        if(!empty($movie->imageRoute)) {
            $path = 'movies/'.$movie->movieId.'/'.$movie->imageRoute;
        }
        $src = "";
        if(Storage::disk('public')->exists($path)) {
            $contents = Storage::disk('public')->get($path);
            $contents = base64_encode($contents);
            $src = 'data: '.mime_content_type('../storage/app/public/'.$path).';base64,'.$contents;
        }
        return view('movies.edit', [
            'movie' => $movie,
            'image' => $src,
            'actors' => Actor::all(),
            'directors' => FilmDirector::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $data = $request->validated();
        $movie->update([
            'name' => $data['movieName'],
            'synopsis' => $data['synopsis'],
            'country' => $data['country'],
            'release' => $data['release'],
            'duration' => $data['duration'],
            'updated_at' => date('Y-m-d')
        ]);

        if(!empty($data['imageRoute'])) {
            $file = $data['imageRoute'];
            $extension = $file->getClientOriginalExtension();
            $filename  = 'portada.' . $extension;
            $movie->imageRoute = $filename;
            $file->storeAs('movies/'.$movie->movieId, $filename, 'public');
            $movie->save();
        }

        if(!empty($data['actors'])) {
            $movie->actors()->sync($data['actors']);
        } else {
            $movie->actors()->sync([]);
        }

        if(!empty($data['directors'])) {
            $movie->directors()->sync($data['directors']);
        } else {
            $movie->directors()->sync([]);
        }

        request()->flashOnly(['back_to']);

        return redirect()->route('movie.edit', [
            'movie' => $movie
        ])->withInput()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }
}
