<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularShows, $topRatedShows, $genres;

    public function __construct($popularShows, $topRatedShows, $genres)
    {
        $this->popularShows = $popularShows;
        $this->topRatedShows = $topRatedShows;
        $this->genres = $genres;
    }

    private function formatTv($shows)
    {
        return collect($shows)->map(function($tvShow){
            $genresFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvShow)->merge([
                'poster_path'   => 'https://image.tmdb.org/t/p/w342' . $tvShow['poster_path'],
                'vote_average'  => $tvShow['vote_average'] * 10 . ' %',
                'first_air_date'=> Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'name'          => ($tvShow['original_name'] == $tvShow['name'])?
                                    $tvShow['name']: $tvShow['name']."
                                    (".$tvShow['original_name'].")",
                'genres' => $genresFormatted
            ])->only([
                'id', 'name', 'poster_path', 'vote_average', 'first_air_date', 'genres'
            ]);
        });
    }

    public function popularShows()
    {
        return $this->formatTv($this->popularShows);
    }

    public function topRatedShows()
    {
        return $this->formatTv($this->topRatedShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
}
