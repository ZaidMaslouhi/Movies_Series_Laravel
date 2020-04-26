<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularShows = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/tv/popular?api_key=1f7ecdf95afcb5385376fd205e988112')
                        ->json()['results'];

        $topRatedShows = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/tv/top_rated?api_key=1f7ecdf95afcb5385376fd205e988112')
                        ->json()['results'];

        $genres = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=1f7ecdf95afcb5385376fd205e988112')
                        ->json()['genres'];

        $viewModel = new TvViewModel(
            $popularShows,
            $topRatedShows,
            $genres
        );

        return view('tv.index', $viewModel);
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
        $detailsTvShow = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/tv/'.$id.
                            '?api_key=1f7ecdf95afcb5385376fd205e988112&append_to_response=credits,videos,images')
                        ->json();

        $viewModel = new TvShowViewModel($detailsTvShow);

        return view('tv.show', $viewModel);
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
