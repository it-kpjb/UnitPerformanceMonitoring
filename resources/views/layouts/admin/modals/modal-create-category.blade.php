<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">New Category Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name-category" class="col-form-label">Name Category</label>
                        <input type="text" class="form-control" id="name-category" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="slug-category" class="col-form-label">Slug:</label>
                        <input type="text" class="form-control " id="slug" name="slug" required
                            style="cursor: not-allowed" readonly>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn mb-2 btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var title = document.getElementById("name-category");
        var slug = document.getElementById("slug");

        if (title && slug) {
            title.addEventListener("change", function() {
                fetch("/categori/checkSlug?name=" + encodeURIComponent(title.value))
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then((data) => (slug.value = data.slug))
                    .catch((error) => {
                        console.error("Error fetching slug:", error);
                        alert("Gagal membuat slug. Silakan coba lagi.");
                    });
            });
        }
    });
</script>
