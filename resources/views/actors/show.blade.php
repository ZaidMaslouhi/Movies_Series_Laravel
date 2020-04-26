@extends('layouts.main')

@section('content')

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $actor['profile_path'] }}"
                     alt="profile image" class="w-96 mx-auto">
                     {{-- Social Media --}}
                <ul class="flex items-center mt-5">
                    @if ($social['facebook'])
                        <li>
                            <a href="{{ $social['facebook'] }}" title="facebook">
                                <img src="{{ asset('assets/images/facebook.svg') }}" class="w-6">
                            </a>
                        </li>
                    @endif
                    @if ($social['instagram'])
                        <li class="ml-6"><a href="{{ $social['instagram'] }}" title="instagram">
                                <img src="{{ asset('assets/images/instagram.svg') }}" class="w-6">
                            </a>
                        </li>
                    @endif
                    @if ($social['twitter'])
                        <li class="ml-6"><a href="{{ $social['twitter'] }}" title="twitter">
                                <img src="{{ asset('assets/images/twitter.svg') }}" class="w-6">
                            </a>
                        </li>
                    @endif
                    @if ($actor['homepage'])
                        <li class="ml-6"><a href="{{ $actor['homepage'] }}" title="website">
                                <img src="{{ asset('assets/images/website.svg') }}" class="w-6">
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="md:ml-24 mt-10 md:mt-0 w-3/4 mx-auto">
                <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <span><img src="{{ asset('assets/images/birthday.svg') }}" alt="birthday" class="fill-current w-4"></span>
                    <span class="ml-2 mt-1">{{ $actor['birthday'] .' ('.$actor['age'].' years old) in '. $actor['place_of_birth'] }}</span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $actor['biography'] }}
                </p>

                <h4 class="font-semibold mt-12">Known for</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    {{-- known for --}}
                    @foreach($KnownFor as $known)
                        <div class="mt-4">
                            <a href="{{ $known['linkToPage'] }}">
                                <img src="{{ $known['poster_path'] }}"
                                alt="Poster" class="w-96 hover:opacity-75 transition ease-in duration-200">
                            </a>
                            <a href="{{ $known['linkToPage'] }}" class="text-sm text-center leading-normal block text-gray-400 hover:text-white mt-1">
                                {{ $known['title'] }}
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div class="credits border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Credits</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach ($Credits as $credit)
                    <li>{{ $credit['release_year'] }} &middot; <span class="font-bold">{{ $credit['title'] }}</span> {{ $credit['character'] }}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
