@extends('layouts.admin.app')

@section('content')

@if(session('success'))
  <div class=" alert-success">{!! session('success') !!}</div>
@endif
<div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">Unit Permormance Monitoring</h2>
                  <!-- <p class="mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. At est delectus minus tempore quidem, natus earum suscipit autem magnam esse et blanditiis id, fuga molestiae voluptas quae eaque. Odio, corrupti.</p> -->
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form class="form-inline">
                            <div class="form-row">
                              <!-- <div class="form-group col-auto">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" class="form-control" id="search" value="" placeholder="Search">
                              </div> -->
                              <div class="mb-2">
                              <form action="{{ route('docsMon.index') }}" method="GET">
                                  <input type="text" class="form-control" name="search" placeholder="Search...">
                                  <button type="submit" class="btn btn-sm  btn-outline-primary"><span class="fe fe-search fe-16 mr-2"></span>Search</button>
                              </form>
                              </div>

                             
                            </div>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                          <a class="btn btn-primary float-right ml-3" href="{{ route('docsMon.create') }}">Add more +</a>
                          </div>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-bordered">
                        <thead>
                          <tr role="row">
                            <th>#</th>
                            <th>DM Number</th>
                            <th>Subject</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Status Doc</th>
                            <th>Document</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($docs as $doc)
                          <tr>
                          <td>{{ $loop->iteration }}</td>
                            <td>{{$doc->dm_number}}</td>
                            <td>{{$doc->subject}}</td>
                            <td>{{$doc->user}}</td>
                            <td>{{$doc->tgldoc}}</td>
                            <td>
                              <form method="POST" action="{{ route('docsMon.updateStatus', ['id' => $doc->id]) }}">
                                  @csrf
                                  @method('PUT') <!-- Atau bisa menggunakan @method('PUT') -->

                                  <!-- Menambahkan input untuk memilih status baru -->
                                  <select name="status_id" class="d">
                                      @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" @if($status->id == $doc->status_id) selected @endif>{{ $status->name }}</option>
                                      @endforeach
                                  </select>

                                  <button type="submit" class="btn btn-sm btn-secondary" >Update Status</button>
                              </form>
                            </td>
                            <td>
                            @foreach($doc->files as $file)
                                <a href="{{ asset('storage/attachments/' . $file->attachment_path) }}" target="_blank">Unduh File</a>
                                <br>
                                <small>Last Updated: {{ \Carbon\Carbon::parse($file->updated_at)->diffForHumans() }}</small>
                                <br>
                            @endforeach
                            </td>
                            <td>
                              <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">Action</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('docsMon.edit', encrypt($doc->id)) }}">Edit</a>
                                <form method="POST" action="{{ route('docsMon.destroy', encrypt($doc->id)) }}" >
                                  @csrf
                                      @method('DELETE')
                                      <button class="dropdown-item" type="submit" onclick="return confirm('Do You Want Delete?')">Remove</button>
                                      
                                  </form>
                              </div>
                            </td>
                          @endforeach
                        </tbody>
                      </table>
                      <p>
                          Showing {{ $docs->firstItem() }} to {{ $docs->lastItem() }} of {{ $docs->total() }} results
                      </p>
                      <nav aria-label="Table Paging" class="mb-0 text-muted">
                        <ul class="pagination justify-content-end">
                          <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $currentPage == 1 ? '#' : route('docsMon.index', ['page' => $currentPage - 1]) }}">Previous</a>
                          </li>
                          @for ($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                              <a class="page-link" href="{{ route('docsMon.index', ['page' => $i]) }}">{{ $i }}</a>
                            </li>
                          @endfor
                          <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $currentPage == $totalPages ? '#' : route('docsMon.index', ['page' => $currentPage + 1]) }}">Next</a>
                          </li>
                        </ul>
                      </nav>
                
                    </div>
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->
@endsection
