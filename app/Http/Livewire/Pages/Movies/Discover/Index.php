<?php

namespace App\Http\Livewire\Pages\Movies\Discover;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{   
    public $page;
    public $keywordId;
    public $keywordName;
    public $movies;

    public function mount($keywordId, $keywordName, $page=1)
    {   
        $this->keywordId = $keywordId;
        $this->keywordName = $keywordName;
        $this->page = $page;

        abort_if($page > 500, 204);

        if (str_starts_with($this->keywordName, 'keyword')) {
            $this->movies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/discover/movie?with_keywords='.$this->keywordId.'&page='.$this->page)
            ->json();  
        } else {
            $this->movies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/discover/movie?with_genres='.$this->keywordId.'&page='.$this->page)
            ->json();       
        }
        
        $currentPage = $this->movies['page'];
        $totalPages = $this->movies['total_pages'];
        
        $this->genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        // dump($this->movies,$this->genres);
        $this->movies = $this->formatMovies($this->movies['results']);
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
    
    private function formatMovies($movies)
    {   
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] 
                    ? 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']
                    : '/images/placeholder750x500.png',
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => (isSet($movie['release_date'])) ? Carbon::parse($movie['release_date'])->format('M d, Y') : null,               
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);   
        });
    }

    public function render()
    {
        return view('livewire.pages.movies.discover.index', ['movies'=>$this->movies, 'genresList'=>$this->genresList, 'keywordId'=>$this->keywordId, 'keywordName'=>$this->keywordName, 'page'=>$this->page]);
    }
}
