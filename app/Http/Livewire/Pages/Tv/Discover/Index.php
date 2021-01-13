<?php

namespace App\Http\Livewire\Pages\Tv\Discover;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{   
    public $page;
    public $keywordId;
    public $keywordName;
    public $tvshows;

    public function mount($keywordId, $keywordName, $page=1)
    {   
        $this->keywordId = $keywordId;
        $this->keywordName = $keywordName;
        $this->page = $page;

        abort_if($page > 500, 204);

        if (str_starts_with($this->keywordName, 'keyword')) {
            $this->tvshows = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/discover/tv?with_keywords='.$this->keywordId.'&page='.$this->page)
                ->json();
        } else {
            $this->tvshows = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/discover/tv?with_genres='.$this->keywordId.'&page='.$this->page)
            ->json();
        }

        $currentPage = $this->tvshows['page'];
        $totalPages = $this->tvshows['total_pages'];

        $this->genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        // dump($this->tvshows,$this->genres);

        $this->tvshows = $this->formatTv($this->tvshows['results']);
        $this->genresList = $this->genres; // unformatted genres array
        $this->genres = $this->genres();
        
        // Check for the end of content & stop the infnite-scroll
        abort_if($currentPage > $totalPages, 204);
    }

    private function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv)
    {   
        return collect($tv)->map(function($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => $tvshow['poster_path'] 
                    ? 'https://image.tmdb.org/t/p/w500/'.$tvshow['poster_path']
                    : '/images/placeholder750x500.png',
                'vote_average' => $tvshow['vote_average'] * 10 .'%',
                'first_air_date' => (isSet($tvshow['first_air_date'])) ? Carbon::parse($tvshow['first_air_date'])->format('M d, Y') : null,
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }

    public function render()
    {
        return view('livewire.pages.tv.discover.index',['tvshows'=>$this->tvshows, 'genresList'=>$this->genresList, 'keywordId'=>$this->keywordId,'keywordName'=>$this->keywordName, 'page'=>$this->page]);
    }
}
