@extends('layouts.admin.app')

@section('content')
    @if (session('success'))
        <div class=" alert-success">{!! session('success') !!}</div>
    @endif

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <button type="button" class="btn mb-2 btn-primary" data-toggle="modal" data-target="#varyModal"
            data-whatever="@mdo">Create Status</button>
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Status Documents</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($status as $sts)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><span class="badge badge-pill badge-success">{{ $sts->name }}</span></td>
                                <td>{{ $sts->desc }}</td>
                                <td> {{ $sts->public_view == 1 ? 'Public' : 'Private' }}
                                    {{-- <div class="form-check form-switch">
                                        <form action="" method="POST" id="statusForm">
                                            @csrf
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" name="public_view"
                                                @if ($sts->public_view == 1) checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckChecked" id="statusLabel">
                                                @if ($sts->public_view == 1)
                                                    Public
                                                @else
                                                    Private
                                                @endif
                                            </label>
                                        </form>
                                    </div> --}}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#editModal{{ $sts->id }}"><i class="fe fe-edit"></i>Edit</a>
                                    <!-- Tambahkan tombol hapus dengan konfirmasi -->
                                    <form method="POST" action="{{ route('status.destroy', $sts->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')"><i
                                                class="fe fe-trash"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- simple table -->
    @include('layouts.admin.modals.modal-create-status')
    @include('layouts.admin.modals.modal-edit-status')

    {{-- <script>
        $(document).ready(function() {
            $('#flexSwitchCheckChecked').change(function() {
                var public_view = $(this).prop('checked') ? 1 : 0; // Mengambil nilai checkbox (1 atau 0)

                $.ajax({
                    url: "{{ route('status.update', $sts->id) }}", // URL untuk route update
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // CSRF token untuk keamanan
                        _method: 'PUT', // Laravel menggunakan PUT untuk update
                        status: public_view, // Kirim status (1 atau 0) untuk update kolom public_view
                        // Jika Anda memerlukan data lain, pastikan untuk menambahkannya di sini, misalnya:
                        // name: 'Nama Status',
                        // desc: 'Deskripsi Status',
                    },
                    success: function(response) {
                        if (public_view === 1) {
                            $('#statusLabel').text('Public');
                        } else {
                            $('#statusLabel').text('Private');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Lihat detail error dari server
                    }
                });
            });
        });
    </script> --}}
@endsection
