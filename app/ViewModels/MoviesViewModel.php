<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies, $playingNow, $genres;

    public function __construct($popularMovies, $playingNow, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->playingNow = $playingNow;
        $this->genres = $genres;
    }

    private function formatMovies($movies)
    {
        return collect($movies)->map(function($movie){
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w342' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . ' %',
                'release_date'=> Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ])->only([
                'id', 'original_title', 'poster_path', 'vote_average', 'release_date', 'genres'
            ]);
        });
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function playingNow()
    {
        return $this->formatMovies($this->playingNow);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
    
}
