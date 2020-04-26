@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">

        {{-- Popular Movies --}}
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">
                Popular Movies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($popularMovies as $movie)

                    <x-movie-card :movie="$movie" />

                @endforeach
            </div>
        </div>

        {{-- Playing Now --}}
        <div class="now_playing_movies py-24">
            <h1 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">
                Playing Now
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($playingNow as $movie)

                    <x-movie-card :movie='$movie' />

                @endforeach
            </div>
        </div>
    </div>

@endsection
