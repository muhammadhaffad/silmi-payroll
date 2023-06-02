@extends('gaji-penjahit.layout.app', ['title' => 'Data Jahit'])
@section('content')
    <h3>Data Jahit</h3>
    <div class="card">
        <form action="{{route('data-master.jahit.create')}}" method="post">
        <div class="card-header d-flex">
            @csrf
            <div class="form-group w-100 pr-2">
                <label for="inputNama">Nama</label>
                <input required name="nama" type="text" class="form-control" id="inputNama" placeholder="Masukan nama">
            </div>
            <div class="form-group w-100 pr-2">
                <label for="inputJahit">Jahit</label>
                <input required name="jahit" type="number" class="form-control" id="inputJahit" placeholder="Nominal jahit">
            </div>
            <div class="form-group w-100 pr-2">
                <label for="inputOrbas">Orbas</label>
                <input required name="obras" type="number" class="form-control" id="inputOrbas" placeholder="Nominal orbas">
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
                            <th>Jahit</th>
                            <th>Orbas</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sewings as $sewing)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$sewing->nama}}</td>
                            <td>{{ Helper::rupiah($sewing->jahit) }}</td>
                            <td>{{ Helper::rupiah($sewing->obras) }}</td>
                            <td>{{ Helper::rupiah($sewing->total) }}</td>
                            <td class="d-flex">
                                <button class="btn btn-primary btn-xs btn-action mr-1" title="Edit" data-toggle="modal" data-target="#editDataJahit-{{$sewing->id}}">
                                    <i class="fas fa-edit">
                                    </i>
                                </button>
                                <form action="{{route('data-master.jahit.delete', ['id' => $sewing->id])}}" method="post" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?')">
                                @csrf
                                <button class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                </form>
                                <div class="modal fade" id="editDataJahit-{{$sewing->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <form action="{{route('data-master.jahit.update', ['id' => $sewing->id])}}" method="post">
                                        @csrf
                                        @method('PUT')
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
                                                        <label for="inputNama">Nama</label>
                                                        <input required name="nama" type="text" class="form-control" id="inputNama" value="{{$sewing->nama}}" placeholder="Masukan nama">
                                                    </div>
                                                    <div class="form-group w-100 pr-2">
                                                        <label for="inputJahit">Jahit</label>
                                                        <input required name="jahit" type="number" class="form-control" id="inputJahit" value="{{$sewing->jahit}}" placeholder="Nominal jahit">
                                                    </div>
                                                    <div class="form-group w-100 pr-2">
                                                        <label for="inputOrbas">Orbas</label>
                                                        <input required name="obras" type="number" class="form-control" id="inputOrbas" value="{{$sewing->obras}}" placeholder="Nominal orbas">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" align="center">Data Kosong...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
