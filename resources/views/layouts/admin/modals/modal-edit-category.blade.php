@foreach ($category as $ctg)
    <div class="modal fade" id="editModal{{ $ctg->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModal{{ $ctg->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $ctg->id }}Label">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.update', $ctg->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name-category" class="col-form-label">Name Category</label>
                            <input type="text" class="form-control" id="edit-name-category" name="name"
                                value="{{ $ctg->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="slug-category" class="col-form-label">Slug:</label>
                            <input type="text" class="form-control " id="edit-slug" name="slug" required readonly
                                style="cursor: not-allowed" value="{{ $ctg->slug }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var editTitle = document.getElementById("edit-name-category");
        var slugEdit = document.getElementById("edit-slug");

        if (editTitle && slugEdit) {
            editTitle.addEventListener("change", function() {
                fetch("/categori/checkSlug?name=" + encodeURIComponent(editTitle.value))
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then((data) => (slug.value = data.slugEdit))
                    .catch((error) => {
                        console.error("Error fetching slug:", error);
                        alert("Gagal membuat slug. Silakan coba lagi.");
                    });
            });
        }
    });
</script>
