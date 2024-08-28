<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Ticket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <form action="{{route('purchase')}}" method="post" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    @csrf

    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
      <div class="min-w-0 flex-1 space-y-8">
        <div class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Detail Pembelian</h2>

          @php
              $event = $tickets[0]->events;
              $total = 0;
          @endphp

          <section class="bg-white px-4 antialiased dark:bg-gray-900">
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

                    </div>
                </div>
            </section>

            @foreach ($tickets as $ticket)
            <div class="flex space-x-2 mb-3 w-full">
                <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4 flex-1">
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

                <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-3 flex items-center">
                    qty : <span class="font-bold text-gray-900 dark:text-white ml-1"> {{$ticketOrder[$ticket->id]}}</span>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-3 flex items-center text-sm">
                    Subtotal : <span class="font-bold text-gray-900 dark:text-white ml-1 text-md"> {{ "Rp.".number_format(($ticket->price * $ticketOrder[$ticket->id]), 0, ",", ".") }}</span>
                </div>
            </div>
            @php
                $total += $ticket->price * $ticketOrder[$ticket->id];
            @endphp
            @endforeach

          
        </div>


      </div>

      <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Isi Data Pembeli</h2>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Nama Lengkap </label>
                <input type="text" id="name" name="name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" placeholder="Hando Sasonto" required />
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Email </label>
                <input type="email" id="email" name="email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" placeholder="name@e-ticketing.com" required />
            </div>

            <div>
                <label for="phone" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Nomor WhatsApp </label>
                <input type="number" id="phone" name="phone" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" placeholder="6210932740" required />
            </div>
        
        </div>

        <div class="hidden">
          @foreach ($ticketOrder as $ticket_id => $ticket_qty)
            <input type="hidden" name="tickets[{{$ticket_id}}]" value="{{$ticket_qty}}" required readonly>
          @endforeach
        </div>

        <div class="space-y-4">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment</h3>

          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input id="qris" aria-describedby="qris-text" type="radio" name="payment-method" value="qris" class="h-4 w-4 border-gray-300 bg-white text-blue-600 focus:ring-2 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" checked />
                </div>

                <div class="ms-4 text-sm">
                  <label for="qris" class="font-medium leading-none text-gray-900 dark:text-white"> QRIS </label>
                  <p id="qris-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Bayar pake QRIS</p>
                </div>
              </div>

            </div>

            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input id="pay-on-delivery" aria-describedby="pay-on-delivery-text" type="radio" name="payment-method" value="" class="h-4 w-4 border-gray-300 bg-white text-blue-600 focus:ring-2 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" />
                </div>

                <div class="ms-4 text-sm">
                  <label for="pay-on-delivery" class="font-medium leading-none text-gray-900 dark:text-white"> Transfer Bank </label>
                  <p id="pay-on-delivery-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Transfer via Virtual Account</p>
                </div>
              </div>

            </div>

          </div>
        </div>

        <div class="flow-root rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
          <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
              <dd class="text-base font-medium text-gray-900 dark:text-white">{{ "Rp.".number_format($total, 0, ",", ".") }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Diskon</dt>
              <dd class="text-base font-medium text-green-500">0</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
              <dd class="text-base font-bold text-gray-900 dark:text-white">{{ "Rp.".number_format($total, 0, ",", ".") }}</dd>
            </dl>
          </div>
        </div>

        <div class="space-y-3">
          <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4  focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proses Pembayaran</button>

          <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Detail Pembayaran akan dikirim ke Email kamu. <span class="font-medium text-blue-700 dark:text-blue-500">Mohon periksa email secara berkala, termasuk folder Spam.</span></p>
        </div>


<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 w-16 h-16 text-gray-400 dark:text-gray-200 border-gray-400 dark:border-gray-200 border-2 p-2 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Detail Pembayaran akan dikirim ke Email kamu. <span class="text-blue-700 dark:text-blue-500">Mohon periksa email secara berkala, termasuk folder Spam.</span></h3>
                <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Lanjutkan Pembelian
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
            </div>
        </div>
    </div>
</div>


      </div>
    </div>
  </form>
</section>

</body>
</html>