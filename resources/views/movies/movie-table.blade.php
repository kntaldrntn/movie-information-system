{{-- Movie Collection Grid --}}
<div class="bg-gray-950 shadow-xl rounded-xl overflow-hidden">

    {{-- Dashboard Controls (Search & Filter) --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 px-6 pt-6 pb-4 border-b border-gray-800">

        <div class="relative w-full md:w-1/3">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
            </span>
            <input type="text" name="search"
                   class="w-full pl-10 pr-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Search movies...">
        </div>

        <div class="flex items-center gap-4">
            <select name="sort_by" class="bg-gray-800 border border-gray-700 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Sort by...</option>
                <option value="title_asc">Title (A-Z)</option>
                <option value="title_desc">Title (Z-A)</option>
                <option value="rating_desc">Rating (High-Low)</option>
                <option value="rating_asc">Rating (Low-High)</option>
            </select>

            <select name="genre" class="bg-gray-800 border border-gray-700 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>All Genres</option>
                <option value="action">Action</option>
                <option value="comedy">Comedy</option>
                <option value="drama">Drama</option>
                <option value="horror">Horror</option>
            </select>
        </div>
    </div>

    {{-- Responsive Grid Container --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 p-6">

        @forelse ($movies as $movie)
            <div class="relative group bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:scale-105 hover:z-20 hover:shadow-cyan-900/50">

                {{-- Poster Image & Link --}}
                <div class="relative">
                    <a @click.prevent="openViewModal({{ $movie->id }})" href="#" class="cursor-pointer">
                        <img class="w-full object-cover aspect-[2/3] transition-transform duration-300 group-hover:scale-110"
                             src="{{ $movie->poster_image ? asset('storage/' . $movie->poster_image) : 'https://placehold.co/300x450/374151/e5e7eb?text=Poster' }}"
                             alt="Poster for {{ $movie->title }}">
                        <div class="absolute inset-0 shadow-[inset_0_-80px_60px_-30px_rgba(0,0,0,0.8)]"></div>
                    </a>
                </div>

                {{-- Content Panel --}}
                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-900/70 backdrop-blur-sm transition-all duration-300 ease-in-out transform translate-y-[calc(100%-80px)] group-hover:translate-y-0">

                    {{-- This clickable title fixes the "view not working" issue --}}
                    <h3 @click="openViewModal({{ $movie->id }})"
                        class="text-lg font-semibold text-white truncate h-12 flex items-center cursor-pointer hover:text-blue-300 transition-colors"
                        title="{{ $movie->title }}">
                        {{ $movie->title }}
                    </h3>

                    {{-- Hidden Content (Revealed on hover) --}}
                    <div class="pt-3 border-t border-gray-700/50 mt-3">

                        {{-- Rating --}}
                        <div class="flex items-center mb-3">
                            @php
                                $rating = $movie->rating;
                                $starPath = "M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z";
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($rating >= $i)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="{{ $starPath }}" /></svg>
                                @elseif ($rating >= $i - 0.5)
                                    <div class="relative"><svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="{{ $starPath }}" /></svg><div class="absolute top-0 left-0 w-1/2 overflow-hidden"><svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="{{ $starPath }}" /></svg></div></div>
                                @else
                                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="{{ $starPath }}" /></svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-sm font-bold text-white">{{ number_format($movie->rating, 1) }}</span>
                        </div>

                        {{-- Buttons (Modern, solid style) --}}
                        <div class="flex items-center space-x-2">
                            <button @click="openEditModal({{ $movie->id }})" class="flex-1 flex items-center justify-center px-3 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                                Edit
                            </button>
                            <button @click="openDeleteModal({{ $movie->id }})" class="flex-1 flex items-center justify-center px-3 py-2 bg-gray-700 rounded-md text-sm font-medium text-white hover:bg-gray-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State (Matches new darker theme) --}}
            <div class="col-span-full text-center py-16 text-gray-500">
                <div class="flex flex-col items-center">
                    <svg class="w-16 h-16 text-gray-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" /></svg>
                    <p class="text-lg font-medium mb-1 text-gray-300">No movies found</p>
                    <p>Get started by <a @click.prevent="openCreateModal()" href="#" class="text-blue-500 hover:underline font-medium">adding a new movie</a>!</p>
                </div>
            </div>
        @endforelse

    </div>

    {{-- Pagination Links (Updated for dark theme) --}}
    @if ($movies->hasPages())
        <div class="px-6 py-4 bg-gray-900 border-t border-gray-700">
            {{ $movies->links() }}
        </div>
    @endif
</div>
