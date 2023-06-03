@extends('gaji-penjahit.layout.app', ['title' => 'Entri Data Gaji'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endpush
@section('content')
    <h3>Entri Gaji Penjahit</h3>
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="form-group w-100 pr-2">
                        <label class="mb-0" for="inputMin">Nama Penjahit :</label>
                        <h4 class="mb-0 d-block font-weight-bold">{{$employee->nama}}</h4>
                    </div>
                    <div class="form-group w-100 mb-0 pr-2">
                        @php
                            $finalSalary = $employee->sewing_tasks_sum_total 
                                + (($employee->sewingCompensation->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100)
                                + (($employee->sewingDefect->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100)
                                + $employee->trimming->jumlah
                                - $employee->sewing_needs_sum_total
                                - $employee->installment->jumlah
                                - $employee->infaq->jumlah;
                            $compensationSewingAndDefect = (($employee->sewingCompensation->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100)
                                + (($employee->sewingDefect->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100);
                            
                        @endphp
                        <label class="mb-0" for="inputMin">Gaji Final :</label>
                        <h4 class="mb-0 d-block font-weight-bold text-primary">{{ Helper::rupiah($finalSalary) }}</h4>
                    </div>
                </div>
                <div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Total Jahit :</label>
                        <h6 class="mb-0 d-block font-weight-bold">{{ Helper::rupiah($employee->sewing_tasks_sum_total) }}</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Kompensasi Total Jahit & Cacat :</label>
                        <h6 class="mb-0 d-block font-weight-bold">({{ Helper::rupiah($employee->sewing_tasks_sum_total) }}) x {{$employee->sewingCompensation->kompensasi_persen ?? 0}}% +
                            ({{ Helper::rupiah($employee->sewing_tasks_sum_total) }}) x {{$employee->sewingDefect->kompensasi_persen ?? 0}}% = {{Helper::rupiah($compensationSewingAndDefect)}}</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Bubut :</label>
                        <h6 class="mb-0 d-block font-weight-bold">{{ Helper::rupiah($employee->trimming->jumlah) }}</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Kebutuhan Jahit :</label>
                        <h6 class="mb-0 d-block font-weight-bold text-danger">{{ Helper::rupiah($employee->sewing_needs_sum_total) }}</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Infaq dan Cicilan :</label>
                        <h6 class="mb-0 d-block font-weight-bold text-danger">{{ Helper::rupiah($employee->installment->jumlah + $employee->infaq->jumlah) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Total Jahit</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
            <form action="{{route('entri-data-gaji.tambah-jahit', ['id' => $employee->id])}}" method="post">
            @csrf
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <select name="sewing_id" class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" selected disabled>Pilih Jahit</option>
                        @foreach (App\Models\Tailor\Sewing::all() as $sewing)
                        <option value="{{$sewing->id}}">{{$sewing->nama}} - {{Helper::rupiah($sewing->total)}}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input type="number" name="qty" min="0" class="form-control" placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                {{-- <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" class="form-control" placeholder="Total">
                    </div>
                </div> --}}
                <div class="form-group mb-0">
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">+ Tambah</button>
                </div>
            </div>
            </form>
        </div>
        <div class="card-body">
            @foreach ($employee->sewingTasks as $sewingTask)
            <div class="d-flex w-100 {{ $loop->last ?: 'mb-3' }}">
                <div class="form-group w-100 mr-2 mb-0">
                    <select disabled class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" selected disabled>Pilih Jahit</option>
                        @foreach (App\Models\Tailor\Sewing::all() as $sewing)
                        <option value="{{$sewing->id}}" @selected($sewing->id == $sewingTask->sewing_id)>{{$sewing->nama}} - {{Helper::rupiah($sewing->total)}}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="{{$sewingTask->qty}}" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah($sewingTask->total) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
                <div class="form-group mb-0 d-flex">
                    <button type="button" class="ml-auto btn btn-success text-nowrap mr-2" data-toggle="modal"
                        data-target="#edit-jahit-{{$sewingTask->id}}">Update</button>
                    <form action="{{route('entri-data-gaji.hapus-jahit', ['id' => $sewingTask->id])}}" method="post" onsubmit="return confirm('Apakah Anda ingin menghapus item ini?')">
                        @csrf
                        <button type="submit" class="ml-auto btn btn-danger text-nowrap">Hapus</button>
                    </form>
                </div>
                <div class="modal fade" id="edit-jahit-{{$sewingTask->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('entri-data-gaji.update-jahit', ['id' => $sewingTask->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="d-flex">
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <select name="sewing_id" required class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                                            <option value="" selected disabled>Pilih Jahit</option>
                                            @foreach (App\Models\Tailor\Sewing::all() as $sewing)
                                            <option value="{{$sewing->id}}" @selected($sewing->id == $sewingTask->sewing_id)>{{$sewing->nama}} - {{Helper::rupiah($sewing->total)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <div class="input-group">
                                            <input name="qty" type="number" min="0" value="{{$sewingTask->qty}}" class="form-control" placeholder="Masukan jumlah">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Pcs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <h4 class="mb-2 d-block">Kompensasi Total Jahit</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{Helper::rupiah($employee->sewingCompensation->total_jahit ?? 0)}}" class="form-control"
                            placeholder="Masukan jumlah">
                    </div>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="{{$employee->sewingCompensation->kompensasi_persen ?? 0}}" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah(($employee->sewingCompensation->total_jahit ?? 0) * ($employee->sewingCompensation->kompensasi_persen ?? 0) / 100) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Kompensasi Cacat Jahit</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
            <form action="{{route('entri-data-gaji.cacat-jahit', ['id' => $employee->id])}}" method="post">
            @csrf
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input name="cacat_persen" type="number" min="0" class="form-control" value="{{$employee->sewingDefect->cacat_persen ?? ''}}" placeholder="Cacat">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
            </form>
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{Helper::rupiah($employee->sewingCompensation->total_jahit ?? 0)}}" class="form-control"
                            placeholder="Masukan jumlah">
                    </div>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="{{$employee->sewingDefect->kompensasi_persen ?? 0}}" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah(($employee->sewingCompensation->total_jahit ?? 0) * ($employee->sewingDefect->kompensasi_persen ?? 0) / 100 ) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Total Kebutuhan Jahit</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
            <form action="{{route('entri-data-gaji.tambah-kebutuhan-jahit', ['id' => $employee->id])}}" method="post">
            @csrf
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <select name="sewing_supply_id" class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" selected disabled>Pilih Jahit</option>
                        @foreach (App\Models\Tailor\SewingSupply::all() as $sewingSupply)
                        <option value="{{$sewingSupply->id}}">{{$sewingSupply->nama}} - {{Helper::rupiah($sewingSupply->harga)}}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input name="qty" type="number" min="0" class="form-control" placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                {{-- <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" class="form-control" placeholder="Total">
                    </div>
                </div> --}}
                <div class="form-group mb-0">
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">+ Tambah</button>
                </div>
            </div>
            </form>
        </div>
        <div class="card-body">
            @foreach ($employee->sewingNeeds as $sewingNeed)
            <div class="d-flex w-100 {{$loop->last ?: 'mb-3'}}">
                <div class="form-group w-100 mr-2 mb-0">
                    <select disabled class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" selected disabled>Pilih Kebutuhan Jahit</option>
                        @foreach (App\Models\Tailor\SewingSupply::all() as $sewingSupply)
                        <option value="{{$sewingSupply->id}}" @selected($sewingSupply->id == $sewingNeed->sewing_supply_id)>{{$sewingSupply->nama}} - {{Helper::rupiah($sewingSupply->harga)}}</option>
                        @endforeach
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="{{$sewingNeed->qty}}" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah($sewingNeed->total) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
                <div class="form-group mb-0 d-flex">
                    <button type="button" class="ml-auto btn btn-success text-nowrap mr-2" data-toggle="modal"
                        data-target="#edit-kebutuhan-jahit-{{$sewingNeed->id}}">Update</button>
                    <form action="{{route('entri-data-gaji.hapus-kebutuhan-jahit', ['id' => $sewingNeed->id])}}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" method="post">
                    @csrf
                    <button type="submit" class="ml-auto btn btn-danger text-nowrap">Hapus</button>
                    </form>
                </div>
                <div class="modal fade" id="edit-kebutuhan-jahit-{{$sewingNeed->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('entri-data-gaji.update-kebutuhan-jahit', ['id' => $sewingNeed->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="d-flex">
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <select name="sewing_supply_id" class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                                            <option value="" selected disabled>Pilih Kebutuhan Jahit</option>
                                            @foreach (App\Models\Tailor\SewingSupply::all() as $sewingSupply)
                                            <option value="{{$sewingSupply->id}}" @selected($sewingSupply->id == $sewingNeed->sewing_supply_id)>{{$sewingSupply->nama}} - {{Helper::rupiah($sewingSupply->harga)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <div class="input-group">
                                            <input name="qty" type="number" value="{{$sewingNeed->qty}}" min="0" class="form-control" placeholder="Masukan jumlah">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Pcs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
    </div>
    <h4 class="mb-2 d-block">Bubut</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <form action="{{route('entri-data-gaji.simpan-bubut', ['id' => $employee->id])}}" method="post">
            @csrf
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input name="jumlah" value="{{$employee->trimming->jumlah}}" type="number" min="0" class="form-control" placeholder="Bubut">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <h4 class="mb-2 d-block">Cicilan</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <form action="{{route('entri-data-gaji.simpan-cicilan', ['id' => $employee->id])}}" method="post">
            @csrf
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input name="jumlah" value="{{$employee->installment->jumlah}}" type="number" min="0" class="form-control" placeholder="Cicilan">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <h4 class="mb-2 d-block">Infaq</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <form action="{{route('entri-data-gaji.simpan-infaq', ['id' => $employee->id])}}" method="post">
            @csrf
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input name="jumlah" value="{{$employee->infaq->jumlah}}" type="number" min="0" class="form-control" placeholder="Infaq">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
