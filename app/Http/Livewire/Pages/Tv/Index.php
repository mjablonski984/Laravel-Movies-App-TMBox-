<?php

namespace App\Http\Livewire\Pages\Tv;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{   
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function mount()
    {
        $this->popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];

        $this->topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];

        $this->genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        $this->popularTv = $this->formatTv($this->popularTv);
        $this->topRatedTv = $this->formatTv($this->topRatedTv);
        $this->genresList = $this->genres; // unformatted genres array
        $this->genres = $this->genres();
        // dump($this->popularTv,$this->topRatedTv,$this->genres);

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
        return view('livewire.pages.tv.index', ['popularTv'=>$this->popularTv, 'topRatedTv'=>$this->topRatedTv, 'genresList'=>$this->genresList]);
    }
}
