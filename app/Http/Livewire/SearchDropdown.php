<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];
        if(strlen($this->search) >= 2){
            $searchResults = Http::withToken(config('services.tmbd.token'))
                            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search.'&api_key=1f7ecdf95afcb5385376fd205e988112')
                            ->json()['results'];
        }
        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->sortByDesc('release_date')
        ]);
    }
}
