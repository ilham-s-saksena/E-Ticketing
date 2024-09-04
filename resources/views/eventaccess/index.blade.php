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

<div id="ticket-{{$access->id}}" class=" bg-gray-400 max-w-sm w-full p-2 bg-center bg-no-repeat bg-cover" style="background-image: url('{{$access->purchases->tickets->events->flyer}}')">
    <div class="bg-white/80 rounded-lg p-4 overflow-hidden">

        <div class="text-center">
            <h1 class="text-lg font-bold text-purple-600">E-Ticketing.ID</h1>
        </div>
        <div class="flex justify-between mt-4">
            <img src="/images/logo.png" alt="Logo KAI" class="h-10">
            <div class="text-right flex-1">
                <p class="text-gray-800 font-semibold truncate">
                    {{$access->purchases->tickets->events->name}}
                </p>
                <p class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($access->purchases->tickets->events->event_date)->locale('id')->translatedFormat('l, d F Y') }}
                </p>
            </div>
        </div>

        <div class="flex justify-between mt-4">
            <div>
                <p class="text-blue-600 font-bold text-xl">IN</p>
                <p class="font-bold text-lg mt-1">{{$access->purchases->tickets->events->time_start}}</p>
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
                <p class="font-bold text-lg mt-1">{{$access->purchases->tickets->events->time_end}}</p>
            </div>
        </div>

        <div class="mt-4 border-t-2 border-gray-400 pt-4 border-dashed relative">
            <div class="w-6 h-6 rounded-full -left-7 absolute z-20 bg-gray-400 top-0 -translate-y-1/2"></div>
            <div class="w-6 h-6 rounded-full -right-7 absolute z-20 bg-gray-400 top-0 -translate-y-1/2"></div>
            <p class="text-gray-800 font-semibold">Pemesan</p>
            <div class="flex justify-between mt-2">
                <p class="font-bold flex-1 truncate">{{$access->purchases->buyers->name}}</p>
                <p class="font-bold text-sm truncate">{{$access->purchases->buyers->email}}</p>
            </div>
            <div class="flex justify-between mt-1">
                <p class="text-gray-500">Tiket</p>
                <p class="text-gray-500">No.Hp</p>
            </div>
            <div class="flex justify-between mt-1">
                <p class="font-bold">{{$access->purchases->tickets->name}} - <span class="font-bold text-purple-600">0{{$i++}}/0{{$maxi}}</span>  </p>
                <p class="font-bold">{{$access->purchases->buyers->phone}}</p>
            </div>
        </div>

        <div class="mt-4 border-t-2 border-gray-400 pt-4 text-center">
            <p class="text-gray-600 mb-2">Pindai kode ini di Gerbang</p>
            <img src="{{ url('qrcode/'.$access->qr) }}" alt="QR Code" class="mx-auto h-32">
            <p class="text-xs text-gray-500 mt-2">{{$access->purchases->tickets->id}}</p>
            <p class="text-xs text-gray-500">Dicetak: {{ \Carbon\Carbon::parse(now())->locale('id')->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>
</div>
<div class="mw-full flex justify-center max-w-sm my-2">
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
    onclick="downloadTicketAsImage('ticket-{{$access->id}}')">
    <svg class="w-5 h-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
    </svg>
    
    Download as Image
</button>
</div>

@endforeach

<div class="mw-full flex justify-center max-w-sm my-2 sticky bottom-0 py-3 bg-white/90">
    <button class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" 
    onclick="sendAllTicketsAsImages('{{ $access->purchases->buyers->email }}', '{{ $access->purchases->id }}')">
    <svg class="w-5 h-5 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
    </svg>
    Kirim Ulang Tiket ke Email
</button>
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
    function downloadTicketAsImage(ticketId) {
    document.getElementById('loading').style.display = 'block';
    var node = document.getElementById(ticketId);
    domtoimage.toPng(node)
        .then(function (dataUrl) {
            document.getElementById('loading').style.display = 'none';
            var img = new Image();
            img.src = dataUrl;
            var link = document.createElement('a');
            link.download = 'ticket.png';
            link.href = dataUrl;
            link.click();
        })
        .catch(function (error) {
            document.getElementById('loading').style.display = 'none';
            console.error('Oops, something went wrong!', error);
        });
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($eventAccess->isNotEmpty() && !$access->purchases->isSended)
            sendAllTicketsAsImages('{{ $access->purchases->buyers->email }}', '{{ $access->purchases->id }}');
        @endif
    });

    function sendAllTicketsAsImages(email, purchaseId) {
        let images = [];
        let ticketElementIds = [];

        document.getElementById('loading').style.display = 'block';

        // Kumpulkan semua ID elemen tiket
        @foreach ($eventAccess as $access)
            ticketElementIds.push('ticket-{{$access->id}}');
        @endforeach

        // Proses setiap elemen tiket
        ticketElementIds.forEach(function(ticketElementId) {
            domtoimage.toPng(document.getElementById(ticketElementId))
                .then(function (dataUrl) {
                    images.push(dataUrl);
                    if (images.length === ticketElementIds.length) {
                        sendEmailWithTickets(images, email, purchaseId);
                    }
                })
                .catch(function (error) {
                    console.error('Oops, something went wrong!', error);
                });
        });
    }

    function sendEmailWithTickets(images, email, purchaseId) {
        fetch('/eventaccess/send-tickets', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                images: images,
                email: email,
                purchase_id: purchaseId 
            })
        }).then(response => response.json())
      .then(data => {
        document.getElementById('loading').style.display = 'none';
          if (data.success) {
              alert('E-Tiket berhasil dikirim ke email: ' + email);
          } else {
              alert('Terjadi kesalahan saat mengirim tiket. Silakan coba lagi.');
          }
      })
      .catch((error) => {
        document.getElementById('loading').style.display = 'none';
          alert('Error: Terjadi kesalahan saat mengirim tiket.');
          console.error('Error:', error);
      });
    }
</script>


</body>
</html>