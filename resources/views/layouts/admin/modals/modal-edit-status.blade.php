@foreach ($status as $sts)
    <div class="modal fade" id="editModal{{ $sts->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModal{{ $sts->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $sts->id }}Label">Edit Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('status.update', $sts->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name-status" class="col-form-label">Name Status</label>
                            <input type="text" class="form-control" id="name-status" name="name"
                                value="{{ $sts->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="desc-status" class="col-form-label">Description:</label>
                            <input type="text" class="form-control" id="desc-status" name="desc"
                                value="{{ $sts->desc }}" required>
                        </div>
                        <div class="form-group d-flex flex-row gap-5">
                            <label for="desc-status" class="colform-label me-2">Set Public / Private:</label>
                            <input type="checkbox" role="switch" id="flexSwitchCheckChecked" name="public_view"
                                {{ $sts->public_view == 1 ? 'checked' : '' }}>
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
