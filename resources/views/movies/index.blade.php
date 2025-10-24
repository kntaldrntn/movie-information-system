<x-app-layout>

@include('partials.header')

{{--
  - The dark background is applied globally from your <style> tag in partials.header
--}}
<body class="flex flex-col h-full" x-data="movieCrud()">

    <main class="flex-grow">
        <div class="container mx-auto p-4 sm:p-6 lg:p-8">

            {{-- Page Header Section --}}
            <header class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-500">Movie Dashboard</h1>
                    <p class="text-gray-400 mt-1">Manage your movie collection with ease.</p>
                </div>

                <div class="mt-4 sm:mt-0">
                    <button @click="openCreateModal()" class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Movie
                    </button>
                </div>
            </header>

            @if (session('success'))
                <x-alert type="success" class="mb-6" id="success-alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </x-alert>
            @endif

            @if ($errors->any())
                <x-alert type="error" class="mb-6">
                    <p class="font-bold">Please fix the following errors:</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif

            {{-- This is your new grid with the search bar --}}
            @include('movies.movie-table')

        </div>
    </main>

    {{-- These are the modals that the Alpine functions will show/hide --}}
    @include('movies.add-edit-modal')
    @include('movies.view-modal')
    @include('movies.delete-modal')

    @include('partials.footer')

    {{-- This file now contains your "existing functions" --}}
    @include('partials.scripts')
</body>
</x-layouts>
