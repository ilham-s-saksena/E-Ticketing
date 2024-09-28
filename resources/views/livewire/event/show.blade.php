<div>
    @foreach ($events as $event)
        @livewire('event.card', ['event' => $event], key($event->id))
    @endforeach
</div>
