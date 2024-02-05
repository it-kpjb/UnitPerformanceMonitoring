@extends('layouts.admin.app')

@section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Welcome {{ Auth::user()->name }}</h2>
                </div>
                <div class="col-auto">
                  <form class="form-inline">
                    <div class="form-group d-none d-lg-inline">
                      <label for="reportrange" class="sr-only">Date Ranges</label>
                      <div id="reportrange" class="px-2 py-2 text-muted">
                        <span class="small"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                      <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- widgets -->
              <div class="row my-4">
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Draft Documents</small>
                          <h3 class="card-title mb-0">{{ $countDraftDocuments }}</h3>
                        </div>
                        <div class="col-4 text-right">
                          <span class="badge badge-warning"><i class="fe fe-file-text fe-24"></i></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Uploaded Documents</small>
                          <h3 class="card-title mb-0">{{ $countUploadedDocuments }}</h3>
                          <!-- <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-success"></span><span>Uploaded Documents</span></p> -->
                        </div>
                        <div class="col-4 text-right">
                          <span class="badge badge-success"><i class="fe fe-file-text fe-24"></i></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Total Documents</small>
                          <h3 class="card-title mb-0">{{ $totalDocs }}</h3>
                          <!-- <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-success"></span><span>Uploaded Documents</span></p> -->
                        </div>
                        <div class="col-4 text-right">
                          <span class="badge badge-info"><i class="fe fe-file-text fe-24"></i></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- end section -->
              <!-- linechart -->
              <div class="my-4">
                <div id="calender"></div>
              </div>
@endsection