@extends('layouts.admin.app')

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-12">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Edit Document Control</h2>
            <p class="text-muted mb-0">Update information for document <strong class="text-primary">{{ $doc->dm_number }}</strong>.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="card-title mb-0 font-weight-bold text-dark">Document Information</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('docsMon.update', encrypt($doc->id)) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label for="dm_number" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">DM Number <span class="text-danger">*</span></label>
                        <input type="text" name="dm_number" id="dm_number" class="form-control" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" value="{{ old('dm_number', $doc->dm_number) }}" required>
                    </div>
                    <div class="col-md-6 form-group mb-4">
                        <label for="user" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">User <span class="text-danger">*</span></label>
                        <input type="text" name="user" id="user" class="form-control" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" value="{{ old('user', $doc->user) }}" required>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="subject" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Subject <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="subject" id="subject" rows="3" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" required>{{ $doc->subject }}</textarea>
                </div>

                <div class="row border-bottom pb-4 mb-4">
                    <div class="col-md-4 form-group mb-0">
                        <label for="date-input1" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Document Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control drgpicker" name="tgldoc" id="date-input1" aria-describedby="button-addon-date" value="{{ old('tgldoc', \Carbon\Carbon::parse($doc->tgldoc)->format('m/d/Y')) }}" style="border-radius: 0.5rem 0 0 0.5rem; border: 1px solid #e5e7eb;" required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-white" id="button-addon-date" style="border-radius: 0 0.5rem 0.5rem 0; border: 1px solid #e5e7eb; border-left: 0;"><span class="fe fe-calendar text-primary"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 form-group mb-0">
                        <label for="category_id" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control custom-select" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == $doc->category_id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group mb-0">
                        <label for="status_id" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Status <span class="text-danger">*</span></label>
                        <select name="status_id" id="status_id" class="form-control custom-select" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @if ($status->id == $doc->status_id) selected @endif>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-secondary d-block mb-2" style="font-size: 0.85rem;">Existing Files</label>
                            @if(count($doc->files) > 0)
                                <ul class="list-group list-group-flush" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; overflow: hidden;">
                                    @foreach ($doc->files as $file)
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3" style="font-size: 0.85rem;">
                                            <div class="text-truncate mr-2">
                                                <i class="fe fe-file-text text-primary mr-2"></i> {{ $file->attachment_path }}
                                            </div>
                                            <a href="{{ asset('storage/attachments/' . $file->attachment_path) }}" target="_blank" class="btn btn-sm btn-light py-0 px-2 text-muted" title="View/Download"><i class="fe fe-external-link"></i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="px-3 py-2 bg-light rounded text-muted" style="font-size: 0.85rem; border: 1px dashed #ced4da;">No existing files attached.</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-4 pb-2">
                            <label for="files" class="font-weight-bold text-secondary d-block mb-2" style="font-size: 0.85rem;">Upload New Files <span class="text-muted font-weight-normal">(Optional)</span></label>
                            <div class="custom-file mb-1">
                                <input type="file" name="files[]" id="files" class="custom-file-input" accept=".pdf,.doc,.docx" multiple>
                                <label class="custom-file-label" for="files" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Choose new files...</label>
                            </div>
                            <small class="text-muted"><i class="fe fe-info mr-1"></i>Uploading new files will keep the existing ones.</small>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: #f3f4f6;">

                <div class="d-flex justify-content-end align-items-center" style="gap: 12px;">
                    <a href="{{ route('docsMon.index') }}" class="btn btn-light px-4 text-muted" style="border-radius: 0.5rem; font-weight: 500; border: 1px solid #e5e7eb; transition: 0.2s;">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500; transition: 0.2s;">
                        <i class="fe fe-save mr-2"></i> {{ __('Update Document') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pilihan file label logic dinamis
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            let filesCount = $(this)[0].files.length;
            let labelText = filesCount > 1 ? filesCount + ' files selected' : (fileName || 'Choose new files...');
            $(this).next('.custom-file-label').addClass("selected").html(labelText);
        });
    });
</script>
@endsection
