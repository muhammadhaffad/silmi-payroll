@extends('gaji-pegawai.layout.app', ['title' => 'User'])
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
                        <tr>
                            <td>1</td>
                            <td>Administrator</td>
                            <td>admin</td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal"
                                    data-target="#exampleModal" data-toggle="tooltip" title="Ubah Password">
                                    <span>
                                        <i class="fas fa-key"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>
                    </tbody>

                    <!-- MODAL -->

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Password Baru</div>
                                            <div class="input-group mb-2">
                                                <input type="password" class="form-control" autocomplete="current-password"
                                                    required name="new_password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Komfirmasi Password</div>
                                            <div class="input-group mb-2">
                                                <input type="password" class="form-control" name="new_password_confirmation"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary mr-1" type="submit" name="submit">
                                                Simpan
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (false)
                        <script type='text/javascript'>
                            setTimeout(function() {
                                swal({
                                    title: 'warning',
                                    text: 'Kolom Password Kosong Mohon Di Isi Kembali',
                                    type: 'warning',
                                    icon: 'warning',
                                    timer: 3000,
                                    buttons: false
                                });
                            }, 10);
                            window.setTimeout(function() {
                                window.location.replace('index.php');
                            }, 3000);
                        </script>
                        <script type='text/javascript'>
                            setTimeout(function() {
                                swal({
                                    title: 'warning',
                                    text: 'Password Tidak Sama, Mohon Isi Kembali',
                                    type: 'warning',
                                    icon: 'warning',
                                    timer: 3000,
                                    buttons: false
                                });
                            }, 10);
                            window.setTimeout(function() {
                                window.location.replace('index.php');
                            }, 3000);
                        </script>
                    @endif
                </table>
            </div>
        </div>
    @endsection
