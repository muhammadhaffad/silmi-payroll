@extends('gaji-pegawai.layout.app', ['title' => 'Data Lembur (Sales)'])
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 ">
            <div class="card-header-action">
                <h3>Data Lembur (SALES)</h3>
                <button class="btn btn-info text-right btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal"
                    data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i><span>Tambah Data</span></button>
                <a href="delete.php" class="btn btn-danger btn-xs delete-data mr-1" title="hapus"><i
                        class="fas fa-trash-alt"></i>Hapus Semua</a>
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
                            <th>Perjam</th>
                            <th>Jam Lembur</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>207</td>
                            <td>Karyawan 1</td>
                            <td>IT Support</td>
                            <td>
                                {{ Helper::rupiah(200000) }}
                            </td>
                            <td>{{ 7 }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/lembur-sales/1/edit') }}" class="btn btn-primary btn-xs btn-action mr-1"
                                    title="Edit"><i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/lembur-sales/1/remove') }}" class="btn btn-danger btn-xs delete-data mr-1"
                                    title="hapus"><i class="fas fa-trash-alt"></i>
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
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="section-title mt-0">Nama Karyawan </div>
                                <div class="input-group mb-2">
                                    <form action="#" method="POST" class="w-100">
                                        <select class="form-control" id="karyawan1" name="nip" required>
                                            <option disabled selected> Pilih Karyawan</option>
                                            <option value="207">Karyawan 1 - IT Support</option>
                                        </select>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Perjam</div>
                                            <div class="input-group mb-2" id="perjam">
                                                <input type="text" value="Didapatkan dari select karyawan"
                                                    class="form-control" name="perjam" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Jam Lembur</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="jamlembur" required>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary mr-1" type="submit"
                                                name="simpan">Simpan</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
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
            </div>
        </div>
    @endsection
