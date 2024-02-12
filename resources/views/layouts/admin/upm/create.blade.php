@extends('layouts.admin.app')

@section('content')
<h2 class="page-title">Create Form Document Control</h2>
              <!-- <p class="text-muted">Demo for form control styles, layout options, and custom components for creating a wide variety of forms.</p> -->
              <div class="card shadow mb-4">
                <div class="card-header">
                  <strong class="card-title">Form Document</strong>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                    <form action="{{ route('docsMon.store') }}" method="POST" enctype="multipart/form-data" id="documentForm">
                      @csrf
                      <div class="form-group mb-3">
                        <label for="dm_number">DM Number</label>
                        <input type="text" id="dm_number" name="dm_number" class="form-control" required>
                      </div>
                      <div class="form-group mb-3">
                        <label for="subject">Subject</label>
                        <textarea class="form-control" name="subject" id="subject" rows="4" required></textarea>
                      </div>
                      <div class="form-group mb-3">
                        <label for="user">User</label>
                        <input type="text" id="user" name="user" class="form-control" required>
                      </div>
                      <div class="form-group mb-6">
                        <label for="date-input1">Date Picker</label>
                        <div class="input-group">
                          <input type="text" class="form-control drgpicker" name="tgldoc" id="date-input1" aria-describedby="button-addon2" required>
                          <div class="input-group-append">
                            <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                                <label for="status_id">{{ __('Status') }}</label>
                                <select name="status_id" class="form-control" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="files">{{ __('Files') }}</label>
                              <input type="file" name="files[]" class="form-control-file" accept=".pdf,.doc,.docx" multiple required>
                            </div>
                            
                            <div class="form-group">
                              <a href="{{ route('docsMon.index')}}" type="button" class="btn btn-danger">{{ __('Back') }}</a>
                              <button id="submitBtn" type="submit" class="btn btn-primary" style="position: relative;">
                                  <span id="loadingIndicator" style="display: none; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                                  </span>
                                  {{ __('Submit') }}
                              </button>
                          </div>
                    </form>
                    </div> <!-- /.col -->
                    </div>
                  </div>
                </div>
              </div> <!-- / .card -->
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menangani klik pada tombol submit
        document.getElementById('documentForm').addEventListener('submit', function(event) {
            // Tampilkan indikator loading
            document.getElementById('loadingIndicator').style.display = 'inline-block';
            // Menonaktifkan tombol submit
            document.getElementById('submitBtn').disabled = true;
        });
    });
</script>
@endsection