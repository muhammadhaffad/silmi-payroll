@extends('gaji-pegawai.layout.app', ['title' => 'Lembur Reward Cicilan'])
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 ">
            <div class="card-header-action">
                <h3>Data Lembur Reward Cicilan</h3>
                <!-- <button class="btn btn-info text-right btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i> &nbsp; <span>Tambah Data</span></button> -->
                <button class="btn btn-success btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal3"
                    data-toggle="tooltip" title="Tambah Data"><i class="fas fa-upload"></i> &nbsp; <span>Upload File
                        Excel</span></button>
                <a href="delete.php?all=all" class="btn btn-danger btn-xs delete-data mr-1" title="hapus"><i
                        class="fas fa-trash-alt"></i> &nbsp; Hapus Semua</a>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Lembur</th>
                            <th>Reward</th>
                            <th>Cicilan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>207</td>
                            <td>Karyawan 1</td>
                            <td>IT Support</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/lembur-reward-cicilan/207/edit') }}" class="btn btn-primary btn-xs btn-action mr-1"
                                    title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/lembur-reward-cicilan/207/remove') }}" class="btn btn-danger btn-xs delete-data mr-1"
                                    title="hapus"><i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>

                    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel3" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Upload Data Lewat Excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="section-title">Upload File Excel</div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file form-control" name="namafile">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary mr-1" type="submit"
                                                name="uploadexcel">Simpan</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
@endsection
