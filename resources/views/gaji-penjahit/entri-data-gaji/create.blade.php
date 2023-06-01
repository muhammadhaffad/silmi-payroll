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
                        <h4 class="mb-0 d-block font-weight-bold">AZIZAH</h4>
                    </div>
                    <div class="form-group w-100 mb-0 pr-2">
                        <label class="mb-0" for="inputMin">Gaji Final :</label>
                        <h4 class="mb-0 d-block font-weight-bold text-primary">{{ Helper::rupiah(2200000) }}</h4>
                    </div>
                </div>
                <div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Total Jahit :</label>
                        <h6 class="mb-0 d-block font-weight-bold">{{ Helper::rupiah(2200000) }}</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Kompensasi Total Jahit & Cacat :</label>
                        <h6 class="mb-0 d-block font-weight-bold">({{ Helper::rupiah(2200000) }}) x 5% +
                            ({{ Helper::rupiah(2200000) }}) x 1%</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Bubut :</label>
                        <h6 class="mb-0 d-block font-weight-bold">{{ Helper::rupiah(200000) }}</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Kebutuhan Jahit :</label>
                        <h6 class="mb-0 d-block font-weight-bold text-danger">{{ Helper::rupiah(220000) }}</h6>
                    </div>
                    <div class="form-group w-100 mb-1 pr-2">
                        <label class="mb-0" for="inputMin">Infaq dan Cicilan :</label>
                        <h6 class="mb-0 d-block font-weight-bold text-danger">{{ Helper::rupiah(20000) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Total Jahit</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <select class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" selected disabled>Pilih Jahit</option>
                        <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                        <option data-tokens="mustard">Burger, Shake and a Smile</option>
                        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" class="form-control" placeholder="Total">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="button" class="ml-auto btn btn-primary text-nowrap">+ Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <select disabled class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" disabled>Pilih Jahit</option>
                        <option data-tokens="ketchup mustard" selected>Hot Dog, Fries and a Soda</option>
                        <option data-tokens="mustard">Burger, Shake and a Smile</option>
                        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="3" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah(3000000) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
                <div class="form-group mb-0 d-flex">
                    <button type="button" class="ml-auto btn btn-success text-nowrap mr-2" data-toggle="modal"
                        data-target="#edit-jahit-1">Update</button>
                    <button type="button" class="ml-auto btn btn-danger text-nowrap">Hapus</button>
                </div>
                <div class="modal fade" id="edit-jahit-1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex">
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <select class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                                            <option value="" selected disabled>Pilih Jahit</option>
                                            <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                                            <option data-tokens="mustard">Burger, Shake and a Smile</option>
                                            <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                                        </select>
                                    </div>
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" placeholder="Masukan jumlah">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Pcs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <input disabled type="text" min="0" value="{{Helper::rupiah(2200000)}}" class="form-control"
                            placeholder="Masukan jumlah">
                    </div>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="10" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah(220000) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Kompensasi Cacat Jahit</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" placeholder="Cacat">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="button" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{Helper::rupiah(2200000)}}" class="form-control"
                            placeholder="Masukan jumlah">
                    </div>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="10" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah(220000) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Total Kebutuhan Jahit</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <select class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" selected disabled>Pilih Jahit</option>
                        <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                        <option data-tokens="mustard">Burger, Shake and a Smile</option>
                        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" class="form-control" placeholder="Total">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="button" class="ml-auto btn btn-primary text-nowrap">+ Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <select disabled class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                        <option value="" disabled>Pilih Jahit</option>
                        <option data-tokens="ketchup mustard" selected>Hot Dog, Fries and a Soda</option>
                        <option data-tokens="mustard">Burger, Shake and a Smile</option>
                        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                    </select>
                </div>
                <span class="mr-2 pt-2">x</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="number" min="0" value="3" class="form-control"
                            placeholder="Masukan jumlah">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>
                <span class="mr-2 pt-2">=</span>
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <input disabled type="text" min="0" value="{{ Helper::rupiah(3000000) }}"
                            class="form-control" placeholder="Total">
                    </div>
                </div>
                <div class="form-group mb-0 d-flex">
                    <button type="button" class="ml-auto btn btn-success text-nowrap mr-2" data-toggle="modal"
                        data-target="#edit-jahit-1">Update</button>
                    <button type="button" class="ml-auto btn btn-danger text-nowrap">Hapus</button>
                </div>
                <div class="modal fade" id="edit-jahit-1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex">
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <select class="selectpicker w-100" data-live-search="true" data-style="border-secondary">
                                            <option value="" selected disabled>Pilih Jahit</option>
                                            <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                                            <option data-tokens="mustard">Burger, Shake and a Smile</option>
                                            <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                                        </select>
                                    </div>
                                    <div class="form-group w-100 mr-2 mb-0">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" placeholder="Masukan jumlah">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Pcs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Bubut</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Bubut">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="button" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Cicilan</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Cicilan">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="button" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-2 d-block">Infaq</h4>
    <div class="card mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="d-flex w-100">
                <div class="form-group w-100 mr-2 mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" placeholder="Infaq">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="button" class="ml-auto btn btn-primary text-nowrap">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
