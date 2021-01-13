<?php

namespace App\Http\Livewire\Pages\Actors;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{   
    public $actorId;
    public $actor;
    public $credits;
    public $knownForMovies;
    

    public function mount($actor)
    {   
        // Attribute passed in mount constructor must have the same name as route param (movieId, actor etc.)
        $this->actorId = $actor;

        $this->actor = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$this->actorId.'?append_to_response=images,external_ids')
            ->json();

        $this->credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$this->actorId.'/combined_credits')
            ->json();
        
        // dump($this->actor, $this->credits);

        // Use class methods to filter data and create laravel collections
        $this->actor = $this->actor();
        // ! filter knownForMovies before the credits
        $this->knownForMovies = $this->knownForMovies(); 
        $this->credits = $this->credits();
        
        // dump($this->actor, $this->credits, $this->knownForMovies);
    }

    private function actor()
    {   
        // Carbon method ->age - get the difference between given date and current date
        return collect($this->actor)->merge([
            'birthday' => $this->actor['birthday'] ? Carbon::parse($this->actor['birthday'])->format('d M, Y') : null,
            'deathday' => $this->actor['deathday'] ? Carbon::parse($this->actor['deathday'])->format('d M, Y') : null,
            'age' => ($this->actor['deathday'] != null)
                ? Carbon::parse($this->actor['birthday'])->age - Carbon::parse($this->actor['deathday'])->age 
                : Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
                ? 'https://image.tmdb.org/t/p/w300/'.$this->actor['profile_path']
                : '/images/placeholder300x450.png',
            'social' => collect($this->actor['external_ids'])->merge([
                'twitter' => $this->actor['external_ids']['twitter_id'] ? 'https://twitter.com/'.$this->actor['external_ids']['twitter_id'] : null,
                'facebook' => $this->actor['external_ids']['facebook_id'] ? 'https://facebook.com/'.$this->actor['external_ids']['facebook_id'] : null,
                'instagram' => $this->actor['external_ids']['instagram_id'] ? 'https://instagram.com/'.$this->actor['external_ids']['instagram_id'] : null,
            ])->only(['facebook', 'instagram', 'twitter',]),
            'images' => collect($this->actor['images']['profiles'])->take(9)->map(function($images) {
                return collect($images)->merge([
                    'file_path' => $images['file_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$images['file_path']
                        : '/images/placeholder300x450.png',
                ])->only(['file_path']);
            }),
        ])->only([
            'birthday', 'deathday', 'age', 'profile_path', 'name', 'id', 'homepage', 'place_of_birth', 'biography', 'social', 'images'
        ]);
    }

    private function knownForMovies()
    {   
        $castMovies = collect($this->credits)->get('cast');
        
        // dump($castMovies);

        return collect($castMovies)->sortByDesc('popularity')->take(6)->map(function($movie) {
            if (isset($movie['title'])) { // if movie
                $title = $movie['title'];
            } elseif (isset($movie['name'])) { //if tvshow
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }
            // linkToPage - check if known for is a movie or tvshow and redirect to correct route
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                    : '/images/placeholder185x278.png',
                'title' => $title,
                'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
            ])->only([
                'poster_path', 'title', 'id', 'media_type', 'linkToPage',
            ]);
        });
    }

    private function credits()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function($movie) {
            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
            ])->only([
                'id','release_date', 'release_year', 'title', 'character', 'media_type'
            ]);
        })->sortByDesc('release_date');
    }


    public function render()
    {
        return view('livewire.pages.actors.show', [
            'actor' => $this->actor,
            'credits' => $this->credits,
            'knownForMovies' => $this->knownForMovies
        ]);
    }
}
