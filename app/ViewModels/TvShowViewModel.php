<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvShow;

    public function __construct($tvShow)
    {
        $this->tvShow = $tvShow;
    }

    public function tvShow()
    {
        return collect($this->tvShow)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w342' . $this->tvShow['poster_path'],
            'vote_average' => $this->tvShow['vote_average'] * 10 . ' %',
            'first_air_date'=> Carbon::parse($this->tvShow['first_air_date'])->format('M d, Y'),
            'name'          => ($this->tvShow['original_name'] == $this->tvShow['name'])?
                                $this->tvShow['name']: $this->tvShow['name']." (".$this->tvShow['original_name'].")",
            'genres' => collect($this->tvShow['genres'])->pluck('name')->implode(', '),
            'crew' => collect($this->tvShow['credits']['crew'])->take(2),
            'cast' => collect($this->tvShow['credits']['cast'])->take(5),
            'images' => collect($this->tvShow['images']['backdrops'])->take(9),
        ])->only([
            'id', 'name', 'overview', 'poster_path', 'genres', 'vote_average',
            'first_air_date', 'genres', 'crew', 'cast', 'videos', 'images', 'created_by'
        ]);
    }
}
