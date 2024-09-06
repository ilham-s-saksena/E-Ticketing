<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tickets</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="grid place-items-center">

@php
    $i = 1;
    $maxi = $eventAccess->count();
@endphp

@foreach ($eventAccess as $access)

<div id="ticket-{{$access->id}}" class=" bg-gray-400 max-w-sm w-full p-2 bg-center bg-no-repeat bg-cover" style="background-image: url('{{$ticket->events->flyer}}')">
    <div class="bg-white/80 rounded-lg p-4 overflow-hidden">

        <div class="text-center">
            <h1 class="text-lg font-bold text-purple-600">E-Ticketing.ID</h1>
        </div>
        <div class="flex justify-between mt-4">
            <img src="/images/logo.png" alt="Logo KAI" class="h-10">
            <div class="text-right flex-1">
                <p class="text-gray-800 font-semibold truncate">
                    {{$ticket->events->name}}
                </p>
                <p class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($ticket->events->event_date)->locale('id')->translatedFormat('l, d F Y') }}
                </p>
            </div>
        </div>

        <div class="flex justify-between mt-4">
            <div>
                <p class="text-blue-600 font-bold text-xl">IN</p>
                <p class="font-bold text-lg mt-1">{{$ticket->events->time_start}}</p>
            </div>
            <div class="text-center flex-1">
                <div class="flex items-center justify-center">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <div class="w-12 h-0.5 bg-gray-300"></div>
                    <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                    <div class="w-12 h-0.5 bg-gray-300"></div>
                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Event</p>
            </div>
            <div class="text-right">
                <p class="text-orange-500 font-bold text-xl">OUT</p>
                <p class="font-bold text-lg mt-1">{{$ticket->events->time_end}}</p>
            </div>
        </div>

        <div class="mt-4 border-t-2 border-gray-400 pt-4 border-dashed relative">
            <div class="w-6 h-6 rounded-full -left-7 absolute z-20 bg-gray-400 top-0 -translate-y-1/2"></div>
            <div class="w-6 h-6 rounded-full -right-7 absolute z-20 bg-gray-400 top-0 -translate-y-1/2"></div>
            <p class="text-gray-800 font-semibold">By</p>
            <div class="flex justify-between mt-2">
                <p class="font-bold flex-1 truncate">{{auth()->user()->organizations->name}}</p>
                <p class="font-bold text-sm truncate">-----</p>
            </div>
            <div class="flex justify-between mt-1">
                <p class="text-gray-500">Tiket</p>
                <p class="text-gray-500">No.Hp</p>
            </div>
            <div class="flex justify-between mt-1">
                <p class="font-bold">{{$ticket->name}} - <span class="font-bold text-purple-600">0{{$i++}}/0{{$maxi}}</span>  </p>
                <p class="font-bold">-----</p>
            </div>
        </div>

        <div class="mt-4 border-t-2 border-gray-400 pt-4 text-center">
            <p class="text-gray-600 mb-2">Pindai kode ini di Gerbang</p>
            <img src="{{ url('qrcode/'.$access->qr) }}" alt="QR Code" class="mx-auto h-32">
            <p class="text-xs text-gray-500 mt-2">{{$ticket->id}}</p>
            <p class="text-xs text-gray-500">Dicetak: {{ \Carbon\Carbon::parse(now())->locale('id')->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>
</div>

@endforeach


</div>
<div id="loading" style="display: none;">
    <div class="flex justify-center items-center fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
       var ticketElements = [];

       // Kumpulkan semua elemen tiket
       @foreach ($eventAccess as $access)
           ticketElements.push('ticket-{{$access->id}}');
       @endforeach

       // Download semua tiket secara otomatis
       downloadAllTicketsAsImages(ticketElements);
   });

   function downloadAllTicketsAsImages(ticketElements) {
       document.getElementById('loading').style.display = 'block';
       
       ticketElements.forEach(function (ticketId, index) {
           var node = document.getElementById(ticketId);
           
           domtoimage.toPng(node)
               .then(function (dataUrl) {
                   var link = document.createElement('a');
                   link.download = 'ticket-' + (index + 1) + '.png';
                   link.href = dataUrl;
                   link.click();

                   // Jika semua tiket sudah selesai di-download, hilangkan animasi loading
                   if (index === ticketElements.length - 1) {
                       document.getElementById('loading').style.display = 'none';
                   }
               })
               .catch(function (error) {
                   document.getElementById('loading').style.display = 'none';
                   console.error('Oops, something went wrong!', error);
               });
       });
   }
</script>

<script>
    window.addEventListener('beforeunload', function (event) {
        // Membatalkan tindakan default (refresh)
        event.preventDefault();

        // Pesan ini tidak akan muncul di banyak browser modern, namun ini tetap harus ada
        event.returnValue = '';

        // Kembali ke halaman sebelumnya
        window.history.back();
    });
</script>



</body>
</html>