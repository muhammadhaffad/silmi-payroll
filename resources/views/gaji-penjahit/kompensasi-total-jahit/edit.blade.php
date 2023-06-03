@extends('gaji-penjahit.layout.app', ['title' => 'Kompensasi Total Jahit'])
@section('content')
    <h3>Kompensasi Total Jahit</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="form-group w-100 pr-2 mb-0">
                <label class="mb-0" for="inputMin">Nama Penjahit :</label>
                <h4 class="mb-0 d-block font-weight-bold">{{$employee->nama}}</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3">
            <form action="{{route('pengaturan.kompensasi-total-jahit.tambah', ['id'=>$employee->id])}}" method="post">
                @csrf
                <div class="d-flex">
                    <div class="form-group mb-0 w-100 mr-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input name="min_total_jahit" type="number" min="0" class="form-control" placeholder="Masukan jumlah minimal">
                        </div>
                    </div>
                    <div class="form-group mb-0 pr-2">
                        <select name="inclusive_min" id="inclusiveMin" class="form-control w-auto selectpicker">
                            <option value="1">≤</option>
                            <option value="0"><</option>
                        </select>
                    </div>
                    <div class="form-group mb-0 pr-2">
                        <div class="p-2 text-nowrap">JUMLAH</div>
                    </div>
                    <div class="form-group mb-0 pr-2">
                        <select name="inclusive_maks" class="form-control w-auto selectpicker">
                            <option value="1">≤</option>
                            <option value="0"><</option>
                        </select>
                    </div>
                    <div class="form-group mb-0 w-100 mr-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input name="maks_total_jahit" type="number" min="0" class="form-control" placeholder="Masukan jumlah maksimal">
                        </div>
                    </div>
                    <span class="mr-2 pt-2">=</span>
                    <div class="form-group mb-0 w-100 mr-2">
                        <div class="input-group">
                            <input name="kompensasi_persen" type="number" min="0" class="form-control" placeholder="Masukan nilai kompensasi">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                        </div>
                    </div>
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">+ Tambah</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            @foreach ($employee->sewingCompensationRules as $rule)
            <form id="update-rule-{{$rule->id}}" action="{{route('pengaturan.kompensasi-total-jahit.update', ['id'=>$rule->id])}}" method="post">
                @csrf
                @method('PUT')
            </form>
            <div class="d-flex">
                <div class="form-group w-100 mr-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input form="update-rule-{{$rule->id}}" required name="min_total_jahit" value="{{$rule->min_total_jahit}}" type="number" min="0" class="form-control" placeholder="Masukan jumlah minimal">
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
                        <input form="update-rule-{{$rule->id}}" required name="maks_total_jahit" value="{{$rule->maks_total_jahit}}" type="number" min="0" class="form-control" placeholder="Masukan jumlah maksimal">
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
                    <form action="{{route('pengaturan.kompensasi-total-jahit.remove', ['id'=>$rule->id])}}" method="post" onsubmit="return confirm('Apakah Anda ingin menghapus item ini?')">
                        @csrf
                        <button type="submit" class="ml-auto btn btn-danger text-nowrap">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
