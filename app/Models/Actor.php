<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $primaryKey = 'actorId';
    protected $guarded = ['actorId'];

    public function search($filters) {
        $actors = $this->newQuery();
        $toFlash = array();

        if(isset($filters['name'])) {
            if(!empty($filters['name'])) {
                $actors->where('name', 'like', "%{$filters['name']}%");
                $toFlash[] = 'name';
            }
        }
        if(isset($filters['country'])) {
            if(!empty($filters['country'])) {
                $actors->where('country', 'like', "%{$filters['country']}%");
                $toFlash[] = 'country';
            }
        }
        if(isset($filters['date1']) && isset($filters['date2'])) {
            if (!empty($filters['date1']) && !empty($filters['date2'])) {
                $toFlash[] = 'date1';
                $toFlash[] = 'date2';
                $toFlash[] = 'date';
                $actors->whereDate('birthdate', '>=' , $filters['date1'])
                ->whereDate('birthdate', '<=' ,$filters['date2']);
              }
        }
        if(isset($filters['movies'])) {
            if(!empty($filters['movies'])) {
                $actors->whereHas('movies', function($q) use($filters) {
                    return $q->whereIn('movies.movieId', $filters['movies']);
                });
                $toFlash[] = 'movies';
            }
        }
        return array('query' => $actors, 'toFlash' => $toFlash);
    }

    public function movies() {
        return $this->belongsToMany('App\Models\Movie', 'movie_actors', 'actorId', 'movieId');
    }
}
