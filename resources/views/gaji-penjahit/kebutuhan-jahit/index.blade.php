@extends('gaji-penjahit.layout.app', ['title' => 'Data Jahit'])
@section('content')
    <h3>Data Kebutuhan Jahit</h3>
    <div class="card">
        <form action="{{route('data-master.kebutuhan-jahit.create')}}" method="post">
        @csrf
            <div class="card-header d-flex">
                <div class="form-group w-100 pr-2">
                    <label for="inputNama">Nama</label>
                    <input required name="nama" type="text" class="form-control" id="inputNama" placeholder="Masukan nama">
                </div>
                <div class="form-group w-100 pr-2">
                    <label for="inputHarga">Harga</label>
                    <input required name="harga" type="number" class="form-control" id="inputHarga" placeholder="Nominal Harga">
                </div>
                <div class="form-group mt-auto">
                    <button type="submit" class="btn btn-primary text-nowrap">+ Tambah</button>
                </div>
            </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sewingSupplies as $sewingSupply)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$sewingSupply->nama}}</td>
                            <td>{{ Helper::rupiah($sewingSupply->harga) }}</td>
                            <td class="d-flex">
                                <button class="btn btn-primary btn-xs btn-action mr-1" title="Edit" data-toggle="modal" data-target="#editDataJahit-{{$sewingSupply->id}}">
                                    <i class="fas fa-edit">
                                    </i>
                                </button>
                                <form action="{{route('data-master.kebutuhan-jahit.delete', ['id' => $sewingSupply->id])}}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                    @csrf
                                    <button class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <div class="modal fade" id="editDataJahit-{{$sewingSupply->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jahit</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('data-master.kebutuhan-jahit.update', ['id' => $sewingSupply->id])}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group w-100 pr-2">
                                                        <label for="inputNamaModal">Nama</label>
                                                        <input name="nama" required type="text" class="form-control" id="inputNamaModal" value="{{$sewingSupply->nama}}" placeholder="Masukan nama">
                                                    </div>
                                                    <div class="form-group w-100 pr-2">
                                                        <label for="inputHargaModal">Harga</label>
                                                        <input name="harga" required type="number" class="form-control" id="inputHargaModal" value="{{$sewingSupply->harga}}" placeholder="Nominal harga">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <td colspan="4" align="center">Data Kosong...</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
