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
                                  <label for="desc-category" class="col-form-label">Description:</label>
                                  <input type="text" class="form-control" id="desc-category" name="desc" required>
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
