@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">

        {{-- Popular tv --}}
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">
                Popular Shows
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($popularShows as $tvShow)

                    <x-tv-card :tvShow="$tvShow" />

                @endforeach
            </div>
        </div>

        {{-- Top Rated Shows --}}
        <div class="top-rated-shows py-24">
            <h1 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">
                Top Rated Shows
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($topRatedShows as $topShow)

                    <x-tv-card :tvShow="$topShow" />

                @endforeach
            </div>
        </div>
    </div>

@endsection
