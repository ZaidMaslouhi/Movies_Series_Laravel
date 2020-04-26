@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 py-16">

        {{-- Popular Actors --}}
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">
                Popular Actors
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($actors as $act)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show', $act['id']) }}">
                            <img src="{{ $act['profile_path'] }}" alt="{{ $act['name'] }}"
                                class="hover:opacity-75 transiton ease-out duration-200">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $act['id']) }}"
                                class="text-lg hover:text-gray-300">{{ $act['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">
                                {{ $act['known_for'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="{{ url('actors/page/'.$previous) }}">Previous</a>
            @else
                <div></div>
            @endif
            @if ($next)
                <a href="{{ url('actors/page/'.$next) }}">Next</a>
            @else
                <div></div>
            @endif
        </div> --}}

        <div class="page-load-status mt-10">
            <div class="flex justify-center">
                <p class="infinite-scroll-request spinner my-8 text-4xl"></p>
                <p class="infinite-scroll-last text-4xl">End of content ..</p>
                <p class="infinite-scroll-error text-4xl">No more pages to load</p>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>

    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status'
        });
    </script>

@endsection
