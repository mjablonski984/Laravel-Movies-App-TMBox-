<?php

namespace App\Http\Livewire\Pages\Movies;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{   
    public $movie;
    public $movieId;
    public $similarMovies;
    public $genre;

    public function mount($movieId)
    {   
        // Attribute passed in mount constructor must have the same name as route param (movieId, actor etc.)
        $this->movieId = $movieId;

        /* The movie, TV show, TV season, TV episode and person detail methods support 
        a query parameter called append_to_response. 
        This makes it possible to make sub requests within the same namespace in a single HTTP request. 
        Each request will get appended to the response as a new JSON object.*/

        $this->movie = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$this->movieId.'?append_to_response=credits,videos,images,keywords,external_ids')
        ->json();

        $this->similarMovies= Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$this->movieId.'/similar')
        ->json()['results'];
        
        // genres used in similarMovies collection
        $this->genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];
        
        // dump($this->movie);
        $this->movie=$this->movie();

        $this->similarMovies = $this->formatMovies($this->similarMovies);
        $this->genres = $this->genres();
    }

    private function movie()
    {   
        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path'] 
                ? 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path']
                : '/images/placeholder750x500.png',
            'backdrop_path' => 'https://image.tmdb.org/t/p/original/'.$this->movie['backdrop_path'],
            'vote_average' => $this->movie['vote_average'] * 10 .'%',
            'release_date' => (isSet($this->movie['release_date'])) ? Carbon::parse($this->movie['release_date'])->format('M d, Y') : null,
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'production_countries' => collect($this->movie['production_countries'])->take(5)->pluck('name')->flatten()->implode(', '),
            'spoken_languages' => collect($this->movie['spoken_languages'])->take(10)->pluck('english_name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(10)->map(function($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                        : '/images/placeholder300x450.png',
                ]);
            }),
            'images' => collect($this->movie['images']['backdrops'])->take(9),
            'social' => collect($this->movie['external_ids'])->merge([
                'twitter' => $this->movie['external_ids']['twitter_id'] ? 'https://twitter.com/'.$this->movie['external_ids']['twitter_id'] : null,
                'facebook' => $this->movie['external_ids']['facebook_id'] ? 'https://facebook.com/'.$this->movie['external_ids']['facebook_id'] : null,
                'instagram' => $this->movie['external_ids']['instagram_id'] ? 'https://instagram.com/'.$this->movie['external_ids']['instagram_id'] : null,
            ])->only([
                'facebook', 'instagram', 'twitter',
            ]),
            'keywords' => collect($this->movie['keywords']['keywords'])->take(10)
        ])->only([
            'poster_path', 'backdrop_path', 'id', 'genres', 'title', 'runtime', 'vote_average', 'production_countries', 'spoken_languages', 
            'original_title', 'overview', 'release_date', 'credits' ,'videos', 'images', 'crew', 'cast', 'images', 'homepage', 'social','keywords'
        ]);
    }

    // for similarMovies list
    private function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            // create key=>val pair collection of genreId=>genreName
            return [$genre['id'] => $genre['name']];
        });
    }
    
    
    // Helper function for similiar movies, first converts the arrays into a collection instance(laravel wrapper for working with arrays of data) , then maps over collection
    private function formatMovies($movies)
    {   
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            // format items and merge into a collection / ->only - Get only the selected items([] of key names) , use except for oposite effect

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
        return view('livewire.pages.movies.show', ['movie'=>$this->movie, 'similarMovies'=>$this->similarMovies]);
    }
}
