<?php

namespace App\Http\Controllers;

use App\Models\FilmDirector;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\ActorRequest;
use App\Http\Requests\FilmDirectorRequest;
use App\Models\FilmDirector as ModelsFilmDirector;
use Illuminate\Support\Facades\Storage;

class FilmDirectorController extends Controller
{
    public $director;
    public $pagesize = 25;

    public function __construct(FilmDirector $director)
    {
        $this->director = $director;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('pagesize')) {
            $this->pagesize = $request->input('pagesize');
        }
        $data = $this->director->search($request->input());
        $directors = $data['query']->paginate($this->pagesize);
        $request->flashOnly($data['toFlash']);
        return view('directors.index', [
            'directors' => $directors->appends($request->except('page')),
            'movies' => Movie::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $director = new FilmDirector();
        return view('directors.create', [
            'director' => $director
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmDirectorRequest $request)
    {
        $director = new FilmDirector();
        $data = $request->validated();
        $director = $director->create([
            'name' => $data['directorName'],
            'Biography' => $data['biography'],
            'birthdate' => $data['birthdate'],
            'country' => $data['country'],
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        if(!empty($data['imageRoute'])) {
            $file = $data['imageRoute'];
            $extension = $file->getClientOriginalExtension();
            $filename  = 'fotoPerfil.' . $extension;
            $director->routeImage = $filename;
            $file->storeAs('directors/'.$director->directorId, $filename, 'public');
            $director->save();
        }

        return redirect()->route('directors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FilmDirector  $filmDirector
     * @return \Illuminate\Http\Response
     */
    public function show(FilmDirector $filmDirector)
    {
        $path = 'directors/default.png';
        if(!empty($filmDirector->routeImage)) {
            $path = 'directors/'.$filmDirector->directorId.'/'.$filmDirector->routeImage;
        }
        $src = "";
        if(Storage::disk('public')->exists($path)) {
            $contents = Storage::disk('public')->get($path);
            $contents = base64_encode($contents);
            $src = 'data: '.mime_content_type('../storage/app/public/'.$path).';base64,'.$contents;
        }
        return view('directors.show', [
            'director' => $filmDirector,
            'image' => $src
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FilmDirector  $filmDirector
     * @return \Illuminate\Http\Response
     */
    public function edit(FilmDirector $filmDirector)
    {
        $path = 'directors/default.png';
        if(!empty($filmDirector->routeImage)) {
            $path = 'directors/'.$filmDirector->directorId.'/'.$filmDirector->routeImage;
        }
        $src = "";
        if(Storage::disk('public')->exists($path)) {
            $contents = Storage::disk('public')->get($path);
            $contents = base64_encode($contents);
            $src = 'data: '.mime_content_type('../storage/app/public/'.$path).';base64,'.$contents;
        }
        return view('directors.edit', [
            'director' => $filmDirector,
            'image' => $src
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FilmDirector  $filmDirector
     * @return \Illuminate\Http\Response
     */
    public function update(FilmDirectorRequest $request, FilmDirector $filmDirector)
    {
        $data = $request->validated();
        $filmDirector->update([
            'name' => $data['actorName'],
            'Biography' => $data['biography'],
            'birthdate' => $data['birthdate'],
            'country' => $data['country'],
            'updated_at' => date('Y-m-d')
        ]);

        if(!empty($data['imageRoute'])) {
            $file = $data['imageRoute'];
            $extension = $file->getClientOriginalExtension();
            $filename  = 'fotoPerfil.' . $extension;
            $filmDirector->routeImage = $filename;
            $file->storeAs('directors/'.$filmDirector->directorId, $filename, 'public');
            $filmDirector->save();
        }

        request()->flashOnly(['back_to']);

        return redirect()->route('director.edit', [
            'director' => $filmDirector
        ])->withInput()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FilmDirector  $filmDirector
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilmDirector $filmDirector)
    {
        $filmDirector->delete();
        return redirect()->route('directors.index');
    }
}
