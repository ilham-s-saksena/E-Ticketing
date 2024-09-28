<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay the Payment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

@php
    $total  = 0;
@endphp

<section class="bg-white px-4 py-8 antialiased dark:bg-gray-900 ">
  <div class="mx-auto grid max-w-xl rounded-lg bg-gray-50 p-2 dark:bg-gray-800 lg:grid-cols-12 lg:gap-4 lg:p-4 xl:gap-4 shadow place-items-center">
    <div class="lg:col-span-5 lg:mt-0">
      <a href="#">
      <div class="h-56 w-56 rounded shadow bg-contain bg-center bg-no-repeat" style="background-image: url('{{$event->flyer}}')"></div>
      </a>
    </div>
    <div class="me-auto place-self-center lg:col-span-7">
      <h1 class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
        {{ $event->name }}
      </h1>

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

  <div class="max-w-xl mx-auto mt-10">
  @foreach ($purchases as $purchase)
    <div class="flex space-x-2 mb-3 w-full">
        <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4 flex-1">
            <div class="space-y-4 md:flex md:items-center md:justify-between md:space-y-0">
                <div class="w-full min-w-0 flex-1 md:max-w-md flex-1">
                    <div class="text-base font-extrabold text-gray-900 dark:text-white">
                        {{ $purchase->tickets->name }}
                    </div>
                    <div class="flex pr-1 items-center text-xs font-light text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        {{ $purchase->tickets->description }}
                    </div>
                </div>
                <div class="text-base font-bold text-gray-900 dark:text-white">
                    {{ "Rp.".number_format($purchase->tickets->price, 0, ",", ".") }}
                </div>

            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-3 flex items-center">
            qty : <span class="font-bold text-gray-900 dark:text-white ml-1"> {{$purchase->qty}}</span>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-3 flex items-center text-sm">
            Subtotal : <span class="font-bold text-gray-900 dark:text-white ml-1 text-md"> {{ "Rp.".number_format(($purchase->tickets->price * $purchase->qty), 0, ",", ".") }}</span>
        </div>
    </div>
    @php
        $total += $purchase->tickets->price * $purchase->qty;
    @endphp
    @endforeach

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
      @if ($purchase->status == 'paid')
      <div class="mx-auto max-w-5xl flex justify-center relative mt-10">
        <div class="w-full sticky bottom-0 max-w-lg h-20 grid place items-center bg-white/75 rounded-xl px-5 sm:px-10 border">
          <a href="{{ route('pay-success', $token) }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900">
            <svg class="-ms-2 me-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
            </svg>
            Lunas, Lihat Tiket
          </a>
        </div>
      </div>

      @else

        <div class="mx-auto max-w-5xl flex justify-center relative mt-10">
          <div class="w-full sticky bottom-0 max-w-lg h-20 grid place items-center bg-white/75 rounded-xl px-5 sm:px-10 border">
            <button id="pay-button" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
              <svg class="-ms-2 me-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
              </svg>
              Bayar Tiket
            </button>
          </div>
        </div>
        @endif
  </div>
</section>


    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{env("MIDTRANS_CLIENT_KEY")}}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        snap.pay('{{$token}}', {
          onSuccess: function(result){
            const resultJson = encodeURIComponent(JSON.stringify(result));
            window.location.href = `{{ route('pay-success', $token) }}`;
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ 
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ 
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
    <script>
        const submitButton = document.getElementById('pay-button');
        submitButton.addEventListener('click', function () {
        // Tampilkan loading pada tombol submit
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            Processing...
        `;
        });
    </script>
</body>
</html>