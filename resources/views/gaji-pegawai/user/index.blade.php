@extends('gaji-pegawai.layout.app', ['title' => 'User'])
@push('style')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endpush
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->jabatan ?? 'Admin' }}</td>
                                <td>
                                    <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal"
                                        data-target="#user-{{ $user->id }}" data-toggle="tooltip" title="Ubah Password">
                                        <span>
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </button>
                                    <div class="modal fade" id="user-{{ $user->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="user-{{ $user->id }}-label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="user-{{ $user->id }}-label">Edit User
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ url()->to("gaji-pegawai/data-master/users/$user->id/change-password") }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="section-title mt-0">Password Baru</div>
                                                            <div class="input-group mb-2">
                                                                <input type="password" class="form-control"
                                                                    autocomplete="current-password" required
                                                                    name="new_password" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="section-title mt-0">Komfirmasi Password</div>
                                                            <div class="input-group mb-2">
                                                                <input type="password" class="form-control"
                                                                    name="new_password_confirmation" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary mr-1" type="submit"
                                                                name="submit">
                                                                Simpan
                                                            </button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Data kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    @if ($errors->any())
        <script type='text/javascript'>
            setTimeout(function() {
                swal({
                    title: 'warning',
                    text: 'Oops, Password gagal diupdate!',
                    type: 'warning',
                    icon: 'warning',
                    timer: 3000,
                    buttons: false
                });
            }, 10);
        </script>
    @endif
    @if (session()->has('success'))
        <script type='text/javascript'>
            setTimeout(function() {
                swal({
                    title: 'success',
                    text: 'Password berhasil diupdate',
                    type: 'success',
                    icon: 'success',
                    timer: 3000,
                    buttons: false
                });
            }, 10);
        </script>
    @endif
@endpush
