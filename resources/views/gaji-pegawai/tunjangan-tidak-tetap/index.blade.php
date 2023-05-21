@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tidak Tetap'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="h3 mb-2 text-gray-800">Data Tunjungan Tidak Tetap</h1>
            <div class="card-header-action">
                <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal4"
                    data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i> <span>Tambah
                        Tunjangan</span></button>
                <button class="btn btn-info btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal3"
                    data-toggle="tooltip" title="Tambah Data"><i class="fas fa-user-clock"></i> <span>Tambah Data
                        Perjam</span></button>
                <!-- <button class="btn btn-success btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal5" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-download fa-sm text-white-50"></i> Download Data</button> -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <span>Data perjam Otomatis Akan Hilang 28 hari Setelah Proses Input Data</span>
                <table class="table table-bordered mt-3" id="dataTable" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nip</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan Jabatan</th>
                            <th>Perjam</th>
                            <th>Total Tunjangan Tetap</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>207</td>
                            <td>Karyawan 1</td>
                            <td class="text-nowrap">IT Support</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(300000) }}</td>
                            <td>{{ Helper::rupiah(0) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td class="d-flex">
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/tidak-tetap/207/show') }}"
                                    class="btn btn-success btn-xs  btn-action mr-1 mt-3" title="Lihat Detail Perjam"><i
                                        class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/tidak-tetap/207/edit') }}" class="btn btn-primary btn-xs btn-action mr-1 mt-3"
                                    title="Edit"><i class="fas fa-edit"></i>
                                </a>
                                <a href="delete.php?id=<?= '' ?>" class="btn btn-danger btn-xs delete-data mr-1 mt-3"
                                    title="Hapus"><i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- MODAL -->

            <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah Tunjangan Tetap</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="perjam" action="" method="POST">
                            <div class="modal-body">
                                <div class="section-title mt-0">Nama Karyawan </div>
                                <div class="input-group mb-2">
                                    <select class="form-control selectpicker" name="karyawan" title="pilih karyawan" data-live-search="true" required>
                                        <option value="207">Karyawan 1 - IT Support</option>
                                        <option value="208">Karyawan 2 - IT Support</option>
                                        <option value="209">Karyawan 3 - IT Support</option>
                                    </select type="text/javascript">
                                </div>
                                <div class="form-group">
                                    <div class="section-title mt-0">Gaji Pokok</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="gaji_pokok" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="section-title mt-0">Tunjangan Jabatan</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="t_jabatan" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary mr-1" type="submit" name="submittp">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL -->

        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Upload Data Perjam</h5>
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
                                <button class="btn btn-primary mr-1" type="submit" name="uploadexcel">Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (false)
        <script type='text/javascript'>
            setTimeout(function() {
                swal({
                    title: 'Suksess',
                    text: 'Data Berhasil Disimpan',
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
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endpush