

<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input autocomplete="off" type="text" name="search" id="search" class="bg-gray-800 rounded-full w-64 text-sm px-4 pl-8 py-1 outline-none focus:shadow-outline" placeholder="Search"
            wire:model.debounce.300ms="search" @focus="isOpen = true"  @click="isOpen = true"
            @keydown="isOpen = true" @keydown.escape.window="isOpen = false" @keydown.shift.tab="isOpen = false"
            x-ref="search" @keydown.window="if(event.keyCode === 191 || event.keyCode === 111){
                                        event.preventDefault();
                                        $refs.search.focus(); }">
    <div class="absolute top-0">
        <img src="{{ asset('assets/images/search.svg') }}" alt="" class="fill-current w-4 mt-2 ml-2">
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>
    @if (strlen($this->search) >= 2)
        <div class="absolute bg-gray-800 text-sm rounded w-64 mt-4 overflow-y-auto z-50" x-show.transition.opacity="isOpen" style="max-height: 50vh">
            @if (count($searchResults) > 0)
                <ul>
                    @foreach ($searchResults as $SR)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $SR['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                            @if ($SR['poster_path'] != '')
                                <img src="{{ 'https://image.tmdb.org/t/p/w92' . $SR['poster_path'] }}" alt="{{ $SR['title'] }}" class="w-8">
                            @else
                                <img src="{{ asset('assets/images/Films/casts/anonyme.jpeg') }}" alt="poster" class="w-8">
                            @endif
                            @if (isset($SR['release_date']) > 0)
                                <span class="px-3">{{$SR['title'].' ('.date('Y', strtotime($SR['release_date'])).')'}}</span>
                            @else
                               <span class="px-3">{{$SR['title']}}</span>
                            @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>

