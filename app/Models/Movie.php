<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $primaryKey = 'movieId';
    protected $guarded = ['movieId'];

    public function search($filters) {
        $movies = $this->newQuery();
        $toFlash = array();

        if(isset($filters['name'])) {
            if(!empty($filters['name'])) {
                $movies->where('name', 'like', "%{$filters['name']}%");
                $toFlash[] = 'name';
            }
        }
        if(isset($filters['country'])) {
            if(!empty($filters['country'])) {
                $movies->where('country', 'like', "%{$filters['country']}%");
                $toFlash[] = 'country';
            }
        }
        if(isset($filters['date1']) && isset($filters['date2'])) {
            if (!empty($filters['date1']) && !empty($filters['date2'])) {
                $toFlash[] = 'date1';
                $toFlash[] = 'date2';
                $toFlash[] = 'date';
                $movies->whereDate('release', '>=' , $filters['date1'])
                ->whereDate('release', '<=' ,$filters['date2']);
              }
        }
        if(isset($filters['duration'])) {
            if(!empty($filters['duration'])) {
                $movies->where('duration', '<=', $filters['duration']);
                $toFlash[] = 'duration';
            }
        }
        if(isset($filters['actorName'])) {
            if(!empty($filters['actorName'])) {
                $movies->whereHas('actors', function($q) use($filters) {
                    return $q->where('actors.name', 'like', "%{$filters['actorName']}%");
                });
                $toFlash[] = 'actorName';
            }
        }
        if(isset($filters['directorName'])) {
            if(!empty($filters['directorName'])) {
                $movies->whereHas('directors', function($q) use($filters) {
                    return $q->where('film_directors.name', 'like', "%{$filters['directorName']}%");
                });
                $toFlash[] = 'directorName';
            }
        }

        return array('query' => $movies, 'toFlash' => $toFlash);
    }

    public function actors() {
        return $this->belongsToMany('App\Models\Actor', 'movie_actors', 'movieId', 'actorId');
    }

    public function directors() {
        return $this->belongsToMany('App\Models\FilmDirector', 'movie_directors', 'movieId', 'directorId');
    }
}
