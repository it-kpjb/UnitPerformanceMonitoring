<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">New Status Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('status.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name-status" class="col-form-label">Name Status</label>
                        <input type="text" class="form-control" id="name-status" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="desc-status" class="col-form-label">Description:</label>
                        <input type="text" class="form-control" id="desc-status" name="desc" required>
                    </div>
                    <div class="form-group d-flex flex-row gap-5">
                        <label for="desc-status" class="colform-label me-2">Set Public / Private:</label>
                        <input type="checkbox" role="switch" id="flexSwitchCheckChecked" name="public_view">
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
