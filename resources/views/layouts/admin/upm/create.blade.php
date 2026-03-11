@extends('layouts.admin.app')

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-12">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Create Document Control</h2>
            <p class="text-muted mb-0">Fill out the form below to create a new Unit Performance Monitoring document.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="card-title mb-0 font-weight-bold text-dark">Document Information</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('docsMon.store') }}" method="POST" enctype="multipart/form-data" id="documentForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label for="dm_number" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">DM Number <span class="text-danger">*</span></label>
                        <input type="text" id="dm_number" name="dm_number" class="form-control" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="e.g. DM-2023-001" required>
                    </div>
                    <div class="col-md-6 form-group mb-4">
                        <label for="user" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">User <span class="text-danger">*</span></label>
                        <input type="text" id="user" name="user" class="form-control" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="Enter user name" required>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="subject" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Subject <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="subject" id="subject" rows="3" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="Brief description of the document..." required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group mb-4">
                        <label for="date-input1" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Document Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control drgpicker" name="tgldoc" id="date-input1" aria-describedby="button-addon-date" style="border-radius: 0.5rem 0 0 0.5rem; border: 1px solid #e5e7eb;" required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-white" id="button-addon-date" style="border-radius: 0 0.5rem 0.5rem 0; border: 1px solid #e5e7eb; border-left: 0;"><span class="fe fe-calendar text-primary"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 form-group mb-4">
                        <label for="category_id" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control custom-select" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" required>
                            <option value="" disabled selected>Select category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group mb-4">
                        <label for="status_id" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Status <span class="text-danger">*</span></label>
                        <select name="status_id" id="status_id" class="form-control custom-select" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" required>
                            <option value="" disabled selected>Select status...</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group mb-5">
                    <label for="files" class="font-weight-bold text-secondary d-block" style="font-size: 0.85rem;">Attachments <span class="text-danger">*</span></label>
                    <div class="custom-file mb-2">
                        <input type="file" name="files[]" id="files" class="custom-file-input" accept=".pdf,.doc,.docx" multiple required>
                        <label class="custom-file-label" for="files" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; color: #6b7280;">Choose files (PDF, DOC/X)...</label>
                    </div>
                    <small class="text-muted mt-1"><i class="fe fe-info mr-1"></i>You can select multiple files at once.</small>
                </div>

                <hr class="my-4" style="border-color: #f3f4f6;">

                <div class="d-flex justify-content-end align-items-center" style="gap: 12px;">
                    <a href="{{ route('docsMon.index') }}" class="btn btn-light px-4" style="border-radius: 0.5rem; color: #4b5563; font-weight: 500; border: 1px solid #e5e7eb; transition: 0.2s;">{{ __('Cancel') }}</a>
                    <button id="submitBtn" type="submit" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500; transition: 0.2s; position: relative; min-width: 120px;">
                        <span class="submit-text">{{ __('Submit Document') }}</span>
                        <span id="loadingIndicator" style="display: none; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ubah label input file agar dinamis 
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                let filesCount = $(this)[0].files.length;
                let labelText = filesCount > 1 ? filesCount + ' files selected' : (fileName || 'Choose files...');
                $(this).next('.custom-file-label').addClass("selected").html(labelText);
            });

            // Menangani klik pada tombol submit
            document.getElementById('documentForm').addEventListener('submit', function(event) {
                // Tampilkan indikator loading dan sembunyikan teks submit
                document.getElementById('loadingIndicator').style.display = 'inline-block';
                document.querySelector('.submit-text').style.opacity = '0';
                
                // Menonaktifkan tombol submit
                document.getElementById('submitBtn').disabled = true;
                
                // Form tetap dapat di-submit meskipun disabled diset (karena di-set setelah event di-trigger)
            });
        });
    </script>
@endsection
