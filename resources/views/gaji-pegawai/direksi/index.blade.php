@extends('gaji-pegawai.layout.app', ['title' => 'Direksi'])
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Direksi</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header-action">
                <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal"
                    data-toggle="tooltip" title="Tambah Data"><span>Tambah Data Direksi</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Gaji</th>
                            <th>Gaji Tambahan</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Karyawan 1</td>
                            <td>Laki-laki</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <a href="{{ url()->to('/gaji-pegawai/data-master/direksi/1/edit') }}"
                                    class="btn btn-primary btn-xs btn-action mr-1" title="Edit">
                                    <i class="fas fa-edit">
                                    </i>
                                </a>
                                <a href="{{ url()->to('/gaji-pegawai/data-master/direksi/1/remove') }}"
                                    class="btn btn-danger btn-xs delete-data mr-1" title="hapus"><i
                                        class="fas fa-trash-alt">
                                    </i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- MODAL -->

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Direksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <div class="section-title mt-0">Nama</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" placeholder="Masukan Nama Direksi"
                                                name="nama" required>
                                        </div>
                                    </div>
                                    <div class="widget-body mt-3">
                                        <div class="section-tittle mt-0">Jenis Kelamin </div>
                                        <div class="form-group">
                                            <select class="custom-select" name="jenis_kelamin">
                                                <option disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki - Laki">Laki - Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="section-title mt-0">Gaji</div>
                                        <div class="input-group mb-2">
                                            <input type="number" class="form-control" name="gaji" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="section-title mt-0">Gaji Tambahan</div>
                                        <div class="input-group mb-2">
                                            <input type="number" class="form-control" name="gajitambahan" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                    </div>
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
                            title: 'Suksess',
                            text: 'Data Berhasil Disimpan $nama',
                            type: 'success',
                            icon: 'success',
                            timer: 3000,
                            buttons: false
                        });
                    }, 10);
                    window.setTimeout(function() {
                        window.location.replace('index.php');
                    }, 3000);
                </script>
            @endif
            </section>
        </div>

    </div>
@endsection
