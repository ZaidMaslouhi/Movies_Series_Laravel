<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/movie/popular?api_key=1f7ecdf95afcb5385376fd205e988112')
                        ->json()['results'];

        $genres = Http::withToken(config('services.tmbd.token'))
                    ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=1f7ecdf95afcb5385376fd205e988112')
                    ->json()['genres'];
        // $genres = collect($genres)->mapWithKeys(function($genre){
        //     return [$genre['id'] => $genre['name']];
        // });

        $playingNow = Http::withToken(config('services.tmbd.token'))
                    ->get('https://api.themoviedb.org/3/movie/now_playing?api_key=1f7ecdf95afcb5385376fd205e988112')
                    ->json()['results'];

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $playingNow,
            $genres
        );

        return view('movies.index', $viewModel);

        // return view('index',[
        //     'popularMovies' => $popularMovies,
        //     'genres' => $genres,
        //     'playingNow' => $playingNow
        //     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailsMovie = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/movie/'.$id.
                            '?api_key=1f7ecdf95afcb5385376fd205e988112&append_to_response=credits,videos,images')
                        ->json();

        // dump($detailsMovie);
        $viewModel = new MovieViewModel($detailsMovie);

        return view('movies.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
