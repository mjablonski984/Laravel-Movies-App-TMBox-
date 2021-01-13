<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Search extends Component
{   
    public $search = '';
    
    public function render()
    {   
        if (strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search//multi?query='.$this->search)
            ->json()['results'];

            // dump($searchResults);
            return view('livewire.components.search', [
                'searchResults' => collect($searchResults)->take(10),
            ]);
        }
        return view('livewire.components.search');
    }
}
