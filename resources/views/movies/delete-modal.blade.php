{{-- Delete Confirmation Modal --}}
<div x-show="deleteModalOpen" x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <div @click="deleteModalOpen = false"
             class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true">
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-gray-800 shadow-xl rounded-2xl">

            <h3 class="text-2xl font-bold text-white">Delete Movie</h3>
            <p class="mt-2 text-gray-300">Are you sure you want to delete this movie? This action cannot be undone.</p>

            <form :action="deleteFormAction" method="POST" class="mt-6 flex justify-end space-x-3">
                @csrf
                @method('DELETE')

                <button type="button" @click="deleteModalOpen = false"
                        class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
