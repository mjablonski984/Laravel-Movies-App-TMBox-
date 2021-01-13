<?php

namespace App\Http\Livewire\Pages\Tv;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{   
    public $tvshow;
    public $tvId;
    public $similarShows;
    public $genres;

    public function mount($tvId)
    {   
        // Attribute passed in mount constructor must have the same name as route param (movieId, actor etc.)
        $this->tvId = $tvId;
    
        /* The movie, TV show, TV season, TV episode and person detail methods support 
        a query parameter called append_to_response. 
        This makes it possible to make sub requests within the same namespace in a single HTTP request. 
        Each request will get appended to the response as a new JSON object.*/
        
        $this->tvshow = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$this->tvId.'?append_to_response=credits,videos,images,keywords,external_ids')
        ->json();

        $this->similarShows = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$this->tvId.'/similar')
        ->json()['results'];

        $this->genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')
        ->json()['genres'];

        // dump($this->tvshow);
        $this->tvshow = $this->tvshow();

        $this->similarShows = $this->formatTv($this->similarShows);
        $this->genres = $this->genres(); // for similiar tv shows     
    }


    private function tvshow()
    {   
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$this->tvshow['poster_path']
                : '/images/placeholder750x500.png',
            'backdrop_path' => 'https://image.tmdb.org/t/p/original/'.$this->tvshow['backdrop_path'],
            'vote_average' => $this->tvshow['vote_average'] * 10 .'%',
            'first_air_date' => (isSet($this->tvshow['first_air_date'])) ? Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y') : null,
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'production_countries' => collect($this->tvshow['production_countries'])->take(5)->pluck('name')->flatten()->implode(', '),
            'spoken_languages' => collect($this->tvshow['spoken_languages'])->take(10)->pluck('english_name')->flatten()->implode(', '),
            'cast' => collect($this->tvshow['credits']['cast'])->take(10)->map(function($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                        : '/images/placeholder300x450.png',
                ]);
            }),
            'images' => collect($this->tvshow['images']['backdrops'])->take(9),
            'social' => collect($this->tvshow['external_ids'])->merge([
                'twitter' => $this->tvshow['external_ids']['twitter_id'] ? 'https://twitter.com/'.$this->tvshow['external_ids']['twitter_id'] : null,
                'facebook' => $this->tvshow['external_ids']['facebook_id'] ? 'https://facebook.com/'.$this->tvshow['external_ids']['facebook_id'] : null,
                'instagram' => $this->tvshow['external_ids']['instagram_id'] ? 'https://instagram.com/'.$this->tvshow['external_ids']['instagram_id'] : null,
            ])->only(['facebook', 'instagram', 'twitter',]),
            'keywords' => collect($this->tvshow['keywords']['results'])->take(10)
        ])->only([
            'poster_path','backdrop_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date', 'credits' ,'production_countries', 'spoken_languages', 
            'original_name', 'videos', 'images', 'crew', 'cast', 'images', 'created_by', 'in_production', 'homepage', 'social', 'status','number_of_seasons', 'number_of_episodes','keywords'
        ]);
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
                'poster_path',  'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }

    public function render()
    {
        return view('livewire.pages.tv.show', ['tvshow'=> $this->tvshow, 'similarShows'=>$this->similarShows]);
    }
}
