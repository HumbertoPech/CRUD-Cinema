<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    public $actor;
    public $pagesize = 25;

    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
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
        $data = $this->actor->search($request->input());
        $actors = $data['query']->paginate($this->pagesize);
        $request->flashOnly($data['toFlash']);
        return view('actors.index', [
            'actors' => $actors->appends($request->except('page')),
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
        $actor = new Actor();
        return view('actors.create', [
            'actor' => $actor
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActorRequest $request)
    {
        $actor = new Actor();
        $data = $request->validated();
        $actor = $actor->create([
            'name' => $data['actorName'],
            'biography' => $data['biography'],
            'birthdate' => $data['birthdate'],
            'country' => $data['country'],
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        if(!empty($data['imageRoute'])) {
            $file = $data['imageRoute'];
            $extension = $file->getClientOriginalExtension();
            $filename  = 'fotoPerfil.' . $extension;
            $actor->routeImage = $filename;
            $file->storeAs('actors/'.$actor->actorId, $filename, 'public');
            $actor->save();
        }

        return redirect()->route('actors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        $path = 'actors/default.png';
        if(!empty($actor->routeImage)) {
            $path = 'actors/'.$actor->actorId.'/'.$actor->routeImage;
        }
        $src = "";
        if(Storage::disk('public')->exists($path)) {
            $contents = Storage::disk('public')->get($path);
            $contents = base64_encode($contents);
            $src = 'data: '.mime_content_type('../storage/app/public/'.$path).';base64,'.$contents;
        }
        return view('actors.show', [
            'actor' => $actor,
            'image' => $src
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        $path = 'actors/default.png';
        if(!empty($actor->routeImage)) {
            $path = 'actors/'.$actor->actorId.'/'.$actor->routeImage;
        }
        $src = "";
        if(Storage::disk('public')->exists($path)) {
            $contents = Storage::disk('public')->get($path);
            $contents = base64_encode($contents);
            $src = 'data: '.mime_content_type('../storage/app/public/'.$path).';base64,'.$contents;
        }
        return view('actors.edit', [
            'actor' => $actor,
            'image' => $src
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(ActorRequest $request, Actor $actor)
    {
        $data = $request->validated();
        $actor->update([
            'name' => $data['actorName'],
            'biography' => $data['biography'],
            'birthdate' => $data['birthdate'],
            'country' => $data['country'],
            'updated_at' => date('Y-m-d')
        ]);

        if(!empty($data['imageRoute'])) {
            $file = $data['imageRoute'];
            $extension = $file->getClientOriginalExtension();
            $filename  = 'fotoPerfil.' . $extension;
            $actor->routeImage = $filename;
            $file->storeAs('actors/'.$actor->actorId, $filename, 'public');
            $actor->save();
        }

        request()->flashOnly(['back_to']);

        return redirect()->route('actor.edit', [
            'actor' => $actor
        ])->withInput()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect()->route('actors.index');
    }
}
