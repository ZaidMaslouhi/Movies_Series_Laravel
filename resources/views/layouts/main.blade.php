<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Movie App</title>
        <link rel="stylesheet"  href="{{ url('css/main.css') }}" type="text/css">
        <livewire:styles>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </head>
<body class="font-sans bg-gray-900 text-white">

    <nav class="border-b border-gray-800">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex items-center flex-col md:flex-row">
                <li class=" mb-3 md:mb-0">
                    <a href="{{ route('movies.index') }}">
                        <img src="{{ asset('assets/images/planet.svg') }}" class="w-12 inline" alt="">
                        <h1 class="inline text-2xl ml-2">Movie <span class="font-bold ">App</span></h1>
                    </a>
                </li>
                <li class="md:ml-16 mb-3 md:mb-0">
                    <a href="{{ route('movies.index') }}" class="hover:text-gray-300">Movies</a>
                </li>
                <li class="md:ml-10 mb-3 md:mb-0">
                    <a href="{{ route('tv.index') }}" class="hover:text-gray-300">TV Shows</a>
                </li>
                <li class="md:ml-10 mb-3 md:mb-0">
                    <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
                </li>
            </ul>
            <div class="flex items-center flex-col md:flex-row">

                <livewire:search-dropdown />

                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="/">
                    <img src="{{ asset('assets/images/avatar.svg') }}" class="rounded-full w-10 h-10"></a>
                </div>
            </div>
        </div>
    </nav>


    @yield('content')

    <div class="movie-footer border-t border-gray-800 mt-8">
        <div class="container mx-auto px-4 py-5">
            <p class="text-gray-300 font-semibold text-center">&copy; Copyrights <?php echo date('Y'); ?></p>
        </div>
    </div>

    <livewire:scripts>
    @yield('scripts')

</body>
</html>
