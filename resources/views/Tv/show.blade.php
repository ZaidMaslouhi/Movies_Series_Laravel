@extends('layouts.main')

@section('content')

    <div class="tvShow-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ $tvShow['poster_path'] }}" alt="{{ $tvShow['name'] }}" class="w-96 mx-auto">
            <div class="md:ml-24 mt-10 md:mt-0 w-3/4 mx-auto">
                <h2 class="text-4xl font-semibold">{{ $tvShow['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <span><img src="{{ asset('assets/images/star.svg') }}" alt="star" class="fill-current w-4"></span>
                    <span class="ml-2">{{ $tvShow['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tvShow['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tvShow['genres'] }}</span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $tvShow['overview'] }}
                </p>

                {{-- Creator & Crew --}}
                <div class="mt-12">
                    <div class="text-white font-semibold">Featured Cast</div>
                    <div class="flex mt-4">
                        @foreach ($tvShow['created_by'] as $created)
                            <div class="mr-8">
                                <div>{{ $created['name'] }}</div>
                                <div class="text-sm text-gray-400">
                                    Creator
                                </div>
                            </div>
                        @endforeach
                        @foreach ($tvShow['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">
                                    {{ $crew['job'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Video Trailer --}}
                <div x-data="{ isOpen: false }">
                    @if (count($tvShow['videos']['results']) > 0)
                        <div class="mt-12">
                            <button @click="isOpen = true" class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-4 py-4 hover:bg-orange-600 transition ease-in-out duration-1500">
                                <img src="{{ asset('assets/images/play.svg') }}" class="w-6 fill-current">
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                        {{-- Video Modal --}}
                        <div x-show.transition.opacity="isOpen" @keydown.escape.window="isOpen = false"
                            class="absolute top-0 left-0 right-0 bottom-0 mx-auto w-2/3 h-2/3 flex items-center shadow-2xl" style="background: rgba(0, 0, 0, 0.1)">
                            <div class="container mx-auto lg:mx-32 mt-10 rounded-lg overflow-y-auto">
                                <div @click.away="isOpen = false" class="bg-gray-800 rounded pb-3 mt-10">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button @click="isOpen = false" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                    src="https://www.youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}" width="560" height="315"
                                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="tvshow-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($tvShow['cast'] as $cast)
                    <div class="mt-8 mx-auto">
                        <a href="{{ route('actors.show', $cast['id']) }}">
                            @if ($cast['profile_path'] != '')
                                <img src="{{ 'https://image.tmdb.org/t/p/w342'.$cast['profile_path'] }}" alt="{{ $cast['name'] }}" class="w-96">
                            @else
                                <img src="{{ asset('assets/images/Films/casts/anonyme.jpeg') }}" alt="{{ $cast['name'] }}" class="w-96">
                            @endif
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="tvshow-images border-gray-800 relative" x-data="{ isOpen: false, image: '' }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach ($tvShow['images'] as $image)
                    <div class="mt-8 mx-auto">
                        <a href="#" @click.prevent="
                                                isOpen = true,
                                                image = '{{ 'https://image.tmdb.org/t/p/original'.$image['file_path'] }}'
                                                ">
                            <img src="{{ 'https://image.tmdb.org/t/p/w342'.$image['file_path'] }}" alt="{{ $tvShow['name'] }}" class="w-96">
                        </a>
                    </div>
                @endforeach
            </div>
            {{-- Image Modal --}}
            <div x-show.transition.opacity="isOpen" @keydown.escape.window="isOpen = false"
                class="absolute top-0 left-0 right-0 bottom-0 mx-auto w-2/3 h-2/3 flex items-center shadow-2xl" style="background: rgba(0, 0, 0, 0.1)">
                <div class="container mx-auto lg:mx-32 mt-10 rounded-lg overflow-y-auto">
                    <div @click.away="isOpen = false" class="bg-gray-800 rounded pb-3 mt-10">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                <img class="absolute top-0 left-0 w-full h-full" :src="image" alt="Poster">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
