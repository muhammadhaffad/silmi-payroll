@extends('gaji-penjahit.layout.app', ['title' => 'Kompensasi Kasus'])
@section('content')
    <h3>Kompensasi Kasus</h3>
    <div class="card">
        <div class="card-header d-flex">
            <div class="form-group w-100 pr-2">
                <label for="inputMin">Minimal %</label>
                <input type="number" class="form-control" id="inputMin" placeholder="Masukan nilai minimal">
            </div>
            <div class="form-group mt-auto pr-2">
                {{-- <label for="inclusiveMin">Operator</label> --}}
                <select id="inclusiveMin" class="form-control w-auto selectpicker">
                    <option>≤</option>
                    <option><</option>
                </select>
            </div>
            <div class="form-group mt-auto pr-2">
                {{-- <label for="inclusiveMin">Operator</label> --}}
                <div class="form-control text-nowrap">[INPUT]</div>
            </div>
            <div class="form-group mt-auto pr-2">
                {{-- <label for="inclusiveMin">Operator</label> --}}
                <select id="inclusiveMin" class="form-control w-auto selectpicker">
                    <option>≤</option>
                    <option><</option>
                </select>
            </div>
            <div class="form-group w-100 pr-2">
                <label for="inputMax">Maksimal %</label>
                <input type="number" class="form-control" id="inputMax" placeholder="Masukan nilai maksimal">
            </div>
            <div class="form-group w-100 pr-2">
                <label for="inputKompensasi">Kompensasi %</label>
                <input type="number" class="form-control" id="inputKompensasi" placeholder="Kompensasi">
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
                            <th class="w-100">Aturan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="d-flex">
                                    <div class="form-group mb-0 w-100 pr-2">
                                        <input type="number" class="form-control" id="inputMin" placeholder="Masukan nilai minimal">
                                    </div>
                                    <div class="form-group mb-0 mt-auto pr-2">
                                        {{-- <label for="inclusiveMin">Operator</label> --}}
                                        <select id="inclusiveMin" class="form-control w-auto selectpicker">
                                            <option>≤</option>
                                            <option><</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0 mt-auto pr-2">
                                        {{-- <label for="inclusiveMin">Operator</label> --}}
                                        <div class="form-control text-nowrap">[INPUT]</div>
                                    </div>
                                    <div class="form-group mb-0 mt-auto pr-2">
                                        {{-- <label for="inclusiveMin">Operator</label> --}}
                                        <select id="inclusiveMin" class="form-control w-auto selectpicker">
                                            <option>≤</option>
                                            <option><</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0 w-100 pr-2">
                                        <input type="number" class="form-control" id="inputMax" placeholder="Masukan nilai maksimal">
                                    </div>
                                    <span class="pt-2 pr-2">=</span>
                                    <div class="form-group mb-0 w-100 pr-2">
                                        <input type="number" class="form-control" id="inputKompensasi" placeholder="Kompensasi">
                                    </div>
                                </div>
                            </td>
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
                                                    <input type="text" class="form-control" id="inputNamaModal" placeholder="Masukan nama">
                                                </div>
                                                <div class="form-group w-100 pr-2">
                                                    <label for="inputHargaModal">Harga</label>
                                                    <input type="number" class="form-control" id="inputHargaModal" placeholder="Nominal harga">
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
