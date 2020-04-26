<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{

    public $actors;
    public $page;

    public function __construct($actors, $page)
    {
        $this->actors = $actors;
        $this->page = $page;
    }

    public function actors()
    {
        return collect($this->actors)->map(function($actor){
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']?
                    'https://image.tmdb.org/t/p/w500'.$actor['profile_path'] : asset('assets/images/Films/casts/anonyme.jpeg'),
                'known_for' => collect($actor['known_for'])->where('media_type','movie')->pluck('original_title')
                            ->union(collect($actor['known_for'])->where('media_type','tv')->pluck('original_name'))
                            ->implode(', '),

                ])->only([
                'id', 'name', 'profile_path', 'known_for'
            ]);
        });
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
