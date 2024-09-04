@extends('users.navigation')
@section('content')
@php
    $user = auth()->user();
@endphp
<h1 class="text-lg font-bold flex items-center">
    <span>Organization</span>
    @if ($user->organizations)
    <div class="ms-2">
        @if ($user->organizations->isVerify == "unverify")
        
        <span class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
            Unverified
        </span>
        
        @elseif ($user->organizations->isVerify == "verify")
        
        <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
            Verified
        </span>

        @else

        <span class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
            Pending Verified
        </span>

        @endif
    </div>
    @endif

</h1>

<form id="myForm" enctype="multipart/form-data" action="{{route('organization.form')}}" method="post" class="mb-6">
    @csrf
    <div class="relative">
        <img id="photo_view" class="mx-auto rounded w-28 h-28 border-4" src="{{ $user->organizations ? $user->organizations->photo : '' }}" alt="">
        <label for="photo" class="cursor-pointer group">
            <div class="bg-white w-fit p-2 rounded-full border-2 border-teal-500 absolute bottom-0 left-1/2 ml-5 group-hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
            </div>
        </label>
        <input type="file" name="photo" id="photo" class="hidden" required accept="image/*">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="mb-5">
            <label
            for="text"
            class="mb-3 block text-base font-medium text-[#07074D]"
            >
            Nama Organisasi
            </label>
            <input
            value="{{ $user->organizations ? $user->organizations->name : '' }}"
            type="text"
            name="name"
            id="text"
            required
            placeholder="ex: Purwokerto Art Fest"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
        </div>
    </div>
    <div class="mb-5">
        
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Description
        </label>
        <textarea required id="description" name="description" rows="4" 
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="ex: Event Organizer yang bergerak di bidang Konser dan Event yang berlokasi di Purwokerto">{{ $user->organizations ? $user->organizations->description : '' }}</textarea>

    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="mb-5">
            <label
            for="text"
            class="mb-3 block text-base font-medium text-[#07074D]"
            >
            Contact Person Name
            </label>
            <input
            value="{{ $user->organizations ? $user->organizations->cp_name : '' }}"
            type="text"
            name="cp_name"
            id="text"
            required
            placeholder="ex: Suheri Sardi"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
        </div>
        <div class="mb-5">
            <label
            for="text"
            class="mb-3 block text-base font-medium text-[#07074D]"
            >
            Contact Person Phone
            </label>
            <input
            value="{{ $user->organizations ? $user->organizations->cp_phone : '' }}"
            type="number"
            name="cp_phone"
            required
            id="text"
            placeholder="ex: 628121212112"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
        </div>
    </div>
    <div class="mb-5">
        
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Organization Address
        </label>
        <textarea required id="address" name="address" rows="4" 
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="ex: Jl. Akbardokoni Purwokerto, Jawa Tengah">{{ $user->organizations ? $user->organizations->address : '' }}</textarea>

    </div>
    <div class="flex w-full">
    <button
    class="hover:bg-teal-400 w-full rounded-md bg-teal-500 py-3 px-8 text-center text-base font-semibold text-white outline-none"
    >
    Save Change
    </button>
    </div>
</form>

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
document.getElementById('myForm').addEventListener('submit', function(event) {
    // Prevent form submission to validate fields first
    event.preventDefault();
    
    // Get all required fields
    var requiredFields = document.querySelectorAll('#myForm [required]');
    
    var missingFields = [];
    
    requiredFields.forEach(function(field) {
        if (!field.value) {
            missingFields.push(field.previousElementSibling.textContent.trim()); // Assumes label is right before input
        }
    });
    
    if (missingFields.length > 0) {
        // Show alert with missing fields
        alert('Please fill out the following required fields: ' + missingFields.join(', '));
    } else {
        // All required fields are filled, submit the form
        document.getElementById('myForm').submit();
    }
});
</script>
@endsection