@extends('layouts.admin.app')

@section('content')
@if(session('success'))
  <div class=" alert-success">{!! session('success') !!}</div>
@endif

 <!-- simple table -->
<div class="col-md-6 my-4">
    <button type="button" class="btn mb-2 btn-primary" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">Create Category</button>
                  <div class="card shadow">
                    <div class="card-body">
                      <h5 class="card-title">Category Documents</h5>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($category as $sts)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><span class="badge badge-pill badge-success">{{ $sts->name }}</span></td>
                            <td>{{ $sts->desc }}</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $sts->id }}"><i class="fe fe-edit"></i>Edit</a>
                            <!-- Tambahkan tombol hapus dengan konfirmasi -->
                            <form method="POST" action="{{ route('category.destroy', $sts->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fe fe-trash"></i>Delete</button>
                            </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- simple table -->
@include('layouts.admin.modals.modal-create-category')
@include('layouts.admin.modals.modal-edit-category')
@endsection
