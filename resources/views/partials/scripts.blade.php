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
            movieDetails: {}, // Holds data for the view modal
            editFormData: {}, // Holds data for the edit form
            deleteFormAction: '', // Holds the URL for the delete form

            // --- Init Function ---
            // Runs when the component is first loaded
            init() {
                // Auto-dismiss the success alert after 5 seconds
                const alert = document.getElementById('success-alert');
                if (alert) {
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 5000);
                }
            },

            // --- Modal Functions ---
            openCreateModal() {
                this.createModalOpen = true;
            },

            async openViewModal(id) {
                this.selectedMovieId = id;
                await this.fetchMovieDetails(id); // Fetch data
                this.viewModalOpen = true;
            },

            async openEditModal(id) {
                this.selectedMovieId = id;
                await this.fetchEditData(id); // Fetch data
                this.editModalOpen = true;
            },

            openDeleteModal(id) {
                this.selectedMovieId = id;
                // Set the form's action URL dynamically
                this.deleteFormAction = `/movies/${id}`;
                this.deleteModalOpen = true;
            },

            // --- Data Fetching Functions ---
            // These functions assume you have routes set up to return JSON data
            async fetchMovieDetails(id) {
                try {
                    // IMPORTANT: You must create this route in web.php
                    const response = await fetch(`/movies/${id}`);
                    if (!response.ok) throw new Error('Movie not found');
                    this.movieDetails = await response.json();
                } catch (error) {
                    console.error('Error fetching movie details:', error);
                    // Handle error (e.g., show a toast notification)
                }
            },

            async fetchEditData(id) {
                try {
                    // IMPORTANT: You can reuse the same JSON route
                    const response = await fetch(`/movies/${id}/json`);
                    if (!response.ok) throw new Error('Movie not found');
                    this.editFormData = await response.json();
                } catch (error) {
                    console.error('Error fetching movie data for edit:', error);
                }
            }
        };
    }
</script>
