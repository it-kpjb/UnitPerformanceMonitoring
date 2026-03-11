@extends('layouts.admin.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible bg-white text-success border-0 shadow-sm fade show mb-4" role="alert" style="border-radius: 0.75rem; border-left: 4px solid #10b981 !important;">
            <i class="fe fe-check-circle mr-2"></i> {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-top: 0.8rem;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Status Documents</h2>
            <p class="text-muted mb-0">Manage and configure available document statuses</p>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary px-4 shadow-sm" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo" style="border-radius: 0.5rem; font-weight: 500;">
                <i class="fe fe-plus mr-1"></i> Create Status
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem; overflow: hidden;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4">
                    <h5 class="card-title mb-0 font-weight-bold text-dark" style="font-size: 1.1rem;">Status List</h5>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-nowrap">
                        <thead class="bg-light" style="border-bottom: 2px solid #e5e7eb;">
                            <tr>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">#</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">Name</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">Description</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">Visibility</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0 text-right" style="font-size: 0.75rem; padding: 1rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="border-top: none;">
                            @forelse ($status as $sts)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td class="align-middle text-muted" style="padding: 1rem;">{{ $loop->iteration }}</td>
                                    <td class="align-middle" style="padding: 1rem;">
                                        <span class="badge badge-pill border px-3 py-2" style="background-color: #f0fdf4; color: #166534; border-color: #bbf7d0 !important; font-weight: 600;">
                                            {{ $sts->name }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-muted" style="padding: 1rem;">
                                        {{ $sts->desc ?: '-' }}
                                    </td>
                                    <td class="align-middle" style="padding: 1rem;">
                                        @if($sts->public_view == 1)
                                            <span class="d-inline-flex align-items-center text-primary" style="font-weight: 500;">
                                                <i class="fe fe-globe mr-1"></i> Public
                                            </span>
                                        @else
                                            <span class="d-inline-flex align-items-center text-secondary" style="font-weight: 500;">
                                                <i class="fe fe-lock mr-1"></i> Private
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-right" style="padding: 1rem;">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-light border py-1 px-2 text-muted" style="border-radius: 0.4rem 0 0 0.4rem; border-color: #e5e7eb;" data-toggle="modal" data-target="#editModal{{ $sts->id }}" title="Edit">
                                                <i class="fe fe-edit-2"></i>
                                            </button>
                                            <form method="POST" action="{{ route('status.destroy', $sts->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this status?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border border-left-0 py-1 px-2 text-danger" style="border-radius: 0 0.4rem 0.4rem 0; border-color: #e5e7eb;" title="Delete">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <div class="mb-3"><i class="fe fe-layers fe-32 text-light"></i></div>
                                        <p class="mb-0">No document statuses found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.admin.modals.modal-create-status')
    @include('layouts.admin.modals.modal-edit-status')

@endsection
