<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class Show extends Component
{
    public $search;

    public function mount($search = null)
    {
        $this->search = $search;
    }
    public function render()
    {
        if ($this->search != null) {
            return view('livewire.event.show', [
                'events' => Event::where('name', $this->search)->get()
            ]);
        } else {
            return view('livewire.event.show', [
                'events' => Event::all()
            ]);
        }
    }
}
