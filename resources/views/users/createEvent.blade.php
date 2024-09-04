@extends('users.navigation')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<nav class="flex mb-5" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="/event/admin/event/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-5 h-5 me-2"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
        </svg>
        Event
      </a>
    </li>
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Create Event</span>
      </div>
    </li>
  </ol>
</nav>


<form action="{{route('event.form')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="relative">
        <div class="absolute left-0 top-0 w-28 h-28 flex items-center justify-center z-10">
            Event Poster
        </div>
        <img id="photo_view" class="rounded w-28 h-28 border-2 z-20 relative" src="" alt="">
        <label for="photo" class="cursor-pointer group w-28">
            <div class="bg-white p-2 w-28 rounded-lg border-2 border-teal-500 left-1/2 group-hover:bg-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
            </svg>
            </div>
        </label>
        <input type="file" name="flyer" id="photo" class="hidden" required accept="image/*">
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-5">
        <div class="mb-5">
            <label
            for="text"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >
            Event Name
            </label>
            <input
            value=""
            type="text"
            name="name"
            id="text"
            required
            placeholder="ex: Purwokerto Art Fest"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
        </div>
        <div>
        <label
            for="text"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >
            Event Date
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input required id="datepicker-actions" name="date" datepicker datepicker-buttons datepicker-autoselect-today type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-3 " placeholder="Event Date">
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 my-3">
        <div class="w-1/2">

            <label for="event_start" class="block mb-2 text-sm font-medium text-gray-900 ">Event Start</label>
            <div class="relative">
                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <input type="time" id="event_start" name="event_start" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" required />
            </div>
        </div>

        <div class="w-1/2">

            <label for="event_end" class="block mb-2 text-sm font-medium text-gray-900 ">Event End</label>
            <div class="relative">
                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <input type="time" id="event_end" name="event_end" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3" required />
            </div>
        </div>

    </div>

    <div class="mb-5">
        
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Description
        </label>
        <textarea required id="description" name="description" rows="4" 
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="ex: Event nananananan Yang nananananana Jangan Sampai nanananana"></textarea>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-5">
        <div class="mb-5">
            <label
            for="place_name"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >
            Tempat
            </label>
            <input
            value=""
            type="text"
            name="place_name"
            id="place_name"
            required
            placeholder="ex: Gor Satria Purwokerto"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
        </div>
    </div>
    <div class="mb-5">
        
        <label for="place_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Alamat
        </label>
        <textarea required id="place_address" name="place_address" rows="4" 
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="ex: Event nananananan Yang nananananana Jangan Sampai nanananana"></textarea>
    </div>

    <div class="mb-5">
        
        <label for="inputArea" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Guest Stars
        </label>
        <textarea id="inputArea" name="" rows="1" 
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="ex: Hindia"></textarea>
            <p class="text-xs mt-1 text-gray-500">*Tekan enter setelah selesai input guest star</p>
            <div id="output" class="my-3 flex flex-wrap"></div>
    </div>

    <div>
        <label for="inputArea" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Lokasi Event
        </label>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <div id="map" style="height: 500px; width: 100%;"></div>
        <input required type="hidden" id="latitude" name="place_location[latitude]">
        <input required type="hidden" id="longitude" name="place_location[longitude]">
    </div>

    <div class="flex w-full mt-5">
    <button
    class="hover:bg-teal-400 w-full rounded-md bg-teal-500 py-3 px-8 text-center text-base font-semibold text-white outline-none"
    >
    Save Change
    </button>
    </div>


    
</form>



<script src="/assets/js/datepickers.js"></script>
<script>
    document.getElementById('photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo_view').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
        const inputArea = document.getElementById('inputArea');
        const output = document.getElementById('output');

        inputArea.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Mencegah newline di textarea
                const value = inputArea.value.trim();
                if (value) {
                    const containerDiv = document.createElement('div');
                    containerDiv.className = 'flex justify-center items-center group p-2';

                    const newInput = document.createElement('input');
                    newInput.type = 'text';
                    newInput.name = 'guest_stars[]';
                    newInput.value = value;
                    newInput.className = 'bg-blue-100 border-0 text-sm rounded-lg group-hover:bg-red-100 cursor-pointer w-fit';

                    const deleteIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    deleteIcon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                    deleteIcon.setAttribute('fill', 'none');
                    deleteIcon.setAttribute('viewBox', '0 0 24 24');
                    deleteIcon.setAttribute('stroke-width', '1.5');
                    deleteIcon.setAttribute('stroke', 'currentColor');
                    deleteIcon.setAttribute('class', 'size-6 -ml-10 cursor-pointer');
                    deleteIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    `;

                    deleteIcon.addEventListener('click', function() {
                        containerDiv.remove();
                    });

                    containerDiv.appendChild(newInput);
                    containerDiv.appendChild(deleteIcon);
                    output.appendChild(containerDiv);

                    inputArea.value = ''; // Kosongkan textarea untuk input berikutnya
                }
            }
        });
    </script>

<script>
  var map = L.map('map').setView([-7.614529, 110.712246], 8);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
  }).addTo(map);

  var marker;

  map.on('click', function(e) {
    if (marker) {
      marker.setLatLng(e.latlng);
    } else {
      marker = L.marker(e.latlng).addTo(map);
    }
    document.getElementById("latitude").value = e.latlng.lat;
    document.getElementById("longitude").value = e.latlng.lng;
  });
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@endsection