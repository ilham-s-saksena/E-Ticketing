<?php

namespace App\Livewire\Event;

use Livewire\Component;

class Header extends Component
{
    public $search;

    public function updatedSearch()
    {
        $this->emit('searchUpdated', $this->search);
    }

    public function render()
    {
        return view('livewire.event.header');
    }
}
