@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            
            <div class="row align-items-center mb-4">
                <div class="col">
                    @php
                        /** @var \App\Models\User|null $user */
                        $user = Auth::user();
                    @endphp
                    <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Welcome, {{ $user?->name ?? 'Guest' }}</h2>
                    <p class="text-muted mb-0">Here's what's happening with your documents today.</p>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center">
                        <div class="dropdown mr-2">
                            <button class="btn btn-sm btn-white border shadow-sm dropdown-toggle" type="button" id="dateRangeButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 0.5rem; padding: 0.5rem 1rem;">
                                <i class="fe fe-calendar text-primary mr-2"></i> 
                                <span class="text-muted font-weight-medium">Today</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dateRangeButton">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Custom Range...</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-light border shadow-sm rounded-circle p-2 mx-1" style="width: 38px; height: 38px;" title="Refresh">
                            <i class="fe fe-refresh-ccw text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-light border shadow-sm rounded-circle p-2 mx-1" style="width: 38px; height: 38px;" title="Filter">
                            <i class="fe fe-filter text-muted"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Widgets -->
            <div class="row mb-4">
                
                <!-- Draft Documents Widget -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card shadow-sm border-0 position-relative overflow-hidden" style="border-radius: 1rem; background: linear-gradient(135deg, #ffffff 0%, #fffbeb 100%);">
                        <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.1; transform: rotate(15deg);">
                            <i class="fe fe-file-text" style="font-size: 8rem; color: #f59e0b;"></i>
                        </div>
                        <div class="card-body p-4 position-relative z-index-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted font-weight-bold text-uppercase mb-0" style="letter-spacing: 0.5px; font-size: 0.75rem;">Draft Documents</h6>
                                <div class="icon-shape bg-warning text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                                    <i class="fe fe-edit-3 fe-20"></i>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: #1f2937;">{{ $countDraftDocuments }}</h2>
                                    <div class="d-flex align-items-center mt-2">
                                        <span class="badge badge-pill badge-warning-light text-warning px-2 py-1 mr-2" style="background-color: #fef3c7;">
                                            <i class="fe fe-clock mr-1"></i> Pending
                                        </span>
                                        <span class="text-muted small">Awaiting submission</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px; border-radius: 0 0 1rem 1rem;">
                            <div class="progress-bar bg-warning" role="progressbar" @style(['width: ' . ($totalDocs > 0 ? ($countDraftDocuments / $totalDocs) * 100 : 0) . '%']) aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <!-- Uploaded Documents Widget -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card shadow-sm border-0 position-relative overflow-hidden" style="border-radius: 1rem; background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);">
                        <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.1; transform: rotate(-10deg);">
                            <i class="fe fe-check-circle" style="font-size: 8rem; color: #10b981;"></i>
                        </div>
                        <div class="card-body p-4 position-relative z-index-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted font-weight-bold text-uppercase mb-0" style="letter-spacing: 0.5px; font-size: 0.75rem;">Uploaded Documents</h6>
                                <div class="icon-shape bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                                    <i class="fe fe-upload-cloud fe-20"></i>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: #1f2937;">{{ $countUploadedDocuments }}</h2>
                                    <div class="d-flex align-items-center mt-2">
                                        <span class="badge badge-pill badge-success-light text-success px-2 py-1 mr-2" style="background-color: #d1fae5;">
                                            <i class="fe fe-arrow-up-right mr-1"></i> Active
                                        </span>
                                        <span class="text-muted small">Successfully processed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px; border-radius: 0 0 1rem 1rem;">
                            <div class="progress-bar bg-success" role="progressbar" @style(['width: ' . ($totalDocs > 0 ? ($countUploadedDocuments / $totalDocs) * 100 : 0) . '%']) aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <!-- Total Documents Widget -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 position-relative overflow-hidden" style="border-radius: 1rem; background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);">
                        <div class="position-absolute" style="top: -20px; right: -20px; opacity: 0.1; transform: rotate(5deg);">
                            <i class="fe fe-layers" style="font-size: 8rem; color: #3b82f6;"></i>
                        </div>
                        <div class="card-body p-4 position-relative z-index-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted font-weight-bold text-uppercase mb-0" style="letter-spacing: 0.5px; font-size: 0.75rem;">Total Documents</h6>
                                <div class="icon-shape bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                                    <i class="fe fe-database fe-20"></i>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: #1f2937;">{{ $totalDocs }}</h2>
                                    <div class="d-flex align-items-center mt-2">
                                        <span class="badge badge-pill badge-primary-light text-primary px-2 py-1 mr-2" style="background-color: #dbeafe;">
                                            <i class="fe fe-bar-chart-2 mr-1"></i> Overall
                                        </span>
                                        <span class="text-muted small">Across all statuses</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress" style="height: 4px; border-radius: 0 0 1rem 1rem;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

            </div> <!-- end widgets -->

            <!-- Main Chart Area (Keeping existing calendar placeholder) -->
            <div class="row my-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 1rem; overflow: hidden;">
                        <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0 font-weight-bold text-dark">Activity Overview</h5>
                        </div>
                        <div class="card-body">
                            <div id="calender" class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection