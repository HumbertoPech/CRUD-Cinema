<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmDirector extends Model
{
    protected $primaryKey = 'directorId';
    protected $guarded = ['directorId'];

    public function search($filters) {
        $directors = $this->newQuery();
        $toFlash = array();

        if(isset($filters['name'])) {
            if(!empty($filters['name'])) {
                $directors->where('name', 'like', "%{$filters['name']}%");
                $toFlash[] = 'name';
            }
        }
        if(isset($filters['country'])) {
            if(!empty($filters['country'])) {
                $directors->where('country', 'like', "%{$filters['country']}%");
                $toFlash[] = 'country';
            }
        }
        if(isset($filters['date1']) && isset($filters['date2'])) {
            if (!empty($filters['date1']) && !empty($filters['date2'])) {
                $toFlash[] = 'date1';
                $toFlash[] = 'date2';
                $toFlash[] = 'date';
                $directors->whereDate('birthdate', '>=' , $filters['date1'])
                ->whereDate('birthdate', '<=' ,$filters['date2']);
              }
        }
        if(isset($filters['movies'])) {
            if(!empty($filters['movies'])) {
                $directors->whereHas('movies', function($q) use($filters) {
                    return $q->whereIn('movies.movieId', $filters['movies']);
                });
                $toFlash[] = 'movies';
            }
        }
        return array('query' => $directors, 'toFlash' => $toFlash);
    }

    public function movies() {
        return $this->belongsToMany('App\Models\Movie', 'movie_directors', 'directorId', 'movieId');
    }
}
