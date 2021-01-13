<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SwiperButtons extends Component
{   
    public $icon;

    public function render()
    {
        return view('livewire.components.swiper-buttons',['icon'=>$this->icon]);
    }
}
