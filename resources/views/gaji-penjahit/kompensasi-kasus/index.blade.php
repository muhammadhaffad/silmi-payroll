@extends('gaji-penjahit.layout.app', ['title' => 'Kompensasi Kasus'])
@section('content')
    <h3>Kompensasi Kasus</h3>
    <div class="card">
        <form action="{{route('pengaturan.kompensasi-kasus.create')}}" method="post">
            @csrf
            <div class="card-header d-flex">
                <div class="form-group w-100 pr-2">
                    <label for="inputMin">Minimal %</label>
                    <input name="min_cacat_persen" type="number" class="form-control" id="inputMin" placeholder="Masukan nilai minimal">
                </div>
                <div class="form-group mt-auto pr-2">
                    {{-- <label for="inclusiveMin">Operator</label> --}}
                    <select name="inclusive_min" id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option value="1">≤</option>
                        <option value="0"><</option>
                    </select>
                </div>
                <div class="form-group mt-auto pr-2">
                    {{-- <label for="inclusiveMin">Operator</label> --}}
                    <div class="p-2 text-nowrap">KASUS</div>
                </div>
                <div class="form-group mt-auto pr-2">
                    {{-- <label for="inclusiveMin">Operator</label> --}}
                    <select name="inclusive_maks" id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option value="1">≤</option>
                        <option value="0"><</option>
                    </select>
                </div>
                <div class="form-group w-100 pr-2">
                    <label for="inputMax">Maksimal %</label>
                    <input name="maks_cacat_persen" type="number" class="form-control" id="inputMax" placeholder="Masukan nilai maksimal">
                </div>
                <div class="form-group w-100 pr-2">
                    <label for="inputKompensasi">Kompensasi %</label>
                    <input name="kompensasi_persen" type="number" class="form-control" id="inputKompensasi" placeholder="Kompensasi">
                </div>
                <div class="form-group mt-auto">
                    <button type="submit" class="btn btn-primary text-nowrap">+ Tambah</button>
                </div>
            </div>
        </form>
        <div class="card-body">
            @foreach ($defectRules as $rule)
            <form id="update-rule-{{$rule->id}}" action="{{route('pengaturan.kompensasi-kasus.update', ['id'=>$rule->id])}}" method="post">
                @csrf
                @method('PUT')
            </form>
            <div class="d-flex">
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input form="update-rule-{{$rule->id}}" required name="min_cacat_persen" value="{{$rule->min_cacat_persen}}" type="number" min="0" class="form-control" placeholder="Masukan jumlah minimal">
                    </div>
                </div>
                <div class="form-group pr-2"> 
                    <select form="update-rule-{{$rule->id}}" required name="inclusive_min" id="inclusiveMin" class="form-control w-auto selectpicker">
                        <option value="1" @selected($rule->inclusive_min == 1)>≤</option>
                        <option value="0" @selected($rule->inclusive_min == 0)><</option>
                    </select>
                </div>
                <div class="form-group pr-2">
                    <div class="p-2 text-nowrap">JUMLAH</div>
                </div>
                <div class="form-group pr-2">
                    <select form="update-rule-{{$rule->id}}" required name="inclusive_maks" class="form-control w-auto selectpicker">
                        <option value="1" @selected($rule->inclusive_maks == 1)>≤</option>
                        <option value="0" @selected($rule->inclusive_maks == 0)><</option>
                    </select>
                </div>
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input form="update-rule-{{$rule->id}}" required name="maks_cacat_persen" value="{{$rule->maks_cacat_persen}}" type="number" min="0" class="form-control" placeholder="Masukan jumlah maksimal">
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group mr-2 w-100">
                    <div class="input-group">
                        <input form="update-rule-{{$rule->id}}" required name="kompensasi_persen" type="number" value="{{$rule->kompensasi_persen}}" min="0" class="form-control" placeholder="Masukan nilai kompensasi">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                          </div>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <button form="update-rule-{{$rule->id}}" type="submit" class="ml-auto btn btn-success text-nowrap mr-2" data-toggle="modal"
                        data-target="#edit-jahit-1">Update</button>
                    <form action="{{route('pengaturan.kompensasi-kasus.remove', ['id'=>$rule->id])}}" method="post" onsubmit="return confirm('Apakah Anda ingin menghapus item ini?')">
                        @csrf
                        <button type="submit" class="ml-auto btn btn-danger text-nowrap">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
            {{-- <div class="table-responsive">
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
                                        <select id="inclusiveMin" class="form-control w-auto selectpicker">
                                            <option>≤</option>
                                            <option><</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0 mt-auto pr-2">
                                        <div class="form-control text-nowrap">[INPUT]</div>
                                    </div>
                                    <div class="form-group mb-0 mt-auto pr-2">
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
            </div> --}}
        </div>
    </div>
@endsection
