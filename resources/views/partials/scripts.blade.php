<script>
    function movieCrud() {
        return {
            // --- Modal Control ---
            createModalOpen: false,
            editModalOpen: false,
            viewModalOpen: false,
            deleteModalOpen: false,

            // --- Data Properties ---
            selectedMovieId: null,
            movieDetails: {},
            editFormData: {},
            deleteFormAction: '',

            // --- Init Function ---
            init() {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 5000);
                }

                // --- THIS IS THE FIX FOR YOUR VALIDATION ERRORS ---
                // If the page reloads with errors, reopen the correct modal.
                @if ($errors->any())
                    @if (session('form_type') === 'edit')
                        // If edit failed, reopen edit modal
                        this.openEditModal({{ session('movie_id', 'null') }});
                    @else
                        // If create failed, reopen create modal
                        this.openCreateModal();
                    @endif
                @endif
            },

            // --- Modal Functions ---
            openCreateModal() {
                this.editFormData = {}; // Clear form data
                this.createModalOpen = true;
            },

            async openViewModal(id) {
                this.selectedMovieId = id;
                await this.fetchMovieDetails(id);
                this.viewModalOpen = true;
            },

            async openEditModal(id) {
                this.selectedMovieId = id;
                await this.fetchEditData(id);
                this.editModalOpen = true;
            },

            openDeleteModal(id) {
                this.selectedMovieId = id;
                this.deleteFormAction = `/movies/${id}`;
                this.deleteModalOpen = true;
            },

            // --- Data Fetching Functions ---
            async fetchMovieDetails(id) {
                try {
                    const response = await fetch(`/movies/${id}`);
                    if (!response.ok) throw new Error('Movie not found');
                    this.movieDetails = await response.json();
                } catch (error) {
                    console.error('Error fetching movie details:', error);
                }
            },

            async fetchEditData(id) {
                try {
                    // Use the same route as your controller's show() method
                    const response = await fetch(`/movies/${id}`);
                    if (!response.ok) throw new Error('Movie not found');
                    this.editFormData = await response.json();
                } catch (error) {
                    console.error('Error fetching movie data for edit:', error);
                }
            }
        };
    }
</script>
