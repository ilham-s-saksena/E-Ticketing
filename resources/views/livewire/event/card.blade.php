<section class="bg-white px-4 py-8 antialiased dark:bg-gray-900">
  <div class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-2 dark:bg-gray-800 lg:grid-cols-12 lg:gap-4 lg:p-4 xl:gap-4 shadow place-items-center">
    <div class="lg:col-span-5 lg:mt-0">
      <a href="#">
        <img class=" h-56 w-56 rounded shadow" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-components.svg" alt="peripherals" />
      </a>
    </div>
    <div class="me-auto place-self-center lg:col-span-7">
      <h1 class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
        {{ $event->name }}
      </h1>
      <p class="mb-2 text-gray-500 dark:text-gray-400">
        {{ $event->description }}
      </p>

      <ul class="flex items-center space-x-2 mb-3">
        <li class="font-bold text-gray-700">
            Guest Stars | <span class="text-gray-500 text-sm">@foreach (json_decode($event->guest_stars) as $gs) {{$gs}} | @endforeach</span> 
        </li>
    </ul>

    <ul class="flex items-center space-x-2 mb-3">
        <li>
            <div class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>

            </div>
        </li>
        <li class="font-semibold text-gray-500 text-sm">
            {{ $event->place_name }}
        </li>
        <li class="font-semibold text-gray-500 text-sm">•</li>
        <li class="font-semibold text-gray-500 text-sm">
            {{ $event->place_address }}
        </li>
    </ul>

    <ul class="flex items-center space-x-2 mb-3">
        <li>
            <div class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
            </svg>

            </div>
        </li>
        <li class="font-semibold text-gray-500 text-sm">
            {{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('l, d F Y') }}
        </li>
        <li class="font-semibold text-gray-500 text-sm">•</li>
        <li class="font-semibold text-gray-500 text-sm">
            {{ $event->time_start }} - {{ $event->time_end }} 
        </li>
    </ul>

      <a target="_blank" href="/event/{{$event->id}}" class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900"> See Event Details </a>
      <input type="text" wire:model="name">
      {{$name}}
    </div>
  </div>
</section>
