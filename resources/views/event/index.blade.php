<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->name }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mx-auto max-w-5xl">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">{{ $event->name }}</h2>
      <div class="my-8 xl:mb-16 xl:mt-12">
        <img class="w-full dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-showcase.svg" alt="" />
        <img class="hidden w-full dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-showcase-dark.svg" alt="" />
      </div>
      <div class="mx-auto max-w-2xl space-y-6">
        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $event->description }}</p>

        

        <p class="text-base font-semibold text-gray-900 dark:text-white">Gues Stars</p>
        <ul class="list-outside list-disc space-y-4 pl-4 text-base font-normal text-gray-500 dark:text-gray-400">
            @foreach (json_decode($event->guest_stars) as $gs)
            <li>
                <span class="font-semibold text-gray-900 dark:text-white"> {{$gs}} </span>
            </li>
            @endforeach
        </ul>
      </div>
     
      
      <div class="mx-auto my-6 max-w-3xl space-y-6 md:mb-12">
        
        <ul class="flex items-center space-x-2 mb-3">
              <li>
                  <div class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                      </svg>
  
                  </div>
              </li>
              <li>
                  <ul>
                      <li class="font-semibold text-gray-800 ">
                          {{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('l, d F Y') }}
                      </li>
                      <li class="font-semibold text-gray-500 text-sm">
                          {{ $event->time_start }} - {{ $event->time_end }} 
                      </li>
  
                  </ul>
              </li>
          </ul>

          <ul class="flex items-center space-x-2 mb-3">
                <li>
                    <div class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>

                    </div>
                </li>
                <li>
                    <ul>
                        <li class="font-semibold text-gray-800 ">
                            {{ $event->place_name }}
                        </li>
                        <li class="font-semibold text-gray-500 text-sm">
                            {{ $event->place_address }}
                        </li>

                    </ul>
                </li>
            </ul>

            <div class="p-4 md:p-5 space-y-4">
                <iframe id="disPlay" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://maps.google.com/maps?q={{json_decode($event->place_location)->latitude}},{{json_decode($event->place_location)->longitude}}&output=embed"></iframe>
            </div>
      </div>


      <div class="w-full sticky bottom-0 left-1/2 -translate-x-1/2 max-w-lg h-20 grid place items-center bg-white/75 rounded-xl px-5 sm:px-10">
        <button data-modal-target="buy-ticket" data-modal-toggle="buy-ticket" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            <svg class="-ms-2 me-2 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
            </svg>
            Beli Tiket
        </button>
      </div>


    <div id="buy-ticket" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <form action="{{route('checkout')}}" method="post" class="relative p-4 w-full max-w-lg h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
                <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Beli Tiket {{ $event->name }}</h3>
                    @csrf
                    @php
                        $tickets = $event->tickets;
                    @endphp
                    @foreach ($tickets as $ticket)
                    
                    <div class="flex space-x-2 mb-3">
                        <div class="rounded-lg border border-gray-200 bg-white p-1 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-2">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:space-y-0">
                                <div class="w-full min-w-0 flex-1 md:max-w-md flex-1">
                                    <div class="text-base font-extrabold text-gray-900 dark:text-white">
                                        {{ $ticket->name }}
                                    </div>
                                    <div class="flex pr-1 items-center text-xs font-light text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                        {{ $ticket->description }}
                                    </div>
                                </div>
                                <div class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ "Rp.".number_format($ticket->price, 0, ",", ".") }}
                                </div>

                            </div>
                        </div>

                        <div class="rounded-lg border border-gray-200 bg-white p-1 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-2 flex items-center">

                            <div class="flex items-center">
                                <div class="sr-only" id="ticket-price-{{$ticket->id}}"></div>
                                <button type="button" id="decrement-{{$ticket->id}}" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" name="amountTicket[{{$ticket->id}}]" id="counter-{{$ticket->id}}" class="w-16 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="0" required />
                                <button type="button" id="increment-{{$ticket->id}}" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    <p>
                        Setelah memilih tiket kamu akan mengisi detail pembayaran dan beberapa informasi lainnya.
                    </p>

                    <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4 mt-3">
                        <div class="text-base font-bold text-gray-900 dark:text-white text-center">
                            Total <span id="total" class="text-green-700">Rp. 0</span>
                        </div>

                    </div>
                </div>
                <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                    <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0 justify-center w-full">
                        <button data-modal-toggle="buy-ticket" type="button"  class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                        @if ($event->tickets->isNotEmpty())
                            
                        <button type="submit" class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-auto hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    </div>
  </div>
</section>

<script>

document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi harga ticket (ini contoh, pastikan nilai ini sesuai dengan data kamu)
    const ticketPrices = {
        @foreach($tickets as $ticket)
            "{{$ticket->id}}": {{$ticket->price}}, // ID tiket sebagai string
        @endforeach
    };

    const updateTotalPrice = () => {
        let total = 0;
        @foreach($tickets as $ticket)
            const qty_{{$ticket->id}} = parseInt(document.getElementById('counter-{{$ticket->id}}').value);
            total += qty_{{$ticket->id}} * ticketPrices["{{$ticket->id}}"]; // Akses dengan key string
        @endforeach
        document.getElementById('total').textContent = `Rp. ${total.toLocaleString('id-ID')}`;
    };

    @foreach($tickets as $ticket)
        // Event listener untuk tombol increment
        document.getElementById('increment-{{$ticket->id}}').addEventListener('click', function () {
            const counterInput = document.getElementById('counter-{{$ticket->id}}');
            const currentValue = parseInt(counterInput.value);
            counterInput.value = currentValue + 1;
            updateTotalPrice();
        });

        // Event listener untuk tombol decrement
        document.getElementById('decrement-{{$ticket->id}}').addEventListener('click', function () {
            const counterInput = document.getElementById('counter-{{$ticket->id}}');
            const currentValue = parseInt(counterInput.value);
            if (currentValue > 0) {
                counterInput.value = currentValue - 1;
                updateTotalPrice();
            }
        });

        const counterInput_{{$ticket->id}} = document.getElementById('counter-{{$ticket->id}}');

        // Mencegah input non-numerik
        counterInput_{{$ticket->id}}.addEventListener('input', function (e) {
            // Hanya izinkan angka
            counterInput_{{$ticket->id}}.value = counterInput_{{$ticket->id}}.value.replace(/[^0-9]/g, '');
        });

        // Opsional: Mencegah pengguna menempelkan (paste) karakter non-numerik
        counterInput_{{$ticket->id}}.addEventListener('paste', function (e) {
            let pasteData = (e.clipboardData || window.clipboardData).getData('text');
            if (!/^[0-9]+$/.test(pasteData)) {
                e.preventDefault();
            }
        });

        // Opsional: Mencegah penggunaan tombol non-numerik pada keyboard
        counterInput_{{$ticket->id}}.addEventListener('keydown', function (e) {
            // Izinkan tombol seperti backspace, delete, tab, escape, enter, dan arrow keys
            if ([46, 8, 9, 27, 13, 37, 38, 39, 40].indexOf(e.keyCode) !== -1 ||
                // Izinkan kombinasi Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true))) {
                return;
            }
            // Mencegah angka di luar angka 0-9
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        // Event listener untuk input manual
        counterInput_{{$ticket->id}}.addEventListener('input', function () {
            updateTotalPrice();
        });
    @endforeach

    // Panggil sekali untuk inisialisasi
    updateTotalPrice();
});

</script>
    
</body>
</html>