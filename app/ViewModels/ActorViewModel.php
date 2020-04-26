<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'birthday'      => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age'           => Carbon::parse($this->actor['birthday'])->age,
            'profile_path'  => $this->actor['profile_path']?
                    'https://image.tmdb.org/t/p/w500'.$this->actor['profile_path'] : asset('assets/images/Films/casts/anonyme.jpeg'),

        ]);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id']? 'https://twitter.com/'.$this->social['twitter_id'] : null,
            'instagram' => $this->social['instagram_id']? 'https://www.instagram.com/'.$this->social['instagram_id'] : null,
            'facebook' => $this->social['facebook_id']? 'https://www.facebook.com/'.$this->social['facebook_id'] : null,
        ]);
    }

    public function KnownFor()
    {
        $cast = collect($this->credits)->get('cast');

        return collect($cast)->sortByDesc('popularity')
                ->take(5)->map(function($known){
                    if(isset($known['original_title'])){
                        $title = $known['original_title'];
                    }elseif(isset($known['name'])){
                        $title = $known['name'];
                    }else{
                        $title = 'Untitled';
                    }

                    return collect($known)->merge([
                        'poster_path'   => $known['poster_path']?
                                        'https://image.tmdb.org/t/p/w500'.$known['poster_path'] : asset('assets/images/Films/casts/anonyme.jpeg'),
                        'title'         => $title,
                        'linkToPage'    => $known['media_type'] === 'movie' ?
                                            route('movies.show', $known['id']):  route('tv.show', $known['id'])
                    ]);
                });
    }

    public function Credits()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function($movie){
            if(isset($movie['release_date'])){
                $release_date = $movie['release_date'];
            }elseif(isset($movie['first_air_date'])){
                $release_date = $movie['first_air_date'];
            }else{
                $release_date = '';
            }

            if(isset($movie['original_title'])){
                $title = $movie['original_title'];
            }elseif(isset($movie['name'])){
                $title = $movie['name'];
            }else{
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_year'  => isset($release_date)? Carbon::parse($release_date)->format('Y'): 'Future',
                'title'         => $title,
                'character'     => isset($movie['character'])? $movie['character']: '',

            ]);
        })->sortByDesc('release_year');
    }

}
