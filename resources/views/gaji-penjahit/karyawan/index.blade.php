@extends('gaji-penjahit.layout.app', ['title' => 'Data Karyawan'])
@section('content')
    <h3>Data Karyawan</h3>
    <div class="card">
        <div class="card-header d-flex">
            <div class="form-group w-100 pr-2">
                <label for="inputNama">Tambah Karyawan</label>
                <input type="text" class="form-control" id="inputNama" placeholder="Masukan nama">
            </div>
            <div class="form-group mt-auto">
                <button type="button" class="btn btn-primary text-nowrap">+ Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Cicilan</th>
                            <th>Bubut</th>
                            <th>Infaq</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>AZIZAH</td>
                            <td>{{ Helper::rupiah(1000000) }}</td>
                            <td>{{ Helper::rupiah(1000000) }}</td>
                            <td>{{ Helper::rupiah(1000000) }}</td>
                            <td class="d-flex">
                                <button class="btn btn-primary btn-xs btn-action mr-1" title="Edit" data-toggle="modal" data-target="#editDataJahit-1">
                                    <i class="fas fa-edit">
                                    </i>
                                </button>
                                <button class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <div class="modal fade" id="editDataJahit-1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jahit</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group w-100 pr-2">
                                                    <label for="inputNamaModal">Nama</label>
                                                    <input type="text" class="form-control" id="inputNamaModal" placeholder="Masukan nama karyawan">
                                                </div>
                                                <div class="form-group w-100 pr-2">
                                                    <label for="inputCicilanModel">Cicilan</label>
                                                    <input type="number" class="form-control" id="inputCicilanModel" placeholder="Nominal Cicilan">
                                                </div>
                                                <div class="form-group w-100 pr-2">
                                                    <label for="inputBubutModal">Bubut</label>
                                                    <input type="number" class="form-control" id="inputBubutModal" placeholder="Nominal bubut">
                                                </div>
                                                <div class="form-group w-100 pr-2">
                                                    <label for="inputInfaqModal">Infaq</label>
                                                    <input type="number" class="form-control" id="inputInfaqModal" placeholder="Nominal infaq">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="button" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
