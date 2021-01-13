<?php

namespace App\Http\Livewire\Pages\Movies;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{   
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    // constructor of livewire component class
    public function mount()
    {   
        // User Api token is passed from a config\services file
        $this->popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results']; // get results array (from paginated data)

        $this->nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

        $this->genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $this->popularMovies = $this->formatMovies($this->popularMovies);
        $this->nowPlayingMovies = $this->formatMovies($this->nowPlayingMovies);
        $this->genresList = $this->genres; // unformatted genres array
        $this->genres = $this->genres();
        //  dd($this->popularMovies, $this->nowPlayingMovies, $this->genres);
    }

    private function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            // create key=>val pair collection of genreId=>genreName
            return [$genre['id'] => $genre['name']];
        });
    }

    // Use helper to convert the arrays into a collection instance(laravel wrapper for working with arrays of data) , then map over collection

    private function formatMovies($movies)
    {   
        return collect($movies)->map(function($movie) {
            /* Display ',' after each genre, excl. last  
            For testing purposes : to eliminate white space put everything in one line */
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            // formatt items and merge into a collection / ->only - Get only the selected items([] of key names) , use except for oposite effect

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] 
                    ? 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] 
                    : '/images/placeholder750x500.png',
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('d M, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
            
        });
    }

    public function render()
    {
        return view('livewire.pages.movies.index', ['popularMovies'=>$this->popularMovies, 'nowPlayingMovies'=>$this->nowPlayingMovies, 'genresList'=>$this->genresList]);
    }
}
