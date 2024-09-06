@extends('users.navigation')
@section('content')
<nav class="flex" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 me-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
        </svg>
        Ticket
      </a>
    </li>
  </ol>
</nav>
<div class="text-sm text-gray-500">
    <p>Anda dapat membuat tiket dari event yang sudah anda buat.</p>
    <p>Tiket dapat di download yang kemudian di cetak dan anda dapat menjualnya secara offline.</p>
    <p>Anda hanya dapat mendownload tiket satu kali, agar tidak ada redudansi/duplikasi tiket.</p>
</div>

<div class="mt-5 p-2">
    @foreach ($events as $event)

    <div class="p-2 bg-gray-200 rounded-lg">
        <div class="flex items-center bg-white w-fit pr-4 rounded pl-1 py-1">
            <div class="w-20 h-20 bg-center bg-contain bg-no-repeat rounded shadow me-2" style="background-image: url('{{$event->flyer}}')"></div>
            <div>
                <p class="text-lg font-bold">{{$event->name}}</p>
                <p class="text-sm">{{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
        @foreach ($event->tickets as $ticket)

        <div class="rounded-lg mt-2 border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4 w-full max-w-md">
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
                <button data-modal-target="popup-delete-{{$ticket->id}}" data-modal-toggle="popup-delete-{{$ticket->id}}" class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-3 py-2 text-center text-base font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 flex items-center ms-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    Create
                </button>
            </div>
        </div>
        <div id="popup-delete-{{$ticket->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-delete-{{$ticket->id}}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form method="post" action="{{route('eventaccess.admin')}}" class="p-4 md:p-5 text-center">
                        @csrf
                        <div class="relative mb-3">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Tiket</label>
                            <input type="number" name="jumlah" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="1.000" required />
                            <input type="hidden" name="ticket_id" id="" value="{{$ticket->id}}" readonly />
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Ticket</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @endforeach

</div>
@endsection