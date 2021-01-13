<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class MovieCard extends Component
{   
    public $movie;

    public function render()
    {
        return view('livewire.components.movie-card', ['movie'=>$this->movie]);
    }
}
