{{-- View Movie Modal --}}
<div x-show="viewModalOpen" x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        {{-- Background overlay --}}
        <div x-show="viewModalOpen" @click="viewModalOpen = false"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true">
        </div>

        {{-- Modal panel --}}
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="viewModalOpen"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-gray-800 shadow-xl rounded-2xl">

            <div class="flex justify-between items-center pb-3 border-b border-gray-700">
                <h3 class="text-2xl font-bold text-white" x-text="movieDetails.title"></h3>
                <button @click="viewModalOpen = false" class="text-gray-400 hover:text-white">&times;</button>
            </div>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <img class="w-full rounded-lg shadow-lg" :src="movieDetails.poster_image ? '/storage/' + movieDetails.poster_image : 'https://placehold.co/300x450/374151/e5e7eb?text=Poster'" alt="Poster">
                </div>
                <div class="md:col-span-2 text-gray-300">
                    <h4 class="text-lg font-semibold text-white mb-2">Description</h4>
                    <p x-text="movieDetails.synopsis"></p>

                    <h4 class="text-lg font-semibold text-white mt-4 mb-2">Details</h4>
                    <ul>
                        <li><strong>Genre:</strong> <span x-text="movieDetails.genre"></span></li>
                        <li><strong>Release Date:</strong> <span x-text="movieDetails.release_date"></span></li>
                        <li><strong>Rating:</strong> <span x-text="movieDetails.rating"></span> / 5.0</li>
                    </ul>
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="button" @click="viewModalOpen = false"
                        class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
