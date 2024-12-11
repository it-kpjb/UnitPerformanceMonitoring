@foreach ($category as $ctg)
    <div class="modal fade" id="editModal{{ $ctg->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $ctg->id }}Label" aria-hidden="true">
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
                            <input type="text" class="form-control" id="name-category" name="name" value="{{ $ctg->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="desc-category" class="col-form-label">Description:</label>
                            <input type="text" class="form-control" id="desc-category" name="desc" value="{{ $ctg->desc }}" required>
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
    </div>
@endforeach
