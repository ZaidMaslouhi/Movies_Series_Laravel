    <div class="mt-8 mx-auto">
        <a href="{{ route('movies.show', $movie['id']) }}">
            <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['original_title'] }}" class="hover:opacity-75 transition ease-in duration-200">
        </a>
        <div class="mt-2">
            <a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $movie['original_title'] }}</a>
            <div class="flex items-center text-gray-400 text-sm mt-1">
                <span><img src="{{ asset('assets/images/star.svg') }}" alt="star" class="fill-current w-4"></span>
                <span class="ml-2">{{ $movie['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $movie['release_date'] }}</span>
            </div>
            <div class="text-gray-400 text-sm">
                {{ $movie['genres'] }}
            <div>
                </div>
            </div>
        </div>
    </div>

