<?php

namespace App\Livewire\Event;

use Livewire\Component;

class Card extends Component
{
    public $event;
    public $name;
    public function render()
    {
        return view('livewire.event.card');
    }
}
