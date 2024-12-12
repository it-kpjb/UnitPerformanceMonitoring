@extends('layouts.admin.app')

@section('content')
    <h2 class="page-title">Edit Form Document Control</h2>
    <!-- <p class="text-muted">Demo for form control styles, layout options, and custom components for creating a wide variety of forms.</p> -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Form Document</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('docsMon.update', encrypt($doc->id)) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="dm_number">{{ __('DM Number') }}</label>
                            <input type="text" name="dm_number" class="form-control"
                                value="{{ old('dm_number', $doc->dm_number) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="subject">{{ __('Subject') }}</label>
                            <textarea class="form-control" name="subject" rows="4" required>{{ $doc->subject }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="user">{{ __('User') }}</label>
                            <input type="text" name="user" class="form-control" value="{{ old('user', $doc->user) }}"
                                required>
                        </div>


                        <div class="form-group mb-3">
                            <label for="date-input1">{{ __('Document Date') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control drgpicker" name="tgldoc" id="date-input1"
                                    aria-describedby="button-addon2"
                                    value="{{ old('tgldoc', \Carbon\Carbon::parse($doc->tgldoc)->format('m/d/Y')) }}"
                                    required>
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="category_id">{{ __('Category') }}</label>
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $doc->category_id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status_id">{{ __('Status') }}</label>
                            <select name="status_id" class="form-control" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @if ($status->id == $doc->status_id) selected @endif>
                                        {{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="existing_files">{{ __('Existing Files') }}</label>
                            <!-- Display existing files for reference -->
                            @foreach ($doc->files as $file)
                                <p>{{ $file->attachment_path }}</p>
                            @endforeach
                        </div>

                        <div class="form-group mb-3">
                            <label for="files">{{ __('Upload New Files (Optional)') }}</label>
                            <input type="file" name="files[]" class="form-control-file" accept=".pdf,.doc,.docx"
                                multiple>
                        </div>


                        <!-- You can add other form fields or customize as needed -->

                        <div class="form-group">
                            <a href="{{ route('docsMon.index') }}" type="button"
                                class="btn btn-danger">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
