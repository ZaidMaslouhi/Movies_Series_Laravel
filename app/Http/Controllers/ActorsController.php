<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204); // HTTP Status 204 (No Content)

        $actors = Http::withToken(config('services.tmbd.token'))
                    ->get('https://api.themoviedb.org/3/person/popular?page='.$page.'&api_key=1f7ecdf95afcb5385376fd205e988112')
                    ->json()['results'];

        $viewModel = new ActorsViewModel($actors, $page);
        return view('actors.index', $viewModel);
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
        $detailsActor = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.
                            '?api_key=1f7ecdf95afcb5385376fd205e988112')
                        ->json();

        $social = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.
                            '/external_ids?api_key=1f7ecdf95afcb5385376fd205e988112')
                        ->json();

        $credits = Http::withToken(config('services.tmbd.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.
                            '/combined_credits?api_key=1f7ecdf95afcb5385376fd205e988112')
                        ->json();

        $viewModel = new ActorViewModel($detailsActor, $social, $credits);

        return view('actors.show', $viewModel);
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
