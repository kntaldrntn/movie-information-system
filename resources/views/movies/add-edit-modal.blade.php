{{-- Add/Edit Movie Modal --}}
<div x-show="createModalOpen || editModalOpen" x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        {{-- Background overlay --}}
        <div @click="createModalOpen = false; editModalOpen = false"
             class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true">
        </div>

        {{-- Modal panel --}}
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-gray-800 shadow-xl rounded-2xl">

            <h3 class="text-2xl font-bold text-white"
                x-text="editModalOpen ? 'Edit Movie' : 'Add New Movie'">
            </h3>

            <form :action="editModalOpen ? '/movies/' + selectedMovieId : '/movies'" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
                @csrf
                {{-- Add PUT method for editing --}}
                <template x-if="editModalOpen">
                    @method('PUT')
                </template>

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                    <input type="text" name="title" id="title" :value="editModalOpen ? editFormData.title : ''"
                           class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                              x-text="editModalOpen ? editFormData.description : ''"></textarea>
                </div>

                {{-- Other fields... (e.g., Rating, Genre) --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-300">Rating (0-5)</label>
                        <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" :value="editModalOpen ? editFormData.rating : ''"
                               class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="genre" class="block text-sm font-medium text-gray-300">Genre</label>
                        <input type="text" name="genre" id="genre" :value="editModalOpen ? editFormData.genre : ''"
                               class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                {{-- Poster Image --}}
                <div>
                    <label for="poster_image" class="block text-sm font-medium text-gray-300">Poster Image</label>
                    <input type="file" name="poster_image" id="poster_image"
                           class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                </div>

                {{-- Form Buttons --}}
                <div class="pt-4 flex justify-end space-x-3">
                    <button type="button" @click="createModalOpen = false; editModalOpen = false"
                            class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700"
                            x-text="editModalOpen ? 'Save Changes' : 'Add Movie'">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
