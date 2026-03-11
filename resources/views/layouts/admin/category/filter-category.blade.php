@extends('layouts.admin.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible bg-white text-success border-0 shadow-sm fade show" role="alert" style="border-radius: 0.75rem; border-left: 4px solid #10b981 !important;">
            <i class="fe fe-check-circle mr-2"></i> {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-top: 0.8rem;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Unit Performance Monitoring</h2>
            <p class="text-muted mb-0">Filtered document views based on categories</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('docsMon.create') }}" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500;">
                <i class="fe fe-plus mr-1"></i> Add Document
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem; overflow: hidden;">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 font-weight-bold text-dark" style="font-size: 1.1rem;">Filtered Documents</h5>
                    <form action="{{ route('docsMon.index') }}" method="GET" class="form-inline">
                        <div class="input-group input-group-sm" style="width: 280px;">
                            <input type="text" class="form-control" name="search" placeholder="Search documents..." value="{{ request('search') }}" style="border-radius: 0.5rem 0 0 0.5rem; background: #f8f9fa; border: 1px solid #e5e7eb;">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" style="border-radius: 0 0.5rem 0.5rem 0;"><span class="fe fe-search"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-nowrap">
                        <thead class="bg-light" style="border-bottom: 2px solid #e5e7eb;">
                            <tr>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">#</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">DM Number</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem; max-width: 250px;">Subject</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">User / Date</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">Status</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">Files</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0 text-right" style="font-size: 0.75rem; padding: 1rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="border-top: none;">
                            @forelse ($docs as $doc)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td class="align-middle text-muted" style="padding: 1rem;">{{ $loop->iteration + ($docs->currentPage() - 1) * $docs->perPage() }}</td>
                                    <td class="align-middle" style="padding: 1rem;">
                                        <span class="font-weight-bold text-dark">{{ $doc->dm_number }}</span>
                                    </td>
                                    <td class="align-middle text-truncate" style="padding: 1rem; max-width: 250px;" title="{{ $doc->subject }}">
                                        {{ $doc->subject }}
                                    </td>
                                    <td class="align-middle" style="padding: 1rem;">
                                        <div class="d-flex flex-column">
                                            <span class="text-dark" style="font-weight: 500;">{{ $doc->user }}</span>
                                            <small class="text-muted"><i class="fe fe-calendar mr-1"></i>{{ \Carbon\Carbon::parse($doc->tgldoc)->format('d M Y') }}</small>
                                        </div>
                                    </td>
                                    <td class="align-middle" style="padding: 1rem;">
                                        @if ($doc->status->name == 'Approved')
                                            <span class="badge badge-pill text-white px-3 py-1" style="background-color: #10b981; font-weight: 500;">{{ $doc->status->name }}</span>
                                        @else
                                            <span class="badge badge-pill text-white px-3 py-1" style="background-color: #6b7280; font-weight: 500;">{{ $doc->status->name }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle" style="padding: 1rem;">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border dropdown-toggle d-flex align-items-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="gap: 5px; border-radius: 0.4rem; border-color: #e5e7eb;">
                                                <i class="fe fe-paperclip text-muted"></i> 
                                                <span class="badge badge-primary badge-pill">{{ count($doc->files) }}</span>
                                            </button>
                                            <div class="dropdown-menu shadow-sm border-0" style="border-radius: 0.5rem; min-width: 260px; z-index: 1050;">
                                                <h6 class="dropdown-header font-weight-bold text-dark pb-1">Attached Files</h6>
                                                @if(count($doc->files) > 0)
                                                    @foreach ($doc->files as $file)
                                                        <a class="dropdown-item d-flex flex-column py-2 border-bottom" href="{{ asset('storage/attachments/' . $file->attachment_path) }}" target="_blank">
                                                            <div class="d-flex align-items-center mb-1">
                                                                <i class="fe fe-file-text text-primary mr-2"></i> 
                                                                <span class="text-truncate" style="max-width: 200px; font-weight: 500;">{{ $file->attachment_path }}</span>
                                                            </div>
                                                            <small class="text-muted ml-4" style="font-size: 0.7rem;">Updated: {{ \Carbon\Carbon::parse($file->updated_at)->diffForHumans() }}</small>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <span class="dropdown-item text-muted disabled py-2">No files attached</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-right" style="padding: 1rem;">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border bg-white rounded-circle p-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 32px; height: 32px; border-color: #e5e7eb;">
                                                <i class="fe fe-more-vertical text-muted"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" style="border-radius: 0.5rem;">
                                                <a class="dropdown-item text-secondary py-2" href="{{ route('docsMon.edit', encrypt($doc->id)) }}">
                                                    <i class="fe fe-edit-2 mr-2"></i> Edit
                                                </a>
                                                <div class="dropdown-divider my-1"></div>
                                                <form method="POST" action="{{ route('docsMon.destroy', encrypt($doc->id)) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger py-2 btn-delete" type="button">
                                                        <i class="fe fe-trash-2 mr-2"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <div class="mb-3"><i class="fe fe-filter fe-32 text-light"></i></div>
                                        <p class="mb-0">No documents found matching this filter.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer bg-white border-top-0 py-3 d-flex align-items-center justify-content-between p-4" style="border-top: 1px solid #f3f4f6 !important;">
                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        Showing <span class="font-weight-bold text-dark">{{ $docs->firstItem() ?? 0 }}</span> to <span class="font-weight-bold text-dark">{{ $docs->lastItem() ?? 0 }}</span> of <span class="font-weight-bold text-dark">{{ $docs->total() }}</span> results
                    </p>
                    <nav aria-label="Table Paging">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $currentPage == 1 ? '#' : route('docsMon.index', ['page' => $currentPage - 1, 'search' => request('search')]) }}" style="border-radius: 0.4rem 0 0 0.4rem;">Previous</a>
                            </li>
                            
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('docsMon.index', ['page' => $i, 'search' => request('search')]) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="page-item {{ $currentPage == $totalPages || $totalPages == 0 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $currentPage == $totalPages || $totalPages == 0 ? '#' : route('docsMon.index', ['page' => $currentPage + 1, 'search' => request('search')]) }}" style="border-radius: 0 0.4rem 0.4rem 0;">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteBtns = document.querySelectorAll('.btn-delete');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if(confirm('Are you sure you want to delete this document? This action cannot be undone.')) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection
