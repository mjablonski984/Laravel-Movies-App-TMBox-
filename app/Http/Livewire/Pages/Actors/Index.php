<?php

namespace App\Http\Livewire\Pages\Actors;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{   
    public $popularActors;
    public $page;

    public function mount($page = 1)
    {   
        $this->page = $page;

        abort_if($page > 500, 204);

        $this->popularActors = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
            ->json()['results'];

         // dump($this->popularActors, $this->page);    
        $this->popularActors = $this->popularActors();

    }

    private function popularActors()
    {   
        // In 'known_for' in each item n the arr there's media_type key with val 'tv' or movie ,
        // Combine(make union) of both collections and pluck only the name from each item, next implode into a string
        return collect($this->popularActors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face'.$actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name='.$actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', '),
            ])->only([
                'name', 'id', 'profile_path', 'known_for',
            ]);
        });
    }

    // Pagination
    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }

    public function render()
    {
        return view('livewire.pages.actors.index', ['popularActors'=>$this->popularActors, 'page'=>$this->page, 'previous'=>$this->previous(), 'next'=>$this->next()]);
    }
}
