<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class TvCard extends Component
{   
    public $tvshow;

    public function render()
    {
        return view('livewire.components.tv-card', ['tvshow'=>$this->tvshow]);
    }
}
